<?php
// app/Controllers/AdminController.php - Controlador administrativo

namespace Controllers;

use Core\Controller;
use Models\Testimonial;
use Models\ChatRoom;
use Models\User;

class AdminController extends Controller {
    private $testimonialModel;
    private $chatRoomModel;
    private $userModel;
    
    public function __construct() {
        $this->testimonialModel = new Testimonial();
        $this->chatRoomModel = new ChatRoom();
        $this->userModel = new User();
    }
    
    public function index() {
        $this->requireAdmin();
        $user = $this->getCurrentUser();
        
        $pendingTestimonials = $this->testimonialModel->getPending();
        $approvedTestimonials = $this->testimonialModel->getApproved();
        $waitingChats = $this->chatRoomModel->getWaiting();
        $activeChats = $this->chatRoomModel->getActive();
        
        $this->view('admin/index', [
            'user' => $user,
            'pendingTestimonials' => $pendingTestimonials,
            'approvedTestimonials' => $approvedTestimonials,
            'waitingChats' => $waitingChats,
            'activeChats' => $activeChats
        ]);
    }
    
    public function approveTestimonial($id) {
        $this->requireAdmin();
        
        $this->testimonialModel->approve($id);
        $_SESSION['success'] = 'Depoimento aprovado com sucesso';
        $this->redirect('/admin');
    }
    
    public function rejectTestimonial($id) {
        $this->requireAdmin();
        
        $this->testimonialModel->reject($id);
        $_SESSION['success'] = 'Depoimento rejeitado';
        $this->redirect('/admin');
    }

    // Exclusão de depoimentos aprovados
    public function deleteApprovedTestimonial($id) {
        $this->requireAdmin();
        $this->testimonialModel->reject($id);
        $_SESSION['success'] = 'Depoimento excluído com sucesso';
        $this->redirect('/admin');
    }
    
    // Cadastro de administradores
    public function showRegisterForm() {
        $this->requireAdmin();
        $user = $this->getCurrentUser();
        
        $this->view('admin/register', [
            'user' => $user
        ]);
    }
    
    public function createAdmin() {
        $this->requireAdmin();
        
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'admin';
        
        // Validações
        if (empty($username) || empty($password)) {
            $_SESSION['error'] = 'Todos os campos são obrigatórios';
            $this->redirect('/admin/register');
        }
        
        if (strlen($password) < 6) {
            $_SESSION['error'] = 'A senha deve ter pelo menos 6 caracteres';
            $this->redirect('/admin/register');
        }
        
        // Verificar se o usuário já existe
        $existingUser = $this->userModel->findByUsername($username);
        if ($existingUser) {
            $_SESSION['error'] = 'Nome de usuário já existe';
            $this->redirect('/admin/register');
        }
        
        // Validar role
        $allowedRoles = ['admin', 'volunteer'];
        if (!in_array($role, $allowedRoles)) {
            $_SESSION['error'] = 'Tipo de usuário inválido';
            $this->redirect('/admin/register');
        }
        
        // Criar usuário
        try {
            $this->userModel->create($username, $password, $role, false);
            $_SESSION['success'] = ucfirst($role) . ' cadastrado com sucesso';
            $this->redirect('/admin');
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Erro ao cadastrar usuário';
            $this->redirect('/admin/register');
        }
    }
}
