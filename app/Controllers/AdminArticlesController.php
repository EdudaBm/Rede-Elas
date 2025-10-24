<?php
// app/Controllers/AdminArticlesController.php - CRUD de artigos (admin)

namespace Controllers;

use Core\Controller;
use Models\Article;

class AdminArticlesController extends Controller {
    private $articleModel;

    public function __construct() {
        $this->articleModel = new Article();
    }

    public function index() {
        $this->requireAdmin();
        $user = $this->getCurrentUser();
        $articles = $this->articleModel->getAll(200);
        $this->view('admin/articles/index', compact('user', 'articles'));
    }

    public function createForm() {
        $this->requireAdmin();
        $user = $this->getCurrentUser();
        $this->view('admin/articles/create', compact('user'));
    }

    public function create() {
        $this->requireAdmin();
        $title = trim($_POST['title'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $excerpt = trim($_POST['excerpt'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $coverImage = trim($_POST['cover_image'] ?? '');
        $isPublished = isset($_POST['is_published']) ? (bool)$_POST['is_published'] : false;

        if ($title === '' || $slug === '' || $content === '') {
            $_SESSION['error'] = 'Título, slug e conteúdo são obrigatórios.';
            $this->redirect('/admin/articles/create');
        }

        $user = $this->getCurrentUser();
        $this->articleModel->create($title, $slug, $excerpt, $content, $coverImage, $user['id'], $user['username'], $isPublished);
        $_SESSION['success'] = 'Artigo criado com sucesso';
        $this->redirect('/admin/articles');
    }

    public function editForm($id) {
        $this->requireAdmin();
        $user = $this->getCurrentUser();
        $article = $this->articleModel->findById($id);
        if ($article === false) {
            $_SESSION['error'] = 'Artigo não encontrado';
            $this->redirect('/admin/articles');
        }
        $this->view('admin/articles/edit', compact('user', 'article'));
    }

    public function update($id) {
        $this->requireAdmin();
        $title = trim($_POST['title'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $excerpt = trim($_POST['excerpt'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $coverImage = trim($_POST['cover_image'] ?? '');
        $isPublished = isset($_POST['is_published']) ? (bool)$_POST['is_published'] : false;

        if ($title === '' || $slug === '' || $content === '') {
            $_SESSION['error'] = 'Título, slug e conteúdo são obrigatórios.';
            $this->redirect("/admin/articles/{$id}/edit");
        }

        $this->articleModel->update($id, $title, $slug, $excerpt, $content, $coverImage, $isPublished);
        $_SESSION['success'] = 'Artigo atualizado com sucesso';
        $this->redirect('/admin/articles');
    }

    public function delete($id) {
        $this->requireAdmin();
        $this->articleModel->delete($id);
        $_SESSION['success'] = 'Artigo removido';
        $this->redirect('/admin/articles');
    }
}


