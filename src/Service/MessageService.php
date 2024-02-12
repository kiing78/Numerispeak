<?php


namespace App\Service;

use App\Repository\MessageRepository;
use App\Entity\Message;

class MessageService implements IMessageService{
    private $messageRepository;
    public function __construct(MessageRepository $messageRepository){
        $this->messageRepository=$messageRepository;
    }
    /**
     * Get message list
     */
    public function getMessageList():array{
        return $this->messageRepository->findAll();
    }
    /**
     * Add a message
     */
    public function addMessage(Message $message){
        $this->messageRepository->addMessage($message);
    }
    /**
     * Show a message
     */
    public function showMessage(Message $message):Message{
        return $this->messageRepository->find($message->getId());
    }
    /**
     * Edit a message
     */
    public function editMessage(){
        $this->messageRepository->updateMessage();
    }
    /**
     * Delete a message
     */
    public function deleteMessage(Message $message){
        $this->messageRepository->deleteMessage($message);
    }


}