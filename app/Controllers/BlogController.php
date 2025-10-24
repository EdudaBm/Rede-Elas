<?php
// app/Controllers/BlogController.php - Controlador do blog

namespace Controllers;

use Core\Controller;
use Models\Article;

class BlogController extends Controller {
    public function index() {
        $user = $this->getCurrentUser();
        $articleModel = new Article();
        $articles = $articleModel->getPublished(20);
        $this->view('blog/index', [
            'user' => $user,
            'articles' => $articles
        ]);
    }
    
    public function show($slug) {
        $user = $this->getCurrentUser();
        $articleModel = new Article();
        $article = $articleModel->findBySlug($slug);
        if (!$article) {
            http_response_code(404);
            echo "Artigo não encontrado";
            return;
        }
        $this->view('blog/show', [
            'user' => $user,
            'article' => $article
        ]);
    }
}
