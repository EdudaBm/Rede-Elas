<?php
// app/Models/Testimonial.php - Model de depoimentos

namespace Models;

<<<<<<< HEAD
use Repositories\RepositoryManager;

class Testimonial {
    private $testimonialRepo;
    
    public function __construct() {
        $this->testimonialRepo = RepositoryManager::getInstance()->testimonial();
    }
    
    public function create($authorName, $content) {
        return $this->testimonialRepo->createTestimonial($authorName, $content);
    }
    
    public function getApproved($limit = null, $offset = 0) {
        return $this->testimonialRepo->getApproved($limit, $offset);
    }

    public function countApproved() {
        return $this->testimonialRepo->countApproved();
    }
    
    public function getPending() {
        return $this->testimonialRepo->getPending();
    }
    
    public function approve($id) {
        return $this->testimonialRepo->approve($id);
    }
    
    public function reject($id) {
        return $this->testimonialRepo->reject($id);
    }
    
    public function like($id) {
        return $this->testimonialRepo->like($id);
    }
    
    public function hasUserLiked($testimonialId, $userIdentifier) {
        return $this->testimonialRepo->hasUserLiked($testimonialId, $userIdentifier);
    }
    
    public function addLike($testimonialId, $userIdentifier) {
        return $this->testimonialRepo->addLike($testimonialId, $userIdentifier);
=======
class Testimonial {
    private $db;
    
    public function __construct() {
        $this->db = \Database::getInstance()->getConnection();
    }
    
    public function create($authorName, $content) {
        $stmt = $this->db->prepare("
            INSERT INTO testimonials (author_name, content, approved) 
            VALUES (?, ?, FALSE)
        ");
        
        $stmt->execute([$authorName, $content]);
        return $this->db->lastInsertId();
    }
    
    public function getApproved($limit = null, $offset = 0) {
        if ($limit !== null) {
            $stmt = $this->db->prepare("
                SELECT * FROM testimonials 
                WHERE approved = TRUE 
                ORDER BY created_at DESC
                LIMIT ? OFFSET ?
            ");
            $stmt->bindValue(1, (int)$limit, \PDO::PARAM_INT);
            $stmt->bindValue(2, (int)$offset, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $stmt = $this->db->query("
                SELECT * FROM testimonials 
                WHERE approved = TRUE 
                ORDER BY created_at DESC
            ");
            return $stmt->fetchAll();
        }
    }

    public function countApproved() {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM testimonials WHERE approved = TRUE");
        $row = $stmt->fetch();
        return (int)($row['total'] ?? 0);
    }
    
    public function getPending() {
        $stmt = $this->db->query("
            SELECT * FROM testimonials 
            WHERE approved = FALSE 
            ORDER BY created_at DESC
        ");
        return $stmt->fetchAll();
    }
    
    public function approve($id) {
        $stmt = $this->db->prepare("UPDATE testimonials SET approved = TRUE WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function reject($id) {
        $stmt = $this->db->prepare("DELETE FROM testimonials WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function like($id) {
        $stmt = $this->db->prepare("UPDATE testimonials SET likes = likes + 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function hasUserLiked($testimonialId, $userIdentifier) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM testimonial_likes 
            WHERE testimonial_id = ? AND user_identifier = ?
        ");
        $stmt->execute([$testimonialId, $userIdentifier]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function addLike($testimonialId, $userIdentifier) {
        try {
            $this->db->beginTransaction();
            
            $stmt = $this->db->prepare("
                INSERT INTO testimonial_likes (testimonial_id, user_identifier) 
                VALUES (?, ?)
            ");
            $stmt->execute([$testimonialId, $userIdentifier]);
            
            $this->like($testimonialId);
            
            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
>>>>>>> 4a84a3764cdeb97fa46841006fd33cb274d56da3
    }
}
