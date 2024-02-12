<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Service\ISubjectService;
use App\Form\SubjectType;
use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api/subjects')]
class SubjectController extends AbstractController
{
    private $subjectService;

    public function __construct(ISubjectService $subjectService){
        $this->subjectService=$subjectService;
    }
    /**
     * Get subject list
     */
    #[Route('/', name: 'api_subject_index', methods: ['GET'])]
    public function index(SubjectRepository $subjectRepository): JsonResponse
    {
        $subjectList=$this->subjectService->getSubjectList();
        return $this->json($subjectList);
    }
    /**
     * Add a subject
     */
    #[Route('/', name: 'api_subject_new', methods: ['POST'])]
    public function new(Request $request): JsonResponse
    {
        $subject = new Subject();
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->subjectService->addSubject($subject);
            // return $this->redirectToRoute('app_subject_index', [], Response::HTTP_SEE_OTHER);
            return new JsonResponse(['status'=>'Subject created'], JsonResponse::HTTP_CREATED);
        }
    }

    // #[Route('/{id}', name: 'appisubject_show', methods: ['GET'])]
    // public function show(Subject $subject): Response
    // {
    //     return $this->render('subject/show.html.twig', [
    //         'subject' => $subject,
    //     ]);
    // }
        /**
         * Edit a subject
         */
    #[Route('/{id}', name: 'api_subject_edit', methods: ['PATCH'])]
    public function edit(Request $request, Subject $subject): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->subjectService->editSubject();
            return new JsonResponse(['status'=>'Subject changed'], JsonRepsonse::HTTP_ACCEPTED);
        }

        return $this->render('subject/edit.html.twig', [
            'subject' => $subject,
            'form' => $form,
        ]);
    }
    /**
     * Delete a subject
     */
    #[Route('/{id}', name: 'api_subject_delete', methods: ['DELETE'])]
    public function delete(Request $request, Subject $subject): JsonResponse
    {
        //Uniquement l'admin pourra executer le code suivant
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete'.$subject->getId(), $request->request->get('_token'))) {
            $this->subjectService->deleteSubject($subject);
        }
        return new JsonResponse(['status'=>'Subject removed'], JsonResponse::HTTP_ACCEPTED);
    }
}
