<?php

namespace App\Service;
use App\Entity\Subject;
use App\Repository\SubjectRepository;


class SubjectService implements ISubjectService{

    private $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository){
        $this->subjectRepository=$subjectRepository;
    }
    /**
     * Get subject list
     */
    public function getSubjectList():array{
        return $this->subjectRepository->findAll();
    }
    /**
     * Add a subject
     */
    public function addSubject(Subject $subject){
        $this->subjectRepository->addSubject($subject);
    }
    /**
     * Edit a subject
     */
    public function editSubject(){
        $this->subjectRepository->updateSubject();
    }
    /**
     * Delete a subject
     */
    public function deleteSubject(Subject $subject){
        $this->subjectRepository->deleteSubject($subject);
    }
    
}