<?php


namespace App\Service;

use App\Repository\RoleRepository;
use App\Entity\Role;

class RoleService implements IRoleService{

    private $roleRepository;
    public function __construct(RoleRepository $roleRepository){
        $this->roleRepository = $roleRepository;
    }
    /**
     * Get role list
     */
    public function findAll():array{
       $roleList= $this->roleRepository->findAll();
        return $roleList;
    }
    /**
     * Add a role
     */
    public function addRole(Role $role){
        $this->roleRepository->addRole($role);
    }
    public function getRole(string $user):Role{
        return $this->roleRepository->getRole($user);
    }
    /**
     * Edit a role
     */
    public function updateRole(){
        $this->roleRepository->updateRole();
    }
    /**
     * Delete a role
     */
    public function deleteRole(Role $role){
        $this->roleRepository->deleteRole($role);
    }
    /**
     * Show a role
     */
    public function showRole(Role $role):Role{
        return $this->roleRepository->find($role->getId());
    }
}