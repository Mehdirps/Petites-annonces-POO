<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
    public function index()
    {
        $annoncesModel = new AnnoncesModel;

        $annonces = $annoncesModel->findBy(['active' => 1]);

        $this->render('annonces/index', compact('annonces'));
    }

    public function view(int $id)
    {
        $annoncesModel = new AnnoncesModel;

        $annonce = $annoncesModel->find($id);      
        
        $this->render('annonces/view', compact('annonce'));
    }
}
