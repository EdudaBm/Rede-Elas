<?php
// app/Controllers/EmergencyController.php - Controlador de contatos de emergência

namespace Controllers;

use Core\Controller;
use Models\EmergencyContact;

class EmergencyController extends Controller {
    private $emergencyContactModel;
    
    public function __construct() {
        $this->emergencyContactModel = new EmergencyContact();
    }
    
    public function index() {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        $contacts = $this->emergencyContactModel->getByUserId($user['id']);
        
        $this->view('emergency/index', [
            'user' => $user,
            'contacts' => $contacts
        ]);
    }
    
    public function create() {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        $this->view('emergency/create', [
            'user' => $user
        ]);
    }
    
    public function store() {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        $contactName = $_POST['contact_name'] ?? '';
        $contactPhone = $_POST['contact_phone'] ?? '';
        $contactRelationship = $_POST['contact_relationship'] ?? '';
        $isPrimary = isset($_POST['is_primary']);
        
        // Validações
        if (empty($contactName) || empty($contactPhone) || empty($contactRelationship)) {
            $_SESSION['error'] = 'Todos os campos são obrigatórios';
            $this->redirect('/emergency/create');
        }
        
        // Validar telefone (formato básico)
        if (!preg_match('/^[\d\s\-\+\(\)]+$/', $contactPhone)) {
            $_SESSION['error'] = 'Formato de telefone inválido';
            $this->redirect('/emergency/create');
        }
        
        // Validar relacionamento
        $allowedRelationships = ['Família', 'Amigo(a)', 'Cônjuge', 'Pai/Mãe', 'Irmão(ã)', 'Outro'];
        if (!in_array($contactRelationship, $allowedRelationships)) {
            $_SESSION['error'] = 'Tipo de relacionamento inválido';
            $this->redirect('/emergency/create');
        }
        
        try {
            $this->emergencyContactModel->create(
                $user['id'],
                $contactName,
                $contactPhone,
                $contactRelationship,
                $isPrimary
            );
            
            $_SESSION['success'] = 'Contato de emergência cadastrado com sucesso';
            $this->redirect('/emergency');
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Erro ao cadastrar contato de emergência';
            $this->redirect('/emergency/create');
        }
    }
    
    public function edit($id) {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        $contact = $this->emergencyContactModel->findById($id);
        if (!$contact || $contact['user_id'] != $user['id']) {
            $_SESSION['error'] = 'Contato não encontrado';
            $this->redirect('/emergency');
        }
        
        $this->view('emergency/edit', [
            'user' => $user,
            'contact' => $contact
        ]);
    }
    
    public function update($id) {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        $contact = $this->emergencyContactModel->findById($id);
        if (!$contact || $contact['user_id'] != $user['id']) {
            $_SESSION['error'] = 'Contato não encontrado';
            $this->redirect('/emergency');
        }
        
        $contactName = $_POST['contact_name'] ?? '';
        $contactPhone = $_POST['contact_phone'] ?? '';
        $contactRelationship = $_POST['contact_relationship'] ?? '';
        $isPrimary = isset($_POST['is_primary']);
        
        // Validações
        if (empty($contactName) || empty($contactPhone) || empty($contactRelationship)) {
            $_SESSION['error'] = 'Todos os campos são obrigatórios';
            $this->redirect('/emergency/edit/' . $id);
        }
        
        // Validar telefone
        if (!preg_match('/^[\d\s\-\+\(\)]+$/', $contactPhone)) {
            $_SESSION['error'] = 'Formato de telefone inválido';
            $this->redirect('/emergency/edit/' . $id);
        }
        
        // Validar relacionamento
        $allowedRelationships = ['Família', 'Amigo(a)', 'Cônjuge', 'Pai/Mãe', 'Irmão(ã)', 'Outro'];
        if (!in_array($contactRelationship, $allowedRelationships)) {
            $_SESSION['error'] = 'Tipo de relacionamento inválido';
            $this->redirect('/emergency/edit/' . $id);
        }
        
        try {
            $this->emergencyContactModel->update(
                $id,
                $contactName,
                $contactPhone,
                $contactRelationship,
                $isPrimary
            );
            
            $_SESSION['success'] = 'Contato de emergência atualizado com sucesso';
            $this->redirect('/emergency');
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Erro ao atualizar contato de emergência';
            $this->redirect('/emergency/edit/' . $id);
        }
    }
    
    public function delete($id) {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        $contact = $this->emergencyContactModel->findById($id);
        if (!$contact || $contact['user_id'] != $user['id']) {
            $_SESSION['error'] = 'Contato não encontrado';
            $this->redirect('/emergency');
        }
        
        try {
            $this->emergencyContactModel->delete($id);
            $_SESSION['success'] = 'Contato de emergência removido com sucesso';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Erro ao remover contato de emergência';
        }
        
        $this->redirect('/emergency');
    }
    
    public function setPrimary($id) {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        $contact = $this->emergencyContactModel->findById($id);
        if (!$contact || $contact['user_id'] != $user['id']) {
            $this->json(['error' => 'Contato não encontrado'], 404);
        }
        
        try {
            $this->emergencyContactModel->setPrimary($id);
            $this->json(['success' => true]);
        } catch (\Exception $e) {
            $this->json(['error' => 'Erro ao definir contato principal'], 500);
        }
    }
    
    public function getContacts() {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        $contacts = $this->emergencyContactModel->getByUserId($user['id']);
        $this->json($contacts);
    }
}
