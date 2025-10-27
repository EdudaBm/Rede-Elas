<?php
// app/Models/ChatRoom.php - Model de salas de chat

namespace Models;

<<<<<<< HEAD
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
=======
class ChatRoom {
    private $db;
    
    public function __construct() {
        $this->db = \Database::getInstance()->getConnection();
    }
    
    public function create($userId, $userName) {
        $stmt = $this->db->prepare("
            INSERT INTO chat_rooms (user_id, user_name, status) 
            VALUES (?, ?, 'waiting')
        ");
        
        $stmt->execute([$userId, $userName]);
        return $this->db->lastInsertId();
    }
    
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM chat_rooms WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function getByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT * FROM chat_rooms 
            WHERE user_id = ? 
            ORDER BY created_at DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
    
    public function getWaiting() {
        $stmt = $this->db->query("
            SELECT * FROM chat_rooms 
            WHERE status = 'waiting' 
            ORDER BY created_at ASC
        ");
        return $stmt->fetchAll();
    }
    
    public function getActive() {
        $stmt = $this->db->query("
            SELECT * FROM chat_rooms 
            WHERE status = 'active' 
            ORDER BY updated_at DESC
        ");
        return $stmt->fetchAll();
    }
    
    public function assignVolunteer($id, $volunteerId, $volunteerName) {
        $stmt = $this->db->prepare("
            UPDATE chat_rooms 
            SET volunteer_id = ?, volunteer_name = ?, status = 'active' 
            WHERE id = ?
        ");
        return $stmt->execute([$volunteerId, $volunteerName, $id]);
    }
    
    public function close($id) {
        $stmt = $this->db->prepare("UPDATE chat_rooms SET status = 'closed' WHERE id = ?");
        return $stmt->execute([$id]);
>>>>>>> 4a84a3764cdeb97fa46841006fd33cb274d56da3
    }
}
