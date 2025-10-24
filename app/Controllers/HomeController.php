<?php
// app/Controllers/HomeController.php - Controlador da página inicial

namespace Controllers;

use Core\Controller;

class HomeController extends Controller {
    public function index() {
        $user = $this->getCurrentUser();
        $this->view('home', ['user' => $user]);
    }
}
