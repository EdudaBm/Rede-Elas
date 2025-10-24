<?php
// app/Models/User.php - Model de usuário

namespace Models;

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
    }
}
