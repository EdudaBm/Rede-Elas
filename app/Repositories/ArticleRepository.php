<?php
// app/Repositories/ArticleRepository.php - Repositório para artigos

namespace Repositories;

class ArticleRepository extends BaseRepository {
    protected $table = 'articles';
    
    /**
     * Criar artigo
     */
    public function createArticle($title, $slug, $excerpt, $content, $coverImage, $authorId, $authorName, $isPublished) {
        $data = [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $excerpt,
            'content' => $content,
            'cover_image' => $coverImage,
            'author_id' => $authorId,
            'author_name' => $authorName,
            'is_published' => $isPublished
        ];
        
        if ($isPublished) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }
        
        return $this->create($data);
    }
    
    /**
     * Atualizar artigo
     */
    public function updateArticle($id, $title, $slug, $excerpt, $content, $coverImage, $isPublished) {
        $data = [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $excerpt,
            'content' => $content,
            'cover_image' => $coverImage,
            'is_published' => $isPublished
        ];
        
        if ($isPublished) {
            // Se está sendo publicado agora, definir published_at
            $article = $this->findById($id);
            if (!$article['published_at']) {
                $data['published_at'] = date('Y-m-d H:i:s');
            }
        } else {
            // Se está sendo despublicado, remover published_at
            $data['published_at'] = null;
        }
        
        return $this->update($id, $data);
    }
    
    /**
     * Buscar artigos publicados
     */
    public function getPublished($limit = 20) {
        $sql = "SELECT * FROM articles WHERE is_published = 1 ORDER BY COALESCE(published_at, created_at) DESC";
        
        if ($limit) {
            $sql .= " LIMIT ?";
            return $this->fetchAll($sql, [(int)$limit]);
        }
        
        return $this->fetchAll($sql);
    }
    
    /**
     * Buscar artigo por slug
     */
    public function findBySlug($slug) {
        return $this->fetch("SELECT * FROM articles WHERE slug = ? AND is_published = 1", [$slug]);
    }
    
    /**
     * Buscar artigos por autor
     */
    public function findByAuthor($authorId) {
        return $this->fetchAll("SELECT * FROM articles WHERE author_id = ? ORDER BY created_at DESC", [$authorId]);
    }
    
    /**
     * Buscar artigos pendentes de publicação
     */
    public function getPending() {
        return $this->fetchAll("SELECT * FROM articles WHERE is_published = 0 ORDER BY created_at DESC");
    }
    
    /**
     * Publicar artigo
     */
    public function publish($id) {
        return $this->update($id, [
            'is_published' => true,
            'published_at' => date('Y-m-d H:i:s')
        ]);
    }
    
    /**
     * Despublicar artigo
     */
    public function unpublish($id) {
        return $this->update($id, [
            'is_published' => false,
            'published_at' => null
        ]);
    }
    
    /**
     * Buscar artigos com paginação
     */
    public function getPaginated($page = 1, $perPage = 10, $publishedOnly = true) {
        $offset = ($page - 1) * $perPage;
        $whereClause = $publishedOnly ? "WHERE is_published = 1" : "";
        
        $sql = "SELECT * FROM articles {$whereClause} ORDER BY COALESCE(published_at, created_at) DESC LIMIT ? OFFSET ?";
        return $this->fetchAll($sql, [(int)$perPage, (int)$offset]);
    }
    
    /**
     * Contar artigos publicados
     */
    public function countPublished() {
        $result = $this->fetch("SELECT COUNT(*) as total FROM articles WHERE is_published = 1");
        return (int)$result['total'];
    }
}
