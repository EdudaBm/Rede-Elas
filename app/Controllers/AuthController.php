<?php
// app/Controllers/AuthController.php - Controlador de autenticação

namespace Controllers;

use Core\Controller;
use Models\User;

class AuthController extends Controller {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function showLogin() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/');
        }
        
        $this->view('auth/login');
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }
        
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($username) || empty($password)) {
            $_SESSION['error'] = 'Usuário e senha são obrigatórios';
            $this->redirect('/login');
        }
        
        $user = $this->userModel->findByUsername($username);
        
        if (!$user || !$this->userModel->verifyPassword($password, $user['password'])) {
            $_SESSION['error'] = 'Usuário ou senha inválidos';
            $this->redirect('/login');
        }
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['is_anonymous'] = false;
        
        $this->redirect('/');
    }
    
    public function anonymousLogin() {
        // Reutilizar anônima existente se cookie presente
        if (!empty($_COOKIE['anon_user_id'])) {
            $existing = $this->userModel->findById((int)$_COOKIE['anon_user_id']);
            if ($existing && (int)$existing['is_anonymous'] === 1) {
                $_SESSION['user_id'] = $existing['id'];
                $_SESSION['username'] = $existing['username'];
                $_SESSION['user_role'] = $existing['role'];
                $_SESSION['is_anonymous'] = true;
                $this->redirect('/');
            }
        }

        $username = 'Anônima_' . substr(bin2hex(random_bytes(4)), 0, 8);
        $userId = $this->userModel->create($username, null, 'user', true);

        // Sessão
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['user_role'] = 'user';
        $_SESSION['is_anonymous'] = true;

        // Cookie persistente por 180 dias
        setcookie(
            'anon_user_id',
            (string)$userId,
            [
                'expires' => time() + (60 * 60 * 24 * 180),
                'path' => '/',
                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
                'httponly' => true,
                'samesite' => 'Lax',
            ]
        );

        $this->redirect('/');
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('/');
    }

    public function showRegister() {
        if (isset($_SESSION['user_id']) && !($_SESSION['is_anonymous'] ?? false)) {
            $this->redirect('/');
        }
        $this->view('auth/register');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/register');
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $password2 = $_POST['password2'] ?? '';
        $consent = isset($_POST['consent']);

        if ($username === '' || $password === '' || $password2 === '') {
            $_SESSION['error'] = 'Preencha todos os campos';
            $this->redirect('/register');
        }
        if ($password !== $password2) {
            $_SESSION['error'] = 'As senhas não conferem';
            $this->redirect('/register');
        }
        if (!$consent) {
            $_SESSION['error'] = 'Você deve aceitar os Termos de Uso e Política de Privacidade';
            $this->redirect('/register');
        }
        if ($this->userModel->findByUsername($username)) {
            $_SESSION['error'] = 'Nome de usuário já existe';
            $this->redirect('/register');
        }

        // Se estiver logada como anônima, faz upgrade mantendo histórico
        if (isset($_SESSION['user_id']) && ($_SESSION['is_anonymous'] ?? false)) {
            $this->userModel->updateCredentials($_SESSION['user_id'], $username, $password);
            $_SESSION['username'] = $username;
            $_SESSION['is_anonymous'] = false;
            $_SESSION['success'] = 'Conta criada com sucesso!';
            $this->redirect('/conversa');
        }

        // Nova conta (não anônima)
        $userId = $this->userModel->create($username, $password, 'user', false);
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['user_role'] = 'user';
        $_SESSION['is_anonymous'] = false;
        $_SESSION['success'] = 'Conta criada com sucesso!';
        $this->redirect('/conversa');
    }
}
