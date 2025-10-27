<?php
// app/Models/Article.php - Model de artigos do blog

namespace Models;

<<<<<<< HEAD
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
=======
class Article {
    private $db;

    public function __construct() {
        $this->db = \Database::getInstance()->getConnection();
    }

    public function create($title, $slug, $excerpt, $content, $coverImage, $authorId, $authorName, $isPublished) {
        $stmt = $this->db->prepare("
            INSERT INTO articles (title, slug, excerpt, content, cover_image, author_id, author_name, is_published, published_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, CASE WHEN ? THEN CURRENT_TIMESTAMP ELSE NULL END)
        ");
        $stmt->execute([$title, $slug, $excerpt, $content, $coverImage, $authorId, $authorName, $isPublished, $isPublished]);
        return $this->db->lastInsertId();
    }

    public function update($id, $title, $slug, $excerpt, $content, $coverImage, $isPublished) {
        $stmt = $this->db->prepare("
            UPDATE articles 
            SET title = ?, slug = ?, excerpt = ?, content = ?, cover_image = ?, is_published = ?,
                published_at = CASE WHEN ? THEN COALESCE(published_at, CURRENT_TIMESTAMP) ELSE NULL END
            WHERE id = ?
        ");
        return $stmt->execute([$title, $slug, $excerpt, $content, $coverImage, $isPublished, $isPublished, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM articles WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getPublished($limit = 20) {
        $stmt = $this->db->prepare("
            SELECT * FROM articles 
            WHERE is_published = 1 
            ORDER BY COALESCE(published_at, created_at) DESC 
            LIMIT ?
        ");
        $stmt->bindValue(1, (int)$limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE slug = ? AND is_published = 1");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAll($limit = 100) {
        $stmt = $this->db->prepare("SELECT * FROM articles ORDER BY updated_at DESC LIMIT ?");
        $stmt->bindValue(1, (int)$limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
>>>>>>> 4a84a3764cdeb97fa46841006fd33cb274d56da3
    }
}


