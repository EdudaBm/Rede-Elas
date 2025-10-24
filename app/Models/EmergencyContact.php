<?php
// app/Models/EmergencyContact.php - Model de contatos de emergência

namespace Models;

class EmergencyContact {
    private $db;
    
    public function __construct() {
        $this->db = \Database::getInstance()->getConnection();
    }
    
    public function create($userId, $contactName, $contactPhone, $contactRelationship, $isPrimary = false) {
        // Se este contato for marcado como principal, desmarcar outros
        if ($isPrimary) {
            $this->unsetPrimary($userId);
        }
        
        $stmt = $this->db->prepare("
            INSERT INTO emergency_contacts (user_id, contact_name, contact_phone, contact_relationship, is_primary) 
            VALUES (?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([$userId, $contactName, $contactPhone, $contactRelationship, $isPrimary]);
        return $this->db->lastInsertId();
    }
    
    public function getByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT * FROM emergency_contacts 
            WHERE user_id = ? 
            ORDER BY is_primary DESC, created_at ASC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
    
    public function getPrimaryByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT * FROM emergency_contacts 
            WHERE user_id = ? AND is_primary = TRUE 
            LIMIT 1
        ");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }
    
    public function update($id, $contactName, $contactPhone, $contactRelationship, $isPrimary = false) {
        // Buscar o contato para obter o user_id
        $contact = $this->findById($id);
        if (!$contact) {
            return false;
        }
        
        // Se este contato for marcado como principal, desmarcar outros
        if ($isPrimary) {
            $this->unsetPrimary($contact['user_id']);
        }
        
        $stmt = $this->db->prepare("
            UPDATE emergency_contacts 
            SET contact_name = ?, contact_phone = ?, contact_relationship = ?, is_primary = ?
            WHERE id = ?
        ");
        
        return $stmt->execute([$contactName, $contactPhone, $contactRelationship, $isPrimary, $id]);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM emergency_contacts WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM emergency_contacts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    private function unsetPrimary($userId) {
        $stmt = $this->db->prepare("
            UPDATE emergency_contacts 
            SET is_primary = FALSE 
            WHERE user_id = ?
        ");
        $stmt->execute([$userId]);
    }
    
    public function setPrimary($id) {
        // Buscar o contato para obter o user_id
        $contact = $this->findById($id);
        if (!$contact) {
            return false;
        }
        
        // Desmarcar outros contatos como principais
        $this->unsetPrimary($contact['user_id']);
        
        // Marcar este como principal
        $stmt = $this->db->prepare("
            UPDATE emergency_contacts 
            SET is_primary = TRUE 
            WHERE id = ?
        ");
        
        return $stmt->execute([$id]);
    }
}
