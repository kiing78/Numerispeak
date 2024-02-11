<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;

class CategoryService implements ICategoryService{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * get category list
     */
    public function getCategory():array{
        return $this->categoryRepository->findAll();
    }
    /**
     * Add category item in database
     */
    public function addCategory(Category $category){
        $this->categoryRepository->addCategory($category); 
    }
    /**
     * Update a category item
     */
    public function updateCategory(){
        $this->categoryRepository->updateCategory();
    }
    /**
     * Delete a category item
     */
    public function deleteCategory(Category $category){
        $this->categoryRepository($category);
    }
}