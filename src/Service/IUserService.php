<?php

namespace App\Service;

use App\Entity\User;

interface IUserService{

    public function findAll():array;
    public function addUser(User $user);
}