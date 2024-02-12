<?php

namespace App\Controller;

use App\Entity\Role;
use App\Form\RoleType;
// use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\IRoleService;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api/roles')]
class RoleController extends AbstractController
{
    private $roleService;

    public function __construct(IRoleService $roleService){
        $this->roleService = $roleService;
    }
    /**
     * Get role list
     */
    #[Route('/', name: 'api_role_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $roleList=$this->roleService->findAll();
        return $this->json($roleList);
    }
    /**
     * Add a role
     */
    #[Route('/', name: 'api_role_new', methods: ['POST'])]
    public function new(Request $request): JsonResponse
    {
        $role = new Role();
        // createForm: Créer un formulaire pour l'objet $role
        // RoleType dans le dossier Form, cette classe
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->roleService->addRole($role);
            return new JsonResponse(['status'=>'Role created'], JsonResponse::HTTP_CREATED);

        }
    }
    /**
     * Show a role
     */
    #[Route('/{id}', name: 'api_role_show', methods: ['GET'])]
    public function show(Role $role): JsonResponse
    {
        $roleItem=$this->roleService->showRole($role);
        return $this->json($roleItem);
    }
    /**
     * Edit a role
     */
    #[Route('/{id}', name: 'api_role_edit', methods: ['PUT'])]
    public function edit(Request $request, Role $role, EntityManagerInterface $entityManager): JsonResponse
    {
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->roleService->updateRole();
            return new JsonResponse(['status'=>'Role changed'], JsonRepsonse::HTTP_ACCEPTED);
        }
    }
    /**
     * Delete a role
     */
    #[Route('/{id}', name: 'api_role_delete', methods: ['DELETE'])]
    public function delete(Request $request, Role $role, EntityManagerInterface $entityManager): JsonResponse
    {
        if ($this->isCsrfTokenValid('delete'.$role->getId(), $request->request->get('_token'))) {
            $this->roleService->deleteRole($role);
        }
        return new JsonResponse(['status'=>'Role removed'], JsonResponse::HTTP_ACCEPTED);
    }

    public function getRole(string $user):Role{
        return $this->roleService->getRole($user);

    }
}
