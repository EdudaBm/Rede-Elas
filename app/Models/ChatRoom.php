<?php
// app/Models/ChatRoom.php - Model de salas de chat

namespace Models;

use Repositories\RepositoryManager;

class ChatRoom {
    private $chatRoomRepo;
    
    public function __construct() {
        $this->chatRoomRepo = RepositoryManager::getInstance()->chatRoom();
    }
    
    public function create($userId, $userName) {
        return $this->chatRoomRepo->createChatRoom($userId, $userName);
    }
    
    public function findById($id) {
        return $this->chatRoomRepo->findById($id);
    }
    
    public function getByUserId($userId) {
        return $this->chatRoomRepo->getByUserId($userId);
    }
    
    public function getWaiting() {
        return $this->chatRoomRepo->getWaiting();
    }
    
    public function getActive() {
        return $this->chatRoomRepo->getActive();
    }
    
    public function assignVolunteer($id, $volunteerId, $volunteerName) {
        return $this->chatRoomRepo->assignVolunteer($id, $volunteerId, $volunteerName);
    }
    
    public function close($id) {
        return $this->chatRoomRepo->close($id);
    }
}
