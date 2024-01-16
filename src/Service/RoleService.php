<?php


namespace App\Service;

use App\Repository\RoleRepository;
use App\Entity\Role;

class RoleService implements IRoleService{

    private $roleRepository;
    public function __construct(RoleRepository $roleRepository){
        $this->roleRepository = $roleRepository;
    }

    public function findAll():array{
       $roleList= $this->roleRepository->findAll();
        return $roleList;
    }

    public function addRole(Role $role){
        $this->roleRepository->addRole($role);
    }
    public function getRole(string $user):Role{
        return $this->roleRepository->getRole($user);
    }
}