<?php 

namespace App\Controllers;

class AnnonceController {
    
    public function index(): void {

        require_once __DIR__ . '/../Views/home.php';
    } 

    public function create(): void {
        // vue create.php + upload + insertion
        // move_uploaded_file()
    }
    
    public function show(?int $id): void {
        // vue details.php 
    }
}