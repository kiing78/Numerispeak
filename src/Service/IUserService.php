<?php

namespace App\Service;

use App\Entity\User;

interface IUserService{

    public function findAll():array;
    public function addUser(User $user);
    public function updateUser();
    public function showUser(User $user) : User;
    public function DeleteUser(User $user);
}