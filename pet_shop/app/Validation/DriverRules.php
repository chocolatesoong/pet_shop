<?php

namespace App\Validation;

use App\Models\DriverModel;
use Exception;

class DriverRules
{
  public function validateUser(string $str, string $fields, array $data): bool
  {
    try {
      $model = new DriverModel();
      $driver = $model->findDriverByUsername($data['username']);
      return password_verify($data['password'], $driver['password_hash']);
    } catch (Exception $e) {
      return false;
    }
  }
}
