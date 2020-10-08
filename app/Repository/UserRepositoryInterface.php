<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function checkPassword($email,$password);

    public function updateToken($userId) : Model;

    public function removeToken($request) : Bool;
}
