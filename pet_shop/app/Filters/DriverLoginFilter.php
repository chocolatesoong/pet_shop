<?php

namespace App\Filters;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class DriverLoginFilter implements FilterInterface
{
   public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('loggedDriver')) {
            session()->setFlashData('warning', 'You must be logged in first!');
            return redirect()->to('/driver');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
