<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\StaffModel;
use App\Models\DriverModel;
use App\Models\SellerModel;


class Login extends BaseController
{
    public function __construct()
    {

        $this->driverModel = new DriverModel();
        $this->sellerModel = new SellerModel();

    }

    public function auth()
    {
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_not_unique[seller.email]',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Enter a valid email address.',
                    'is_not_unique' => 'This email is not register on our service.',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must have atleast 5 characters in length.',
                ]
            ]
        ]);

        if (!$validation) {
            return view('Back/Seller/login', [
                'validation' => $this->validator,
            ]);
        } else {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $sellerData = $this->sellerModel->where('email', $email)->first();
            $verifyPass = Hash::check($password, $sellerData['password']);



            if (!$verifyPass) {
                session()->setFlashData('error', 'Incorrect password.');
                return redirect()->to('admin/seller/login')->withInput();
            } else {
                $sellerID = $sellerData['seller_id'];
                session()->set('loggedSeller', $sellerID);
                return redirect()->to('admin/dashboard');
            }
        }
    }

    public function logout()
    {
        if (session()->has('loggedSeller')) {
            session()->remove('loggedSeller');
            session()->setFlashData('success', 'You are successfully logged out!');
            return redirect()->to('admin/seller/login');
        }
    }


    public function driver_auth()
    {
        $validation = $this->validate([
            'username' => [
                'rules' => 'required|is_not_unique[driver.username]',
                'errors' => [
                    'required' => 'Username is required.',
                    'is_not_unique' => 'Username is not registered on our service'
                    
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must have atleast 5 characters in length.',
                ]
            ]
        ]);

        if (!$validation) {
            return view('Back/driver/login', [
                'validation' => $this->validator,
            ]);
        } else {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $driverData = $this->driverModel->where('username', $username)->first();
            $verifyPass = Hash::check($password,$driverData['password_hash']);


            if (!$verifyPass) {
                session()->setFlashData('error', 'Incorrect password.');
                return redirect()->to('/driver')->withInput();
            } else {

                $driverID = $driverData['driver_id'];
                session()->set('loggedDriver', $driverID);
                //return redirect()->to('admin/dashboard');
                return redirect()->to('/driver/page');
            }
        }
    }

     public function driver_logout()
    {
        if (session()->has('loggedDriver')) {
            session()->remove('loggedDriver');
            session()->setFlashData('success', 'You are successfully logged out!');
            return redirect()->to('/driver');
        }
    }

}
