<?php

namespace App\Libraries;

class Hash
{
    public static function make($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public static function check($enteredPassword, $tblPassword)
    {
        if (password_verify($enteredPassword, $tblPassword)) {
            return true;
        } else return false;
    }
}
