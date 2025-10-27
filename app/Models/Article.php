<?php
// app/Models/Article.php - Model de artigos do blog

namespace Models;

use Repositories\RepositoryManager;

class Article {
    private $articleRepo;

    public function __construct() {
        $this->articleRepo = RepositoryManager::getInstance()->article();
    }

    public function create($title, $slug, $excerpt, $content, $coverImage, $authorId, $authorName, $isPublished) {
        return $this->articleRepo->createArticle($title, $slug, $excerpt, $content, $coverImage, $authorId, $authorName, $isPublished);
    }

    public function update($id, $title, $slug, $excerpt, $content, $coverImage, $isPublished) {
        return $this->articleRepo->updateArticle($id, $title, $slug, $excerpt, $content, $coverImage, $isPublished);
    }

    public function delete($id) {
        return $this->articleRepo->delete($id);
    }

    public function getPublished($limit = 20) {
        return $this->articleRepo->getPublished($limit);
    }

    public function findBySlug($slug) {
        return $this->articleRepo->findBySlug($slug);
    }

    public function findById($id) {
        return $this->articleRepo->findById($id);
    }

    public function getAll($limit = 100) {
        return $this->articleRepo->findAll($limit);
    }
}


