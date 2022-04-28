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
     * Delete a 'annonce' if is admin
     *
     * @param int $id
     * @return void
     */
    public function deleteAnnonce(int $id)
    {
        if ($this->isAdmin()) {

            $annonce = new AnnoncesModel;

            $annonce->delete($id);

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * Active or disable a annonce
     *
     * @param integer $id
     * @return void
     */
    public function activeAnnonce(int $id)
    {
        if ($this->isAdmin()) {

            $annoncesModel = new AnnoncesModel;

            $annonceArray = $annoncesModel->find($id);

            if ($annonceArray) {

                $annonce = $annoncesModel->hydrate($annonceArray);

                $annonce->setActive($annonce->getActive() ? 0 : 1);

                $annonce->update();
            }
        }
    }
}
