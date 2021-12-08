<?php

namespace App\Controllers\Back;

use App\Entities\Address;
use App\Controllers\BaseController;
use App\Models\AddressModel;
use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->users = new \App\Entities\User();
        $this->userModel = new UserModel();
        $this->addressModel = new AddressModel();
        $this->addresses = new Address();
    }

    public function index()
    {
        $model = model('UserModel');
        $this->users = $model->findAll();
        return view('Back/User/index', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'users' => $this->users,
        ]);
    }

    public function create()
    {
        $model = model('UserModel');
        $addr_model = model('AddressModel');

        $this->users->fill($this->request->getPost());

        $this->addresses->fill($this->request->getPost());
        $this->addresses->default = 1; //New user will have default address.

        if ($id = $model->insert($this->users)) {
            $this->addresses->customer_id = $id;
            return ($addr_model->insert($this->addresses)) ?
                redirect()->to('admin/user')->with('info', 'User Was Inserted Successfully') :
                redirect()->back()->with('errors', $model->errors())->withInput();
        } else {
            return redirect()->back()->with('errors', $model->errors())->withInput();
        }
    }
    /**
     * Edit Controller
     *
     * @param [type] $user_id
     *
     * @return App\View
     */
    public function edit($user_id)
    {
        $model = model('UserModel');
        $addr_model = model('AddressModel');

        // Check whether customer exist
        $this->users = $this->getUserOr404($user_id);
        $this->addresses = $this->getAddressOr404($user_id);

        $default_address = $addr_model->getDefaultAddressId($user_id);

        return view('Back/User/edit', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'user' => $this->users, 'addresses' => $this->addresses,
            'default_address' => $default_address,
        ]);
    }

    public function showAddress($user_id)
    {
        $addr_model = model('AddressModel');
        $default_address = $addr_model->getDefaultAddressId($user_id);

        return view('Back/User/address', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'user' => $this->userModel->getUserInfo($user_id),
            'addresses' => $this->addresses,
            'default_address' => $default_address,
        ]);
    }

    /**
     * Update User from POST form
     * @return App\View
     */
    public function update()
    {
        // get POST data
        $posts = $this->request->getPost();

        // Initialization
        $model = model('UserModel');
        $addr_model = model('AddressModel');

        // Security Check: Is Customer Id available?
        if (empty($posts['customer_id'])) {
            return redirect()->back()->withInput()->with('warning', 'Invalid Operation!');
        }

        // Security Check: Is Customer Id Valid?
        $this->users = $this->getUserOr404($posts['customer_id']);

        // Security Check : Is Default Address Id Belongs to User?
        if ($addr_model->checkDefaultAddressBelongToUser($posts['customer_id'], $posts['default']) === null) {
            return redirect()->back()->withInput()->with('warning', 'Invalid Operation');
        }

        // Process POST Data
        $this->users->fill($posts);
        $addresses = $this->PostToArrayOfAddressEntities($posts);

        // Update User
        if (!$model->update($posts['customer_id'], $this->users->toRawArray())) {
            return redirect()->back()->withInput()->with('warning', 'Operation Failed');
        }

        // Update Address
        foreach ($addresses as $address) {
            if (!$addr_model->save($address)) {
                return redirect()->back()->withInput()->with('warning', 'Operation Failed');
            }
        }


        // Update Operation Success
        return redirect()->to('admin/user/edit/' . $posts['customer_id'])->with('info', 'Updated Successfully');
    }

    public function delete($user_id)
    {
        if ($this->userModel->where('customer_id', $user_id)->delete() && $this->addressModel->where('customer_id', $user_id)->delete()) {
            return redirect()->to('admin/user')->with('success', 'User was successfully deleted.');
        }
        return redirect()->to('admin/user')->with('error', 'Something went wrong! User was unsuccessfully deleted.');
    }

    //AJAX request, used in view["admin/order/add", ]
    public function fetchUser($customerID)
    {
        $userModel = new UserModel();
        return $this->response->setJSON([
            'customers' => $userModel->getUserInfo($customerID),
        ]);
    }

    /**
     * Convert POST Data to Array of Address Entities
     *
     * @param array $posts
     *
     * @return array<App\Entities\Address>
     */
    private function PostToArrayOfAddressEntities(array $posts): array
    {
        $addresses = array();
        for ($i = 0; $i < count($posts['address_name']); $i++) {

            $address = new Address();

            $address->fill([
                'address_id' => $posts['address_id'],
                'address_name' => $posts['address_name'][$i],
                'postcode' => $posts['postcode'][$i],
                'city' => $posts['city'][$i],
                'state' => $posts['state'][$i],
                'customer_id' => $posts['customer_id'],
                'default' => ($posts['default'] == $posts['address_id'][$i]) ? 1 : 0
            ]);

            array_push($addresses, $address);
        }
        return $addresses;
    }

    /**
     *  Get Customer
     *  if no customer is found, throw PageNotFoundException
     *
     * @param [type] $user_id
     *
     * @return App\Entities\User
     */
    private function getUserOr404($user_id): \App\Entities\User
    {
        $user = model('UserModel')->find($user_id);
        if ($user == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer with id ' . $user_id . ' is not found');
        }

        return $user;
    }

    /**
     *  Get Address
     *  if no address is found, throw PageNotFoundException
     *
     * @param [type] $customer_id
     *
     * @return App\Entities\Address
     */
    private function getAddressOr404($customer_id): array
    {
        $address = model('AddressModel')->getAddressByCustomerId($customer_id);

        if ($address == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Addresses with Customer Id ' . $customer_id . 'Are not found');
        }

        return $address;
    }
}
