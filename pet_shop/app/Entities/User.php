<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $datamap = [];
    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts   = [];

    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function setToken($token)
    {
        $this->attributes['token'] = $token;

        return $this;
    }

    public function setPassword($password)
    {
        $this->attributes['password'] = $password;

        return $this;
    }

    public function setActivate($activate)
    {
        $this->attributes['activate'] = $activate;

        return $this;
    }
}
