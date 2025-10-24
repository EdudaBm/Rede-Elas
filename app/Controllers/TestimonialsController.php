<?php
// app/Controllers/TestimonialsController.php - Controlador de depoimentos

namespace Controllers;

use Core\Controller;
use Models\Testimonial;

class TestimonialsController extends Controller {
    private $testimonialModel;
    
    public function __construct() {
        $this->testimonialModel = new Testimonial();
    }
    
    public function index() {
        $user = $this->getCurrentUser();
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 6;
        $offset = ($page - 1) * $perPage;
        $total = $this->testimonialModel->countApproved();
        $totalPages = max(1, (int)ceil($total / $perPage));

        $testimonials = $this->testimonialModel->getApproved($perPage, $offset);
        
        // Verificar quais depoimentos o usuário já curtiu
        $currentUser = $this->getCurrentUser();
        $userIdentifier = $currentUser ? ('user:' . $currentUser['id']) : session_id();
        $likedTestimonials = [];
        foreach ($testimonials as $testimonial) {
            if ($this->testimonialModel->hasUserLiked($testimonial['id'], $userIdentifier)) {
                $likedTestimonials[] = $testimonial['id'];
            }
        }
        
        $this->view('testimonials/index', [
            'user' => $user,
            'testimonials' => $testimonials,
            'likedTestimonials' => $likedTestimonials,
            'page' => $page,
            'totalPages' => $totalPages,
            'total' => $total,
            'perPage' => $perPage
        ]);
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/depoimentos');
        }
        
        $authorName = $_POST['author_name'] ?? '';
        $content = $_POST['content'] ?? '';
        
        if (empty($authorName) || empty($content)) {
            $_SESSION['error'] = 'Todos os campos são obrigatórios';
            $this->redirect('/depoimentos');
        }
        
        if (strlen($content) > 1000) {
            $_SESSION['error'] = 'O depoimento deve ter no máximo 1000 caracteres';
            $this->redirect('/depoimentos');
        }
        
        $this->testimonialModel->create($authorName, $content);
        $_SESSION['success'] = 'Depoimento enviado! Ele será publicado após moderação.';
        $this->redirect('/depoimentos');
    }
    
    public function like($id) {
        // Se estiver logada, usa ID da usuária; senão, usa a sessão
        $currentUser = $this->getCurrentUser();
        $userIdentifier = $currentUser ? ('user:' . $currentUser['id']) : session_id();
        
        if ($this->testimonialModel->hasUserLiked($id, $userIdentifier)) {
            $this->json(['error' => 'Você já apoiou este depoimento'], 400);
        }
        
        if ($this->testimonialModel->addLike($id, $userIdentifier)) {
            $this->json(['success' => true]);
        } else {
            $this->json(['error' => 'Erro ao apoiar depoimento'], 500);
        }
    }
}
