<?php
// app/Models/User.php - Model de usuário

namespace Models;

use Repositories\RepositoryManager;

class User {
    private $userRepo;
    
    public function __construct() {
        $this->userRepo = RepositoryManager::getInstance()->user();
    }
    
    public function create($username, $password, $role = 'user', $isAnonymous = false) {
        return $this->userRepo->createUser($username, $password, $role, $isAnonymous);
    }
    
    public function findByUsername($username) {
        return $this->userRepo->findByUsername($username);
    }
    
    public function findById($id) {
        return $this->userRepo->findById($id);
    }
    
    public function verifyPassword($password, $hash) {
        return $this->userRepo->verifyPassword($password, $hash);
    }

    public function updateCredentials($id, $username, $password) {
        return $this->userRepo->updateCredentials($id, $username, $password);
    }
}
