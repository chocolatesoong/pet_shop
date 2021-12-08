<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class GuestFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if (service('auth')->isLoggedIn()) {
      return redirect()->to('/')->with('info', 'You must log out first before you can access this page');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
