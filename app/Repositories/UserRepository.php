<?php
// app/Repositories/UserRepository.php - Repositório para usuários

namespace Repositories;

class UserRepository extends BaseRepository {
    protected $table = 'users';
    
    /**
     * Buscar usuário por username
     */
    public function findByUsername($username) {
        return $this->fetch("SELECT * FROM users WHERE username = ?", [$username]);
    }
    
    /**
     * Criar usuário com hash de senha
     */
    public function createUser($username, $password, $role = 'user', $isAnonymous = false) {
        $hashedPassword = $password ? password_hash($password, PASSWORD_DEFAULT) : null;
        
        return $this->create([
            'username' => $username,
            'password' => $hashedPassword,
            'role' => $role,
            'is_anonymous' => $isAnonymous
        ]);
    }
    
    /**
     * Verificar senha
     */
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
    
    /**
     * Atualizar credenciais do usuário
     */
    public function updateCredentials($id, $username, $password) {
        $hashedPassword = $password ? password_hash($password, PASSWORD_DEFAULT) : null;
        
        return $this->update($id, [
            'username' => $username,
            'password' => $hashedPassword,
            'is_anonymous' => false
        ]);
    }
    
    /**
     * Buscar usuários por role
     */
    public function findByRole($role) {
        return $this->fetchAll("SELECT * FROM users WHERE role = ? ORDER BY created_at DESC", [$role]);
    }
    
    /**
     * Buscar usuários anônimos
     */
    public function findAnonymous() {
        return $this->fetchAll("SELECT * FROM users WHERE is_anonymous = TRUE ORDER BY created_at DESC");
    }
}
