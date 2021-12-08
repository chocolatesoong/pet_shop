<?php

namespace App\Controllers;


class Migration extends BaseController
{
  public function index()
  {
    $migrate = \Config\Services::migrations();

    try {

      $migrate->latest();

      echo "Migrated";
    } catch (\Exception $e) {

      echo $e->getMessage();
    }
  }
}
