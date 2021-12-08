<?php

use App\Models\DriverModel;
use Config\Services;
use Firebase\JWT\JWT;

function getJWTFromRequest($authenticationHeader): string
{
  if (is_null($authenticationHeader)) {
    throw new \Exception('Missing or invalid JWT in request');
  }

  // JWT is sent in format Bearer xxxxx
  return explode(' ', $authenticationHeader)[1];
}

function validateJWTFromRequest(string $encodedToken)
{
  $key = service('getJWTSecretKey');
  $decodedToken = JWT::decode($encodedToken, $key, ['HS256']);
  $driverModel = new DriverModel();
  $driverModel->findDriverByUsername($decodedToken->username);

  // No exception
  return $decodedToken;
}

function getSignedJWTForDriver(string $username){
  $issuedAtTime = time();
  $tokenTimeToLive = getenv('JWT_TIME_TO_LIVE');
  $tokenExpiration = $issuedAtTime + $tokenTimeToLive;
  $payload = [
    'username' => $username,
    'iat' => $issuedAtTime,
    'exp' => $tokenExpiration,
  ];

  $jwt = JWT::encode($payload, Services::getJWTSecretKey());
  return $jwt;
}
