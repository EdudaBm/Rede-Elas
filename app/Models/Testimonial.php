<?php
// app/Models/Testimonial.php - Model de depoimentos

namespace Models;

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
    }
}
