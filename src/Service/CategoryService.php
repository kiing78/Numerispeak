<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;

class CategoryService implements ICategoryService{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategory():array{
        return $this->categoryRepository->findAll();
    }
    /**
     * Add category in database
     */
    public function addCategory(Category $category){
        $this->categoryRepository->addCategory($category); 
    }
}