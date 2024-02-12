<?php

namespace App\Service;

use App\Entity\Message;

interface IMessageService{

    public function getMessageList():array;
    public function addMessage(Message $message);
    public function editMessage();
    public function deleteMessage(Message $message);
    public function showMessage(Message $message):Message;

}