<?php
// app/Repositories/MessageRepository.php - Repositório para mensagens

namespace Repositories;

class MessageRepository extends BaseRepository {
    protected $table = 'messages';
    
    /**
     * Criar mensagem
     */
    public function createMessage($chatRoomId, $senderId, $senderName, $senderRole, $content) {
        return $this->create([
            'chat_room_id' => $chatRoomId,
            'sender_id' => $senderId,
            'sender_name' => $senderName,
            'sender_role' => $senderRole,
            'content' => $content
        ]);
    }
    
    /**
     * Buscar mensagens por sala de chat
     */
    public function getByChatRoom($chatRoomId) {
        return $this->fetchAll("
            SELECT * FROM messages 
            WHERE chat_room_id = ? 
            ORDER BY created_at ASC
        ", [$chatRoomId]);
    }
    
    /**
     * Buscar mensagens novas desde um ID específico
     */
    public function getByChatRoomSince($chatRoomId, $sinceId = 0) {
        return $this->fetchAll("
            SELECT * FROM messages 
            WHERE chat_room_id = ? AND id > ? 
            ORDER BY created_at ASC
        ", [$chatRoomId, $sinceId]);
    }
    
    /**
     * Buscar última mensagem de uma sala
     */
    public function getLastByChatRoom($chatRoomId) {
        return $this->fetch("
            SELECT * FROM messages 
            WHERE chat_room_id = ? 
            ORDER BY created_at DESC 
            LIMIT 1
        ", [$chatRoomId]);
    }
    
    /**
     * Buscar mensagens por remetente
     */
    public function getBySender($senderId) {
        return $this->fetchAll("
            SELECT * FROM messages 
            WHERE sender_id = ? 
            ORDER BY created_at DESC
        ", [$senderId]);
    }
    
    /**
     * Buscar mensagens por role do remetente
     */
    public function getBySenderRole($senderRole) {
        return $this->fetchAll("
            SELECT * FROM messages 
            WHERE sender_role = ? 
            ORDER BY created_at DESC
        ", [$senderRole]);
    }
    
    /**
     * Buscar mensagens recentes
     */
    public function getRecent($limit = 50) {
        return $this->fetchAll("
            SELECT * FROM messages 
            ORDER BY created_at DESC 
            LIMIT ?
        ", [(int)$limit]);
    }
    
    /**
     * Buscar mensagens com paginação
     */
    public function getPaginated($chatRoomId, $page = 1, $perPage = 20) {
        $offset = ($page - 1) * $perPage;
        
        return $this->fetchAll("
            SELECT * FROM messages 
            WHERE chat_room_id = ? 
            ORDER BY created_at DESC 
            LIMIT ? OFFSET ?
        ", [$chatRoomId, (int)$perPage, (int)$offset]);
    }
    
    /**
     * Contar mensagens por sala
     */
    public function countByChatRoom($chatRoomId) {
        $result = $this->fetch("
            SELECT COUNT(*) as total FROM messages WHERE chat_room_id = ?
        ", [$chatRoomId]);
        return (int)$result['total'];
    }
    
    /**
     * Deletar mensagens de uma sala
     */
    public function deleteByChatRoom($chatRoomId) {
        $stmt = $this->db->prepare("DELETE FROM messages WHERE chat_room_id = ?");
        return $stmt->execute([$chatRoomId]);
    }
    
    /**
     * Buscar mensagens por período
     */
    public function getByDateRange($startDate, $endDate) {
        return $this->fetchAll("
            SELECT * FROM messages 
            WHERE created_at BETWEEN ? AND ? 
            ORDER BY created_at ASC
        ", [$startDate, $endDate]);
    }
}
