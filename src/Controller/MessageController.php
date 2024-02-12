<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Service\IMessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api/messages')]
class MessageController extends AbstractController
{
    private $messageService;
    public function __construct(IMessageService $messageService){
        $this->messageService=$messageService;
    }
    /**
     * Get message list
     */
    #[Route('/', name: 'api_message_index', methods: ['GET'])]
    public function index(MessageRepository $messageRepository): JsonResponse
    {
        $messageList=$this->messageService->getMessageList();
        return $this->json($messageList);
    }
    /**
     * Add a message
     */
    #[Route('/', name: 'api_message_new', methods: ['POST'])]
    public function new(Request $request): JsonResponse
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageService->addSubject($message);
            return new JsonResponse(['status'=>'Message created'], JsonResponse::HTTP_CREATED);
        }
    }
    /**
     * Show a message
     */
    #[Route('/{id}', name: 'api_message_show', methods: ['GET'])]
    public function show(Message $message): JsonResponse
    {
        $messageItem=$this->messageService->showMessage($message);
        return $this->json($messageItem);
    }
    /**
     * Edit a message
     */
    #[Route('/{id}', name: 'api_message_edit', methods: ['PATCH'])]
    public function edit(Request $request, Message $message): JsonResponse
    {
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageService->editMessage();
            return new JsonResponse(['status'=>'Message changed'], JsonRepsonse::HTTP_ACCEPTED);
        }
    }
    /**
     * Delete a message
     */
    #[Route('/{id}', name: 'api_message_delete', methods: ['DELETE'])]
    public function delete(Request $request, Message $message): JsonResponse
    {
        if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->request->get('_token'))) {
            $this->messageService->deleteMessage($message);
        }
        return new JsonResponse(['status'=>'Message removed'], JsonResponse::HTTP_ACCEPTED);
    }
}
