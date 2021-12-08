<?php

namespace App\Filters;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminOnlyFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $loggedSellerData = BaseController::getLoggedSeller();
        if (isset($loggedSellerData['isAdmin'])) {
            if (!$loggedSellerData['isAdmin']) {
                return redirect()->back();
            }
        } else return redirect()->to('admin');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
