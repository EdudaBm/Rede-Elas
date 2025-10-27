<?php
// app/Models/EmergencyContact.php - Model de contatos de emergência

namespace Models;

use Repositories\RepositoryManager;

class EmergencyContact {
    private $emergencyRepo;
    
    public function __construct() {
        $this->emergencyRepo = RepositoryManager::getInstance()->emergencyContact();
    }
    
    public function create($userId, $contactName, $contactPhone, $contactRelationship, $isPrimary = false) {
        return $this->emergencyRepo->createContact($userId, $contactName, $contactPhone, $contactRelationship, $isPrimary);
    }
    
    public function getByUserId($userId) {
        return $this->emergencyRepo->getByUserId($userId);
    }
    
    public function getPrimaryByUserId($userId) {
        return $this->emergencyRepo->getPrimaryByUserId($userId);
    }
    
    public function update($id, $contactName, $contactPhone, $contactRelationship, $isPrimary = false) {
        return $this->emergencyRepo->updateContact($id, $contactName, $contactPhone, $contactRelationship, $isPrimary);
    }
    
    public function delete($id) {
        return $this->emergencyRepo->delete($id);
    }
    
    public function findById($id) {
        return $this->emergencyRepo->findById($id);
    }
    
    public function setPrimary($id) {
        return $this->emergencyRepo->setPrimary($id);
    }
}
