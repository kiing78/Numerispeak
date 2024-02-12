<?php

namespace App\Service;
use App\Entity\Subject;

interface ISubjectService{
    public function addSubject(Subject $subject);
    public function getSubjectList(): array;
    public function editSubject();
    public function deleteSubject(Subject $subject);


}