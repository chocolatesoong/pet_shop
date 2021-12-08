<?php

namespace App\Controllers;

use App\Entities\User;
use App\Entities\Address;
use App\Models\AddressModel;
use App\Models\CartModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;



class Users extends BaseController
{
  public function __construct()
  {
    require_once APPPATH . "../vendor/autoload.php";
    $this->userModel = model('UserModel');
    $this->addrModel = model('AddressModel');
    $this->googleClient = new \Google_Client();
    $this->googleClient->setClientId("613036745831-9acb7eksh784bpvu0v3vvbd36a1krfkg.apps.googleusercontent.com");
    $this->googleClient->setClientSecret("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");
    $this->googleClient->setRedirectUri("http://online.queeniepets.com/user/loginWithGoogle");
    $this->googleClient->addScope("email");
    $this->googleClient->addScope("profile");
    $this->userModel = new UserModel();
    $this->userEntity = new User();
    $this->addressModel = new AddressModel();
    $this->addressEntity = new Address();
  }

  public function contactus()
  {
    return view('User/contactus', [
      'carts' => (new CartModel())->findAllCarts(),
    ]);
  }

  public function login()
  {
    // session()->destroy();
    // dd(session()->has("LoggedUserData"));
    $googleButton = '<a class="btn btn-lg btn-outline-dark" href="' . $this->googleClient->createAuthUrl() . '" role="button" style="text-transform:none">
    <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
    Login with Google
  </a>';
    return view('User/login', [
      'loginGoogleButton' => $googleButton,
    ]);
  }

  public function validateLogin()
  {
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $auth = service('auth');

    if ($auth->login($email, $password)) {
      $redirect_url = session('redirect_url') ?? '/';
      return redirect()->to($redirect_url)->with('info', 'Login successful');
    } else {
      return redirect()->back()->with('warning', 'Invalid login')->withInput();
    }
  }

  public function register()
  {
    return view('User/register');
  }

  // accountActivate/$1/$2
  public function activate($encrypted_email, $encrypted_token)
  {
    // Validate encrypted params of non-activated account
    $user = $this->getUserOrNullAfterVerification($encrypted_email, $encrypted_token, 0);

    if ($user == null) {
      return redirect()->to('/')->with('warning', 'Invalid Operation');
    }

    // Activate account
    if (model('UserModel')->activateAccount($user->setActivate(1))) {
      return redirect()->to('user/login')->with('info', 'Account Activated');
    }

    // Account Activation Failed - dbms fail
    return redirect()->to('/')->with('warning', 'Activation Failed');
  }

  // Register Submit
  // TODO: INSERT WITH NO ACTIVATION
  // TODO: EMAIL LINK FOR ACTIVATE ACCOUNT
  public function emailForActivation()
  {
    $users = new User();
    $addresses = new Address();
    $model = model('UserModel');

    $users->fill($this->request->getPost());

    $addresses->fill($this->request->getPost());
    $addresses->default = 1; //New user will have default address.

    // Initialize encrypted email & token.
    $result = $this->EmailAndTokenEncrypter($users->email);

    // Perform validation before transaction and gives meaningful error message.
    $validation_rules = array_merge(
      $model->validationRules,
      model('addressModel')->validationRules
    );

    if (!$this->validate($validation_rules)) {
      return redirect()->to('user/register')->with('errors', $this->validator->getErrors())->withInput();
    }

    if (!$model->insertNewUser($users->setToken($result['time']->timestamp), $addresses)) {
      return redirect()->to('user/register')->with('warning', 'User Registration Failed!');
    }

    // Initialize activation link (activate())
    $link = site_url('user/accountActivate/' . $result['email'] . '/' . $result['token']);

    // Initalize email body
    $body = "<p>Dear customer, <br> &nbsp; &nbsp; Please click here <a href='" . $link . "'>" . $link . "</a> to activate your account. <br><br> Regards, <br> " . env('shopName', 'Pet Ecommerces') . "</p>";

    if (
      service('emails')->load()
      ->initialize($users->email, 'Registration', $body)
      ->send()
    ) {
      return redirect()->to('user/login')->with('info', 'Registered Successfully! Check email for account activation.');
    }

    return redirect()->back()->with('info', 'Email Service is temporarily unavailable. Please contact Admin for Account Activation.');


    // if ($id = $model->insert($users)) {
    //   $addresses->customer_id = $id;
    //   return ($addr_model->insert($addresses)) ?
    //     redirect()->to('user/login')->with('info', 'Registered Successfully') :
    //     redirect()->back()->with('errors', $model->errors())->withInput();
    // } else {

    //   $model->delete($id);
    //   return redirect()->back()->with('errors', $model->errors())->withInput();
    // }
  }

  public function logout()
  {
    if (session()->has("LoggedUserData")) { // Google Authentication
      session()->destroy();
    } else service('auth')->logout(); //JWT Authentiation

    return redirect()->to('/')->with('info', 'Log Out Successfully');
  }

  public function forget()
  {
    return view('User/forget');
  }

  public function resetPassword()
  {
    // Initialization
    $encrypter = service('encrypter');

    // Get email value
    $email = $this->request->getPost('email');

    // Check if email exist
    $user = $this->userModel->findByEmail($email);

    // TODO: CHECK IF ACCOUNT IS ACTIVATED

    if ($user == null) {
      return redirect()->to('/')->with('info', 'Email Is Invalid');
    }

    // Generate hashed email & hashed token
    $result = $this->EmailAndTokenEncrypter($email);

    $encoded_email = $result['email'];

    $encoded_token = $result['token'];

    //Update token in customer table
    if (!$this->userModel->addToken($user->setToken($result['time']->timestamp))) {
      return redirect()->back()->with('warning', 'Something is wrong');
    }

    // Generate link
    $link = base_url('user/recover/' . $encoded_email . '/' . $encoded_token);

    $body = "<p>Dear customer, <br> &nbsp; &nbsp; Please click here <a href='" . $link . "'>" . $link . "</a> to reset your password. <br><br> Regards, <br> Pet Ecommerce</p>";

    //  Email to user.
    $mail = service('emails')->load()->initialize($email, 'Reset Password', $body);

    $result = $mail->send();

    if ($result) {
      return redirect()->to('/')->with('info', 'Check Email For Further Recovery Process');
    } else {
      return redirect()->back()->with('warning', $mail->ErrorInfo);
    }
  }


  public function recover($encrypted_email, $encrypted_token)
  {
    if ($this->getBooleanVerifyEncryptedEmailAndToken($encrypted_email, $encrypted_token)) {
      return view('User/recover', ['email' => $encrypted_email, 'token' => $encrypted_token]);
    }

    return redirect()->to('/')->with('warning', 'Invalid Operation!');
  }

  // TODO: CHECK ACCOUNT IS ACTIVATED
  public function recoverPassword($encrypted_email, $encrypted_token)
  {
    // Get password from POST request
    $password = $this->request->getPost('password');

    // check Encrypted params & reset Password
    if ($this->recoverPass($encrypted_email, $encrypted_token, $password)) {
      return redirect()->to('user/login')->with('info', 'Password Reset Successfully');
    }

    // Reset Password Fail - invalid params / dbms password resetting failed
    return redirect()->to('/')->with('warning', 'Invalid Operation');
  }

  private function recoverPass($encrypted_email, $encrypted_token, $password)
  {
    $user = $this->getUserOrNullAfterVerification($encrypted_email, $encrypted_token);

    if ($user == null) {
      return false;
    }

    return model('userModel')
      ->update(
        $user->customer_id,
        $user->setPassword($password)
          ->setToken(null)
      );
  }

  private function EmailAndTokenDecrypter($encrypted_email, $encrypted_token)
  {
    try {
      // initialization
      $encrypter = service('encrypter');

      $email = base64_decode($encrypted_email);

      $token = $encrypter->decrypt(
        hex2bin($encrypted_token)
      );
    } catch (\Exception $e) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('This page is not available');
    }

    return [
      'email' => $email,
      'token' => $token
    ];
  }

  private function EmailAndTokenEncrypter($email)
  {
    // initialization
    $encrypter = service('encrypter');

    $time = new Time(
      'now',
      'Asia/Kuala_Lumpur',
      'en_US'
    );

    $email = base64_encode($email);

    $token = bin2hex($encrypter->encrypt($time->timestamp));

    return [
      'email' => $email,
      'token' => $token,
      'time' => $time
    ];
  }

  // TODO: CHECK ACCOUNT IS ACTIVATED
  private function verifyEncryptedEmailAndToken($encrypted_email, $encrypted_token, $activate = 1)
  {
    $arr = $this->EmailAndTokenDecrypter($encrypted_email, $encrypted_token);

    // check hashed_email
    return model('UserModel')->verifyByEmailAndToken($arr['email'], $arr['token'], $activate);
  }

  private function getBooleanVerifyEncryptedEmailAndToken($encrypted_email, $encrypted_token, $activate = 1)
  {
    if ($this->verifyEncryptedEmailAndToken($encrypted_email, $encrypted_token, $activate) == null) {
      return false;
    }
    return true;
  }

  private function getUserOrNullAfterVerification($encrypted_email, $encrypted_token, $activate = 1)
  {
    return $this->verifyEncryptedEmailAndToken($encrypted_email, $encrypted_token, $activate);
  }

  //GOOGLE AUTHENTICATION
  public function loginWithGoogle()
  {
    $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
    if (!isset($token['error'])) {
      $this->googleClient->setAccessToken($token['access_token']);
      session()->set("AccessToken", $token['access_token']);
      $googleService = new \Google_Service_Oauth2($this->googleClient);
      $data = $googleService->userinfo->get();
      // dd($data);
      if ($user = $this->userModel->isAlreadyRegister($data['id'])) {
        // dd($user);
        $userData = [
          'oauth_id' => $data['id'],
          'email' => $data['email'],
          'password' => $user->password,
          'password_confirmation' => $user->password,
          'name' => $data['name'],
        ];
        // $customerData = $this->userEntity->fill($userData);
        $this->userModel->update($user->customer_id, $userData);
        unset($userData['password'], $userData['password_confirmation']);
        $userData['customer_id'] = $user->customer_id;
        // dd($userData);
      } else {
        $password = password_hash('customerpassword_123456', PASSWORD_DEFAULT);
        // hash
        $userData = [
          'email' => $data['email'],
          'oauth_id' => $data['id'],
          'password' => $password,
          'password_confirmation' => $password,
          'phone_no' => rand(),
          'name' => $data['name'],
          'activate' => 1,
        ];
        //New user inserted
        $id = $this->userModel->insert($userData);
        if ($id == false) {
          return false;
        }
        $this->addressEntity->address_name = "Your Address";
        $this->addressEntity->postcode = "00000";
        $this->addressEntity->city = "Your City";
        $this->addressEntity->state = "Your State";
        $this->addressEntity->customer_id = $id;
        $this->addressEntity->default = 1;
        // New Address Record
        if ($this->addressModel->insert($this->addressEntity) == null) {
          $this->userModel->delete($id);
          return false;
        }
        unset($userData['password'], $userData['password_confirmation'], $userData['phone_no'], $userData['activate']);
        $userData['customer_id'] = $id;
      }
      session()->set("LoggedUserData", $userData);
    } else {
      session()->setFlashData("error", "Something went Wrong");
      return redirect()->to(base_url());
    }
    //Successfully log in
    return redirect()->to(base_url())->with('info', 'Login successful');
  }
}
