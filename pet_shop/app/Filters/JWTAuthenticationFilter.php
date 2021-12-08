<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;
use Exception;

class JWTAuthenticationFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $authenticationHeader = $request->getServer('HTTP_AUTHORIZATION');

    try {
      helper('jwt');
      $encodedToken = getJWTFromRequest($authenticationHeader);
      $decodedToken = validateJWTFromRequest($encodedToken);
      $request->{"decodedToken"} = $decodedToken;
      return $request;
    } catch (Exception $e) {
      return Services::response()
        ->setJSON([
          'error' => $e->getMessage()
        ])
        ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
