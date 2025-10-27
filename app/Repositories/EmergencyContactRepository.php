<?php
// app/Repositories/EmergencyContactRepository.php - Repositório para contatos de emergência

namespace Repositories;

class EmergencyContactRepository extends BaseRepository {
    protected $table = 'emergency_contacts';
    
    /**
     * Criar contato de emergência
     */
    public function createContact($userId, $contactName, $contactPhone, $contactRelationship, $isPrimary = false) {
        // Se este contato for marcado como principal, desmarcar outros
        if ($isPrimary) {
            $this->unsetPrimary($userId);
        }
        
        return $this->create([
            'user_id' => $userId,
            'contact_name' => $contactName,
            'contact_phone' => $contactPhone,
            'contact_relationship' => $contactRelationship,
            'is_primary' => $isPrimary
        ]);
    }
    
    /**
     * Buscar contatos por usuário
     */
    public function getByUserId($userId) {
        return $this->fetchAll("
            SELECT * FROM emergency_contacts 
            WHERE user_id = ? 
            ORDER BY is_primary DESC, created_at ASC
        ", [$userId]);
    }
    
    /**
     * Buscar contato principal por usuário
     */
    public function getPrimaryByUserId($userId) {
        return $this->fetch("
            SELECT * FROM emergency_contacts 
            WHERE user_id = ? AND is_primary = TRUE 
            LIMIT 1
        ", [$userId]);
    }
    
    /**
     * Atualizar contato
     */
    public function updateContact($id, $contactName, $contactPhone, $contactRelationship, $isPrimary = false) {
        // Buscar o contato para obter o user_id
        $contact = $this->findById($id);
        if (!$contact) {
            return false;
        }
        
        // Se este contato for marcado como principal, desmarcar outros
        if ($isPrimary) {
            $this->unsetPrimary($contact['user_id']);
        }
        
        return $this->update($id, [
            'contact_name' => $contactName,
            'contact_phone' => $contactPhone,
            'contact_relationship' => $contactRelationship,
            'is_primary' => $isPrimary
        ]);
    }
    
    /**
     * Definir contato como principal
     */
    public function setPrimary($id) {
        // Buscar o contato para obter o user_id
        $contact = $this->findById($id);
        if (!$contact) {
            return false;
        }
        
        // Desmarcar outros contatos como principais
        $this->unsetPrimary($contact['user_id']);
        
        // Marcar este como principal
        return $this->update($id, ['is_primary' => true]);
    }
    
    /**
     * Desmarcar contatos principais de um usuário
     */
    private function unsetPrimary($userId) {
        $stmt = $this->db->prepare("
            UPDATE emergency_contacts 
            SET is_primary = FALSE 
            WHERE user_id = ?
        ");
        return $stmt->execute([$userId]);
    }
    
    /**
     * Buscar contatos por relacionamento
     */
    public function getByRelationship($relationship) {
        return $this->fetchAll("
            SELECT * FROM emergency_contacts 
            WHERE contact_relationship = ? 
            ORDER BY created_at DESC
        ", [$relationship]);
    }
    
    /**
     * Buscar contatos principais
     */
    public function getPrimaryContacts() {
        return $this->fetchAll("
            SELECT * FROM emergency_contacts 
            WHERE is_primary = TRUE 
            ORDER BY created_at DESC
        ");
    }
    
    /**
     * Contar contatos por usuário
     */
    public function countByUserId($userId) {
        $result = $this->fetch("
            SELECT COUNT(*) as total FROM emergency_contacts WHERE user_id = ?
        ", [$userId]);
        return (int)$result['total'];
    }
    
    /**
     * Verificar se usuário tem contato principal
     */
    public function hasPrimaryContact($userId) {
        $result = $this->fetch("
            SELECT COUNT(*) as total FROM emergency_contacts 
            WHERE user_id = ? AND is_primary = TRUE
        ", [$userId]);
        return (int)$result['total'] > 0;
    }
    
    /**
     * Buscar contatos por telefone
     */
    public function findByPhone($phone) {
        return $this->fetchAll("
            SELECT * FROM emergency_contacts 
            WHERE contact_phone = ? 
            ORDER BY created_at DESC
        ", [$phone]);
    }
}
