<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;

class AdminController extends Controller
{
    public function index()
    {
        if ($this->isAdmin()) {
            $this->render('admin/index', [], 'admin');
        }
    }

    /**
     * View all 'annonces'
     *
     * @return void
     */
    public function annonces()
    {
        if ($this->isAdmin()) {

            $annonceModel = new AnnoncesModel;

            $annonces = $annonceModel->findAll();

            $this->render('admin/annonces', compact('annonces'), 'admin');
        }
    }

    /**
     * Role verification
     *
     * @return boolean
     */
    private function isAdmin()
    {
        if (isset($_SESSION['user']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) {

            return true;
        } else {

            $_SESSION['error'] = "Vous n'avez pas accès à cette page";
            header('Location: /');
            exit;
        }
    }
}
