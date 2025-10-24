<?php
// app/Controllers/AboutController.php - Controlador da página sobre

namespace Controllers;

use Core\Controller;

class AboutController extends Controller {
    public function index() {
        $user = $this->getCurrentUser();
        $this->view('about/index', ['user' => $user]);
    }
}
