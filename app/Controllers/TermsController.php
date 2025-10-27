<?php
// app/Controllers/TermsController.php - Controlador da página de termos

namespace Controllers;

use Core\Controller;

class TermsController extends Controller {
    
    public function index() {
        $this->view('terms/index');
    }
}
