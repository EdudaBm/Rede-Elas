<?php
// app/Models/Message.php - Model de mensagens

namespace Models;

use Repositories\RepositoryManager;

class Message {
    private $messageRepo;
    
    public function __construct() {
        $this->messageRepo = RepositoryManager::getInstance()->message();
    }
    
    public function create($chatRoomId, $senderId, $senderName, $senderRole, $content) {
        return $this->messageRepo->createMessage($chatRoomId, $senderId, $senderName, $senderRole, $content);
    }
    
    public function getByChatRoom($chatRoomId) {
        return $this->messageRepo->getByChatRoom($chatRoomId);
    }
    
    public function getByChatRoomSince($chatRoomId, $sinceId = 0) {
        return $this->messageRepo->getByChatRoomSince($chatRoomId, $sinceId);
    }
}
