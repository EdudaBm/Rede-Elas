<?php
// app/Repositories/autoload.php - Autoload para repositórios

// Incluir todas as classes de repositório
require_once __DIR__ . '/RepositoryInterface.php';
require_once __DIR__ . '/BaseRepository.php';
require_once __DIR__ . '/RepositoryManager.php';
require_once __DIR__ . '/UserRepository.php';
require_once __DIR__ . '/ArticleRepository.php';
require_once __DIR__ . '/ChatRoomRepository.php';
require_once __DIR__ . '/MessageRepository.php';
require_once __DIR__ . '/EmergencyContactRepository.php';
require_once __DIR__ . '/TestimonialRepository.php';

// Função helper para obter o gerenciador de repositórios
function getRepositoryManager() {
    return \Repositories\RepositoryManager::getInstance();
}

// Função helper para obter repositórios específicos
function getUserRepository() {
    return getRepositoryManager()->user();
}

function getArticleRepository() {
    return getRepositoryManager()->article();
}

function getChatRoomRepository() {
    return getRepositoryManager()->chatRoom();
}

function getMessageRepository() {
    return getRepositoryManager()->message();
}

function getEmergencyContactRepository() {
    return getRepositoryManager()->emergencyContact();
}

function getTestimonialRepository() {
    return getRepositoryManager()->testimonial();
}
