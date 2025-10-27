<?php
// app/Controllers/ChatController.php - Controlador de chat

namespace Controllers;

use Core\Controller;
use Models\ChatRoom;
use Models\Message;
<<<<<<< HEAD
use Models\User;
=======
>>>>>>> 4a84a3764cdeb97fa46841006fd33cb274d56da3

class ChatController extends Controller {
    private $chatRoomModel;
    private $messageModel;
<<<<<<< HEAD
    private $userModel;
=======
>>>>>>> 4a84a3764cdeb97fa46841006fd33cb274d56da3
    
    public function __construct() {
        $this->chatRoomModel = new ChatRoom();
        $this->messageModel = new Message();
<<<<<<< HEAD
        $this->userModel = new User();
=======
>>>>>>> 4a84a3764cdeb97fa46841006fd33cb274d56da3
    }
    
    public function index() {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        if ($user['role'] === 'volunteer' || $user['role'] === 'admin') {
            $waitingChats = $this->chatRoomModel->getWaiting();
            $activeChats = $this->chatRoomModel->getActive();
            
            $this->view('conversa/volunteer-index', [
                'user' => $user,
                'waitingChats' => $waitingChats,
                'activeChats' => $activeChats
            ]);
        } else {
            $userChats = $this->chatRoomModel->getByUserId($user['id']);
            
            $this->view('conversa/user-index', [
                'user' => $user,
                'chats' => $userChats
            ]);
        }
    }
    
    public function show($id) {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        $chatRoom = $this->chatRoomModel->findById($id);
        if (!$chatRoom) {
            $this->redirect('/conversa');
        }
        
        $messages = $this->messageModel->getByChatRoom($id);
        
        $this->view('conversa/show', [
            'user' => $user,
            'chatRoom' => $chatRoom,
            'messages' => $messages
        ]);
    }
    
    public function create() {
        $this->requireAuth();
<<<<<<< HEAD
        
        // Validar se a sessão do usuário é válida
        if (!$this->validateUserSession()) {
            $_SESSION['error'] = 'Sessão inválida. Faça login novamente.';
            $this->redirect('/login');
        }
        
        $user = $this->getCurrentUser();
=======
        $user = $this->getCurrentUser();
        
>>>>>>> 4a84a3764cdeb97fa46841006fd33cb274d56da3
        $chatId = $this->chatRoomModel->create($user['id'], $user['username']);
        $this->redirect("/conversa/{$chatId}");
    }
    
    public function sendMessage($id) {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        $content = $_POST['content'] ?? '';
        if (empty($content)) {
            $this->json(['error' => 'Mensagem vazia'], 400);
        }
        
        $chatRoom = $this->chatRoomModel->findById($id);
        if (!$chatRoom) {
            $this->json(['error' => 'Chat não encontrado'], 404);
        }
        
        // Se for voluntária e o chat está em espera, aceitar automaticamente
        if (($user['role'] === 'volunteer' || $user['role'] === 'admin') && $chatRoom['status'] === 'waiting') {
            $this->chatRoomModel->assignVolunteer($id, $user['id'], $user['username']);
        }
        
        $this->messageModel->create($id, $user['id'], $user['username'], $user['role'], $content);
        $this->json(['success' => true]);
    }
    
    public function acceptChat($id) {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        if ($user['role'] !== 'volunteer' && $user['role'] !== 'admin') {
            $this->json(['error' => 'Sem permissão'], 403);
        }
        
        $this->chatRoomModel->assignVolunteer($id, $user['id'], $user['username']);
        $this->redirect("/conversa/{$id}");
    }
    
    public function closeChat($id) {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        if ($user['role'] !== 'volunteer' && $user['role'] !== 'admin') {
            $this->json(['error' => 'Sem permissão'], 403);
        }
        
        $this->chatRoomModel->close($id);
        $this->json(['success' => true]);
    }
    
    public function getMessages($id) {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        $chatRoom = $this->chatRoomModel->findById($id);
        if (!$chatRoom) {
            $this->json(['error' => 'Chat não encontrado'], 404);
        }
        
        // Verificar se o usuário tem acesso ao chat
        $hasAccess = false;
        if ($user['role'] === 'user' && $chatRoom['user_id'] == $user['id']) {
            $hasAccess = true;
        } elseif (($user['role'] === 'volunteer' || $user['role'] === 'admin') && 
                  ($chatRoom['volunteer_id'] == $user['id'] || $chatRoom['status'] === 'waiting')) {
            $hasAccess = true;
        }
        
        if (!$hasAccess) {
            $this->json(['error' => 'Sem permissão'], 403);
        }
        
        $since = $_GET['since'] ?? 0;
        $messages = $this->messageModel->getByChatRoomSince($id, $since);
        
        $this->json(['messages' => $messages]);
    }
    
    public function finishChat($id) {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        
        $chatRoom = $this->chatRoomModel->findById($id);
        if (!$chatRoom) {
            $this->json(['error' => 'Chat não encontrado'], 404);
        }
        
        // Verificar se o usuário tem permissão para finalizar o chat
        $canFinish = false;
        if ($user['role'] === 'user' && $chatRoom['user_id'] == $user['id']) {
            $canFinish = true;
        } elseif (($user['role'] === 'volunteer' || $user['role'] === 'admin') && $chatRoom['volunteer_id'] == $user['id']) {
            $canFinish = true;
        }
        
        if (!$canFinish) {
            $this->json(['error' => 'Sem permissão para finalizar este chat'], 403);
        }
        
        // Verificar se o chat pode ser finalizado (deve estar ativo)
        if ($chatRoom['status'] !== 'active') {
            $this->json(['error' => 'Apenas chats ativos podem ser finalizados'], 400);
        }
        
        // Finalizar o chat
        $this->chatRoomModel->close($id);
        $this->json(['success' => true, 'message' => 'Chat finalizado com sucesso']);
    }
}
