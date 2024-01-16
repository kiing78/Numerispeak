<?php


namespace App\Service;

use App\Repository\UserRepository;
use App\Entity\User;

class UserService implements IUserService{

    private $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function findAll():array{
        return $this->userRepository->findAll();
    }

    public function addUser(User $user){
        $this->userRepository->addUser($user);
    }


}
