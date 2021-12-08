<?php

namespace App\Libraries;

class Authentication
{
  private $user;

  public function login($email, $password)
  {
    $model = model('UserModel');

    $user = $model->findActivatedUserByEmail($email);

    if ($user === null) {
      return false;
    }

    if (!$user->verifyPassword($password)) {
      return false;
    }

    $session = session();
    $session->regenerate();
    $session->set('user_id', $user->customer_id);

    return true;
  }

  public function logout()
  {
    session()->destroy();
  }

  public function getCurrentUser()
  {
    if (!$this->isLoggedIn()) {
      return null;
    }
    if ($this->user === null) {
      $model = model('UserModel');
      $this->user = $model->find(session()->get('user_id'));
    }

    return $this->user;
  }

  public function isLoggedIn()
  {
    return session()->has('user_id');
  }
}
