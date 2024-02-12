<?php


namespace App\Service;

use App\Repository\UserRepository;
use App\Entity\User;

class UserService implements IUserService{

    private $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    /**
     * Get user list
     */
    public function findAll():array{
        return $this->userRepository->findAll();
    }
    /**
     * Add a user
     */
    public function addUser(User $user){
        $this->userRepository->addUser($user);
    }
    /**
     * Edit a user
     */
    public function updateUser(){
         $this->userRepository->updateUser();
    }
    /**
     * Show a user
     */
    public function showUser(User $user): User{
       return  $this->userRepository->find($user->getId());
    }
    /**
     * Delete a user
     */
    public function deleteUser(User $user){
        $this->userRepository->deleteUser($user);
    }


}
