<?php
// app/Core/Controller.php - Controlador base

namespace Core;

class Controller {
    protected function view($view, $data = []) {
        extract($data);
        require_once BASE_PATH . "/app/Views/{$view}.php";
    }
    
    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
    
    protected function json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    protected function requireAuth() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
    }
    
    protected function requireAdmin() {
        if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
            $this->redirect('/');
        }
    }
    
    protected function getCurrentUser() {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }
        
        // Garantir que as variáveis de sessão existam
        if (!isset($_SESSION['username'])) {
            $_SESSION['username'] = '';
        }
        if (!isset($_SESSION['user_role'])) {
            $_SESSION['user_role'] = 'user';
        }
        if (!isset($_SESSION['is_anonymous'])) {
            $_SESSION['is_anonymous'] = false;
        }
        
        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'role' => $_SESSION['user_role'],
            'is_anonymous' => $_SESSION['is_anonymous']
        ];
    }
    
    protected function validateUserSession() {
        $user = $this->getCurrentUser();
        if (!$user) {
            return false;
        }
        
        // Verificar se o usuário existe no banco de dados
        $userModel = new \Models\User();
        $existingUser = $userModel->findById($user['id']);
        
        if (!$existingUser) {
            // Usuário não existe mais, limpar sessão
            session_destroy();
            return false;
        }
        
        return true;
    }
}
