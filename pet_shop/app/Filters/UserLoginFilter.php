<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UserLoginFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if (!service('auth')->isLoggedIn() && !session()->has('LoggedUserData')) {
      return redirect()->to('/user/login')->with('info', 'Please login first');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
