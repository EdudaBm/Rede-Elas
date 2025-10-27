<?php
// app/Models/User.php - Model de usuário

namespace Models;

<<<<<<< HEAD
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
=======
class User {
    private $db;
    
    public function __construct() {
        $this->db = \Database::getInstance()->getConnection();
    }
    
    public function create($username, $password, $role = 'user', $isAnonymous = false) {
        $hashedPassword = $password ? password_hash($password, PASSWORD_DEFAULT) : null;
        
        $stmt = $this->db->prepare("
            INSERT INTO users (username, password, role, is_anonymous) 
            VALUES (?, ?, ?, ?)
        ");
        
        $stmt->execute([$username, $hashedPassword, $role, $isAnonymous]);
        return $this->db->lastInsertId();
    }
    
    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
    
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    public function updateCredentials($id, $username, $password) {
        $hashedPassword = $password ? password_hash($password, PASSWORD_DEFAULT) : null;
        $stmt = $this->db->prepare("
            UPDATE users SET username = ?, password = ?, is_anonymous = FALSE WHERE id = ?
        ");
        return $stmt->execute([$username, $hashedPassword, $id]);
>>>>>>> 4a84a3764cdeb97fa46841006fd33cb274d56da3
    }
}
