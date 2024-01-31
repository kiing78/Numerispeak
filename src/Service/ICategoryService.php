<?php

namespace App\Service;

use App\Entity\Category;

interface ICategoryService{
    public function getCategory():array;
    public function addCategory(Category $category);
}