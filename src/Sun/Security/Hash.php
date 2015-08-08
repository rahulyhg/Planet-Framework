<?php

namespace Sun\Security;

use Sun\Contracts\Security\Hash as HashContract;

class Hash implements HashContract
{
    /**
     * To make password hash
     *
     * @param $value
     *
     * @return bool|string
     */
    public function make($value)
    {
       return password_hash(trim($value), PASSWORD_BCRYPT);
    }

    /**
     * To verify password
     *
     * @param $password
     * @param $hash
     *
     * @return bool
     */
    public function verify($password, $hash)
    {
        return password_verify(trim($password), $hash);
    }
}