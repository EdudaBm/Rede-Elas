<?php
// app/Repositories/ChatRoomRepository.php - Repositório para salas de chat

namespace Repositories;

class ChatRoomRepository extends BaseRepository {
    protected $table = 'chat_rooms';
    
    /**
     * Criar sala de chat
     */
    public function createChatRoom($userId, $userName) {
        return $this->create([
            'user_id' => $userId,
            'user_name' => $userName,
            'status' => 'waiting'
        ]);
    }
    
    /**
     * Buscar salas por usuário
     */
    public function getByUserId($userId) {
        return $this->fetchAll("
            SELECT * FROM chat_rooms 
            WHERE user_id = ? 
            ORDER BY created_at DESC
        ", [$userId]);
    }
    
    /**
     * Buscar salas em espera
     */
    public function getWaiting() {
        return $this->fetchAll("
            SELECT * FROM chat_rooms 
            WHERE status = 'waiting' 
            ORDER BY created_at ASC
        ");
    }
    
    /**
     * Buscar salas ativas
     */
    public function getActive() {
        return $this->fetchAll("
            SELECT * FROM chat_rooms 
            WHERE status = 'active' 
            ORDER BY updated_at DESC
        ");
    }
    
    /**
     * Buscar salas fechadas
     */
    public function getClosed() {
        return $this->fetchAll("
            SELECT * FROM chat_rooms 
            WHERE status = 'closed' 
            ORDER BY updated_at DESC
        ");
    }
    
    /**
     * Atribuir voluntário à sala
     */
    public function assignVolunteer($id, $volunteerId, $volunteerName) {
        return $this->update($id, [
            'volunteer_id' => $volunteerId,
            'volunteer_name' => $volunteerName,
            'status' => 'active'
        ]);
    }
    
    /**
     * Fechar sala
     */
    public function close($id) {
        return $this->update($id, ['status' => 'closed']);
    }
    
    /**
     * Reabrir sala
     */
    public function reopen($id) {
        return $this->update($id, ['status' => 'waiting']);
    }
    
    /**
     * Buscar salas por voluntário
     */
    public function getByVolunteer($volunteerId) {
        return $this->fetchAll("
            SELECT * FROM chat_rooms 
            WHERE volunteer_id = ? 
            ORDER BY updated_at DESC
        ", [$volunteerId]);
    }
    
    /**
     * Buscar salas por status
     */
    public function getByStatus($status) {
        return $this->fetchAll("
            SELECT * FROM chat_rooms 
            WHERE status = ? 
            ORDER BY created_at DESC
        ", [$status]);
    }
    
    /**
     * Contar salas por status
     */
    public function countByStatus($status) {
        $result = $this->fetch("
            SELECT COUNT(*) as total FROM chat_rooms WHERE status = ?
        ", [$status]);
        return (int)$result['total'];
    }
    
    /**
     * Buscar estatísticas das salas
     */
    public function getStats() {
        return [
            'waiting' => $this->countByStatus('waiting'),
            'active' => $this->countByStatus('active'),
            'closed' => $this->countByStatus('closed'),
            'total' => $this->count()
        ];
    }
}
