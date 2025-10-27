<?php
// app/Repositories/TestimonialRepository.php - Repositório para depoimentos

namespace Repositories;

class TestimonialRepository extends BaseRepository {
    protected $table = 'testimonials';
    
    /**
     * Criar depoimento
     */
    public function createTestimonial($authorName, $content) {
        return $this->create([
            'author_name' => $authorName,
            'content' => $content,
            'approved' => false
        ]);
    }
    
    /**
     * Buscar depoimentos aprovados
     */
    public function getApproved($limit = null, $offset = 0) {
        $sql = "SELECT * FROM testimonials WHERE approved = TRUE ORDER BY created_at DESC";
        $params = [];
        
        if ($limit !== null) {
            $sql .= " LIMIT ? OFFSET ?";
            $params = [(int)$limit, (int)$offset];
        }
        
        return $this->fetchAll($sql, $params);
    }
    
    /**
     * Contar depoimentos aprovados
     */
    public function countApproved() {
        $result = $this->fetch("SELECT COUNT(*) AS total FROM testimonials WHERE approved = TRUE");
        return (int)$result['total'];
    }
    
    /**
     * Buscar depoimentos pendentes
     */
    public function getPending() {
        return $this->fetchAll("
            SELECT * FROM testimonials 
            WHERE approved = FALSE 
            ORDER BY created_at DESC
        ");
    }
    
    /**
     * Aprovar depoimento
     */
    public function approve($id) {
        return $this->update($id, ['approved' => true]);
    }
    
    /**
     * Rejeitar depoimento (deletar)
     */
    public function reject($id) {
        return $this->delete($id);
    }
    
    /**
     * Curtir depoimento
     */
    public function like($id) {
        $stmt = $this->db->prepare("UPDATE testimonials SET likes = likes + 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    /**
     * Verificar se usuário já curtiu
     */
    public function hasUserLiked($testimonialId, $userIdentifier) {
        $result = $this->fetch("
            SELECT COUNT(*) as total FROM testimonial_likes 
            WHERE testimonial_id = ? AND user_identifier = ?
        ", [$testimonialId, $userIdentifier]);
        return (int)$result['total'] > 0;
    }
    
    /**
     * Adicionar curtida
     */
    public function addLike($testimonialId, $userIdentifier) {
        try {
            $this->db->beginTransaction();
            
            // Verificar se já curtiu
            if ($this->hasUserLiked($testimonialId, $userIdentifier)) {
                $this->db->rollBack();
                return false;
            }
            
            // Adicionar registro de curtida
            $stmt = $this->db->prepare("
                INSERT INTO testimonial_likes (testimonial_id, user_identifier) 
                VALUES (?, ?)
            ");
            $stmt->execute([$testimonialId, $userIdentifier]);
            
            // Incrementar contador de curtidas
            $this->like($testimonialId);
            
            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
    
    /**
     * Buscar depoimentos por autor
     */
    public function getByAuthor($authorName) {
        return $this->fetchAll("
            SELECT * FROM testimonials 
            WHERE author_name = ? 
            ORDER BY created_at DESC
        ", [$authorName]);
    }
    
    /**
     * Buscar depoimentos mais curtidos
     */
    public function getMostLiked($limit = 10) {
        return $this->fetchAll("
            SELECT * FROM testimonials 
            WHERE approved = TRUE 
            ORDER BY likes DESC, created_at DESC 
            LIMIT ?
        ", [(int)$limit]);
    }
    
    /**
     * Buscar depoimentos com paginação
     */
    public function getPaginated($page = 1, $perPage = 10, $approvedOnly = true) {
        $offset = ($page - 1) * $perPage;
        $whereClause = $approvedOnly ? "WHERE approved = TRUE" : "";
        
        $sql = "SELECT * FROM testimonials {$whereClause} ORDER BY created_at DESC LIMIT ? OFFSET ?";
        return $this->fetchAll($sql, [(int)$perPage, (int)$offset]);
    }
    
    /**
     * Contar depoimentos pendentes
     */
    public function countPending() {
        $result = $this->fetch("SELECT COUNT(*) as total FROM testimonials WHERE approved = FALSE");
        return (int)$result['total'];
    }
    
    /**
     * Buscar estatísticas dos depoimentos
     */
    public function getStats() {
        return [
            'total' => $this->count(),
            'approved' => $this->countApproved(),
            'pending' => $this->countPending()
        ];
    }
}
