<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Models\SellerModel;

class Seller extends BaseController
{
    public function __construct()
    {
        $this->sellerModel = new SellerModel();
    }

    public function index()
    {
        return view('Back/Seller/index', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'sellers' => $this->sellerModel->findAll(),
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function login()
    {
        return view('Back/Seller/login', [
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function profile($sellerID)
    {
        // dd($this->sellerModel->find($sellerID));
        return view('Back/Seller/profile', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'seller' => $this->sellerModel->find($sellerID),
            'validation' => \Config\Services::validation(),
        ]);
    }

    /**
     * Create seller from POST form
     * @return App\View
     */
    public function create()
    {
        // dd($this->request->getVar());
        // helper(['form', 'url']);

        $validation = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The seller {field} is required.'
                ],
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[seller.email]',
                'errors' => [
                    'required' => 'The seller {field} is required.',
                    'is_unique' => 'The seller {field} is already registered.',
                ],
            ],
            'phone_no' => [
                'rules' => 'required|is_unique[seller.phone_no]|min_length[11]',
                'errors' => [
                    'required' => 'Phone No. is required and cannot leave blank.',
                    'is_unique' => 'The phone no. is already registered.'
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
            session()->setFlashdata('error', 'Failed! Seller was Unsuccessfully Added.');

            return redirect()->to('/admin/seller')->withInput();
        } else {
            $this->sellerModel->save([
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'phone_no' => $this->request->getVar('phone_no'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('success', 'New Seller was Successfully Added.');

            return redirect()->to('/admin/seller/');
        }
    }

    /**
     * Update seller from POST form
     * @return App\View
     */
    public function update($sellerID)
    {
        $validation = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The seller {field} is required'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[seller.email,seller_id,{seller_id}]',
                'errors' => [
                    'required' => 'The seller {field} is required',
                    'is_unique' => 'The seller {field} is already taken',
                ]
            ],
            'phone_no' => [
                'rules' => 'required|is_unique[seller.phone_no,seller_id,{seller_id}]|min_length[11]',
                'errors' => [
                    'required' => ' The contact no. is required and cannot leave blank{phone_no}',
                    'is_unique' => ' The contact no. is already taken',
                ]
            ]

        ]);

        if (!$validation) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        } else {
            $this->sellerModel->set([
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone_no' => $this->request->getVar('phone_no'),
            ])->where('seller_id', $sellerID)->update();

            return redirect()->back()->with('success', 'Seller is successfully updated!');
        }
    }

    /**
     * Delete seller from POST form
     * @return App\View
     */
    public function delete($sellerID)
    {
        if ($this->sellerModel->where('seller_id', $sellerID)->delete()) {
            return redirect()->to('admin/seller')->with('success', 'Seller was successfully deleted.');
        } else
            return redirect()->to('admin/seller')->with('error', 'Failed! Seller was unsuccessfully deleted.');
    }

    //AJAX request, used in view["admin/order/add", ]
    public function fetchSeller($sellerID = null)
    {
        if ($sellerID != null) {
            $sellers = $this->sellerModel->find($sellerID);
        } else $sellers = $this->sellerModel->findAll();

        return $this->response->setJSON([
            'sellers' => $sellers
        ]);
    }
}
