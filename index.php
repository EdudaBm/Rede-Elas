<?php
// index.php - Front Controller
session_start();

// Configurações
define('BASE_PATH', __DIR__);
define('BASE_URL', 'http://localhost');

// Autoload
spl_autoload_register(function ($class) {
    $file = BASE_PATH . '/app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Incluir configurações
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/app/Repositories/autoload.php';
require_once BASE_PATH . '/app/Core/Router.php';
require_once BASE_PATH . '/app/Core/Controller.php';

// Inicializar roteador
$router = new Core\Router();

// Rotas públicas
$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/blog', 'BlogController@index');
$router->add('GET', '/blog/{slug}', 'BlogController@show');
$router->add('GET', '/sobre', 'AboutController@index');
$router->add('GET', '/termos', 'TermsController@index');
$router->add('GET', '/depoimentos', 'TestimonialsController@index');
$router->add('POST', '/depoimentos/create', 'TestimonialsController@create');
$router->add('POST', '/depoimentos/like/{id}', 'TestimonialsController@like');

// Rotas de autenticação
$router->add('GET', '/login', 'AuthController@showLogin');
$router->add('POST', '/login', 'AuthController@login');
$router->add('GET', '/logout', 'AuthController@logout');
$router->add('POST', '/login/anonymous', 'AuthController@anonymousLogin');
// Cadastro opcional
$router->add('GET', '/register', 'AuthController@showRegister');
$router->add('POST', '/register', 'AuthController@register');

// Rotas de conversa (requer autenticação)
$router->add('GET', '/conversa', 'ChatController@index');
$router->add('GET', '/conversa/{id}', 'ChatController@show');
$router->add('GET', '/conversa/{id}/messages', 'ChatController@getMessages');
$router->add('POST', '/conversa/create', 'ChatController@create');
$router->add('POST', '/conversa/{id}/message', 'ChatController@sendMessage');
$router->add('POST', '/conversa/{id}/accept', 'ChatController@acceptChat');
$router->add('POST', '/conversa/{id}/close', 'ChatController@closeChat');
$router->add('POST', '/conversa/{id}/finish', 'ChatController@finishChat');

// Rotas de contatos de emergência (requer autenticação)
$router->add('GET', '/emergency', 'EmergencyController@index');
$router->add('GET', '/emergency/create', 'EmergencyController@create');
$router->add('POST', '/emergency/create', 'EmergencyController@store');
$router->add('GET', '/emergency/{id}/edit', 'EmergencyController@edit');
$router->add('POST', '/emergency/{id}/edit', 'EmergencyController@update');
$router->add('POST', '/emergency/{id}/delete', 'EmergencyController@delete');
$router->add('POST', '/emergency/{id}/primary', 'EmergencyController@setPrimary');
$router->add('GET', '/emergency/contacts', 'EmergencyController@getContacts');

// Rotas administrativas (requer admin)
$router->add('GET', '/admin', 'AdminController@index');
$router->add('GET', '/admin/register', 'AdminController@showRegisterForm');
$router->add('POST', '/admin/register', 'AdminController@createAdmin');
$router->add('POST', '/admin/testimonials/{id}/approve', 'AdminController@approveTestimonial');
$router->add('POST', '/admin/testimonials/{id}/reject', 'AdminController@rejectTestimonial');
$router->add('POST', '/admin/testimonials/{id}/delete', 'AdminController@deleteApprovedTestimonial');

// Rotas administrativas - artigos
$router->add('GET', '/admin/articles', 'AdminArticlesController@index');
$router->add('GET', '/admin/articles/create', 'AdminArticlesController@createForm');
$router->add('POST', '/admin/articles/create', 'AdminArticlesController@create');
$router->add('GET', '/admin/articles/{id}/edit', 'AdminArticlesController@editForm');
$router->add('POST', '/admin/articles/{id}/edit', 'AdminArticlesController@update');
$router->add('POST', '/admin/articles/{id}/delete', 'AdminArticlesController@delete');

// Processar requisição
$router->dispatch();
