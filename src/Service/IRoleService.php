<?php

namespace App\Service;

use App\Entity\Role;

interface IRoleService{
    public function addRole(Role $role);
    public function findAll():array;
    public function getRole(string $user):Role;
    public function updateRole();
    public function deleteRole(Role $role);
    public function showRole(Role $role):Role;
}