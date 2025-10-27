<?php
// app/Repositories/RepositoryManager.php - Gerenciador de repositórios

namespace Repositories;

class RepositoryManager {
    private static $instance = null;
    private $repositories = [];
    
    private function __construct() {}
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Obter repositório de usuários
     */
    public function user() {
        if (!isset($this->repositories['user'])) {
            $this->repositories['user'] = new UserRepository();
        }
        return $this->repositories['user'];
    }
    
    /**
     * Obter repositório de artigos
     */
    public function article() {
        if (!isset($this->repositories['article'])) {
            $this->repositories['article'] = new ArticleRepository();
        }
        return $this->repositories['article'];
    }
    
    /**
     * Obter repositório de salas de chat
     */
    public function chatRoom() {
        if (!isset($this->repositories['chatRoom'])) {
            $this->repositories['chatRoom'] = new ChatRoomRepository();
        }
        return $this->repositories['chatRoom'];
    }
    
    /**
     * Obter repositório de mensagens
     */
    public function message() {
        if (!isset($this->repositories['message'])) {
            $this->repositories['message'] = new MessageRepository();
        }
        return $this->repositories['message'];
    }
    
    /**
     * Obter repositório de contatos de emergência
     */
    public function emergencyContact() {
        if (!isset($this->repositories['emergencyContact'])) {
            $this->repositories['emergencyContact'] = new EmergencyContactRepository();
        }
        return $this->repositories['emergencyContact'];
    }
    
    /**
     * Obter repositório de depoimentos
     */
    public function testimonial() {
        if (!isset($this->repositories['testimonial'])) {
            $this->repositories['testimonial'] = new TestimonialRepository();
        }
        return $this->repositories['testimonial'];
    }
    
    /**
     * Obter repositório por nome
     */
    public function get($name) {
        $method = strtolower($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        throw new \Exception("Repositório '{$name}' não encontrado");
    }
}
