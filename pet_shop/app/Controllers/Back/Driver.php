<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Models\DriverModel;


class  Driver extends BaseController
{

    public function __construct()
    {
        $this->driverModel = new DriverModel();
    }
  

    public function index()
    {
        return view('Back/Driver/index', [
            'loggedDriverData' => BaseController::getLoggedDriver(),
             'drivers' => $this->driverModel->findAll(),
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function page()
    {
        return view('Back/Driver/page', [
            'loggedDriverData' => BaseController::getLoggedDriver(),
             'drivers' => $this->driverModel->findAll(),
            'validation' => \Config\Services::validation(),
        ]);
    }


    public function login()
    {


        return view('Back/Driver/login', [
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function profile($driverID)
    {
        // dd($this->staffModel->find($staffID));
        return view('Back/Driver/profile', [
            'loggedDriverData' => BaseController::getLoggedDriver(),
            'driver' => $this->driverModel->find($driverID),
            'validation' => \Config\Services::validation(),
        ]);
    }

    // /**
    //  * Create Staff from POST form
    //  * @return App\View
    //  */
    public function create()
    {


        // dd($this->request->getVar());
        // helper(['form', 'url']);

        $validation = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The name is required.'
                ],
            ],
            'username' => [
                'rules' => 'if_exist|is_unique[driver.username,driver_id,{driver_id}]',
                'errors' => [
                    'if_exist' => 'The username is alreday existed.',
                    'is_unique' => 'The username is already registered.',
                ],
            ],
            'role' => [
                'rules' => 'required|in_list[Driver,Admin]',
                'errors' => [
                    'required' => 'Role is required.',
                    'in_list' => 'Please select Driver or Admin.',
                    
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must have atleast 5 characters in length.'
                ]
            ],
            'password_confirmation' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'matches' => 'Confirm Password does not match with Password.',
                ],
            ],
        ];

        if (!$this->validate($validation)) {
            session()->setFlashdata('error', 'Failed! Driver was Unsuccessfully Added.');

            return redirect()->to('/admin/driver')->withInput();
        } else {
            $this->driverModel->save([
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'role' => $this->request->getVar('role'),
                'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('success', 'New Driver was Successfully Added.');

            return redirect()->to('/driver/driverList');
        }
    }

    // /**
    //  * Update Staff from POST form
    //  * @return App\View
    //  */
    public function update($driverID)
    {
        $validation = $this->validate([
           'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The name is required.'
                ],
            ],
            'username' => [
                'rules' => 'if_exist|is_unique[driver.username,driver_id,{driver_id}]',
                'errors' => [
                    'if_exist' => 'The username is alreday existed.',
                    'is_unique' => 'The username is already registered.',
                ],
            ],
            'role' => [
                'rules' => 'required|in_list[Driver,Admin]',
                'errors' => [
                    'required' => 'Role is required.',
                    'in_list' => 'Please select Driver or Admin.',
                    
                ]
            ]

        ]);

        if (!$validation) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        } else {

            // $name = $this->request->getPost('name');
            // $role = $this->request->getVar('role');
            // print_r($name);
            // print_r($role);
            // die();

            

            $result = $this->driverModel->set([
                'name' => $this->request->getPost('name'),
                'username' => $this->request->getPost('username'),
                'role' => $this->request->getPost('role')
            ])->where('driver_id',$driverID)->update();


            if(!$result){
                return redirect()
            ->back()
            ->with('errors', $this->driverModel->errors());
            }




            return redirect()->back()->with('success', 'Driver is successfully updated!');
        }
    }

    // /**
    //  * Delete Staff from POST form
    //  * @return App\View
    //  */
    public function delete($driverID)
    {
        if ($this->driverModel->where('driver_id', $driverID)->delete()) {
            return redirect()->to('/driver/driverList')->with('success', 'Driver was successfully deleted.');
        } else
            return redirect()->to('admin/driverList')->with('error', 'Failed! Driver was unsuccessfully deleted.');
    }
}
