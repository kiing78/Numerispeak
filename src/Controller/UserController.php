<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\IUserService;
use App\Controller\RoleController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api/users')]
class UserController extends AbstractController
{
    private $userService;
    private $roleController;

    public function __construct(IUserService $userService, RoleController $roleController){
        $this->userService=$userService;
        $this->roleController=$roleController;
    }
    /**
     * Get user list
     */
    #[Route('/', name: 'api_users_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $userList=$this->userService->findAll();
        return $this->json($userList);
    }
    /**
     * Add a user
     */
    #[Route('/', name: 'api_users_new', methods: ['POST'])]
    public function new(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $role=$this->roleController->getRole("ROLE_USER");
        // Créer objet
        $user = new User();
        $user=$user->setRole($role);
        // Met les champs saisie avec (form.) dans $form
        $form = $this->createForm(UserType::class, $user);
        // verifie si le submit a été utilisé
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // hasPassword : 1er argument : instance class, 2e argument, mdp en clair
            $hashedPassword = $passwordHasher->hashPassword($user,$user->getPassword());
            $user->setPassword($hashedPassword);
            $this->userService->addUser($user);
            return new JsonResponse(['status'=>'User created'], JsonResponse::HTTP_CREATED);
        }
    }
    /**
     * Show a user
     */
    #[Route('/{id}', name: 'api_users_show', methods: ['GET'])]
    public function show(User $user): JsonResponse
    {
       $userItem=$this->userService->showUserById($user);
        return $this->json($userItem);
    }
    /**
     * Edit a user
     */
    #[Route('/{id}', name: 'api_users_edit', methods: ['PATCH'])]
    public function edit(Request $request, User $user): JsonResponse
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->updateUser();
            return new JsonResponse(['status'=>'User changed'], JsonRepsonse::HTTP_ACCEPTED);
        }


    }
    /**
     * Delete a user
     */
    #[Route('/{id}', name: 'app_user_delete', methods: ['DELETE'])]
    public function delete(Request $request, User $user): JsonResponse
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $this->userService->deleteUser($user);
        }
        return new JsonResponse(['status'=>'User removed'], JsonResponse::HTTP_ACCEPTED);
    }
}
