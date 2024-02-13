<?php

namespace App\Controllers;

use App\Core\Route;

class RegisterController {
    #[Route(path: '/', name: 'home', requestType: 'GET')]
    public function index(): void {
        echo 'Home page';
    }

    #[Route(path: '/register', name: 'register', requestType: 'POST')]
    public function register(): void {
        echo 'Home page';
    }
}