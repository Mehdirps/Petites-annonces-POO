<?php

namespace App\Controllers;

class AnnoncesController extends Controller
{
    public function index()
    {
        // echo "La liste des annonces";

        require_once ROOT . '/Views/annonces/index.php';
    }
}
