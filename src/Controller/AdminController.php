<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\CategoryController;

#[Route("/admin")]
class AdminController extends AbstractController
{
    private $categoryController;

    public function __construct(CategoryController $categoryController){
        $this->categoryController=$categoryController;
    }
    /**
     * Display dashboard admin
     */
    #[Route('/', name: 'app_admin')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN',null,"L'utilisateur essaye d'accéder à une page non autorisé");

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/user', name: 'app_admin_user')]
    public function userSpace():Response{
        return $this->render('admin/user.html.twig');
    }

    /**
     * Display category list on category admin space
     */
    #[Route("/category", name: "app_admin_category")]
    public function categorySpace():Response{
        $categoryList = $this->categoryController->indexCategoryAdmin();
        return $this->render("admin/category.html.twig",[
            'categoryList' => $categoryList
        ]);
    }

   
}
