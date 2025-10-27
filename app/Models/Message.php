<?php
// app/Models/Message.php - Model de mensagens

namespace Models;

<<<<<<< HEAD
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
=======
class Message {
    private $db;
    
    public function __construct() {
        $this->db = \Database::getInstance()->getConnection();
    }
    
    public function create($chatRoomId, $senderId, $senderName, $senderRole, $content) {
        $stmt = $this->db->prepare("
            INSERT INTO messages (chat_room_id, sender_id, sender_name, sender_role, content) 
            VALUES (?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([$chatRoomId, $senderId, $senderName, $senderRole, $content]);
        return $this->db->lastInsertId();
    }
    
    public function getByChatRoom($chatRoomId) {
        $stmt = $this->db->prepare("
            SELECT * FROM messages 
            WHERE chat_room_id = ? 
            ORDER BY created_at ASC
        ");
        $stmt->execute([$chatRoomId]);
        return $stmt->fetchAll();
    }
    
    public function getByChatRoomSince($chatRoomId, $sinceId = 0) {
        $stmt = $this->db->prepare("
            SELECT * FROM messages 
            WHERE chat_room_id = ? AND id > ? 
            ORDER BY created_at ASC
        ");
        $stmt->execute([$chatRoomId, $sinceId]);
        return $stmt->fetchAll();
>>>>>>> 4a84a3764cdeb97fa46841006fd33cb274d56da3
    }
}
