<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ICategoryService;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api/categories')]
class CategoryController extends AbstractController
{
    private $categoryService;

    public function __construct(ICategoryService $categoryService){
        $this->categoryService=$categoryService;
    }


    #[Route('/', name: 'api_category_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $categoryList=$this->categoryService->getCategory();
        return $this->json($categoryList);

    }

    /**
     * Add a category in database
     */
    #[Route('/', name: 'api_category_new', methods: ['POST'])]
    public function new(Request $request): JsonResponse
    {   
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryService->addCategory($category);
            // JsonResponse::HTTP_CREATE : indique le code 201
            return new JsonResponse(['status'=>'Category created'], JsonResponse::HTTP_CREATED);

        }
    }

    // #[Route('/{id}', name: 'api_category_show', methods: ['GET'])]
    // public function show(Category $category): Response
    // {
    //     return $this->render('category/show.html.twig', [
    //         'category' => $category,
    //     ]);
    // }

    // la logique d'affichage :GET et la logique de soumission : PUT
    #[Route('/{id}', name: 'api_category_edit', methods: ['PUT'])]
    public function edit(Request $request, Category $category): JsonResponse
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryService->updateCategory();
            return new JsonResponse(['status'=>'Category changed'], JsonRepsonse::HTTP_ACCEPTED);
        }
        // la logique pour GET pour avoir le formulaire et soumission de formulaire invalide
        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'api_category_delete', methods: ['DELETE'])]
    public function delete(Request $request, Category $category): JsonResponse
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $this->categoryService->deleteCategory($category);
            return new JsonResponse(['status'=>'Category removed'], JsonResponse::HTTP_ACCEPTED);
        }
    }
}
