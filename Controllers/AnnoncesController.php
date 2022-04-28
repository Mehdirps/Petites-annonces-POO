<?php

namespace App\Controllers;

use App\Core\Form;
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

    public function add()
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {

            if (Form::validate($_POST, ['title', 'description'])) {

                $title = strip_tags($_POST['title']);
                $description = strip_tags($_POST['description']);

                $annonce = new AnnoncesModel;

                $annonce->setTitle($title)
                    ->setDescription($description)
                    ->setUsers_id($_SESSION['user']['id']);

                $annonce->create();
                $_SESSION['message'] = "L'annonce a bien été ajouté";
                header('Location: /');
                exit;
            } else {
                $_SESSION['error'] = !empty($_POST) ? "Le formulaire n'est pas complet" : '';
                $title = isset($_POST['title']) ? strip_tags($_POST['title']) : '';
                $description = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
            }

            $form = new Form;

            $form->startForm()
                ->addLabelFor('title', 'Titre de l\'annonce')
                ->addInput('text', 'title', ['id' => 'title', 'class' => 'form-control', 'value' => $title])
                ->addLabelFor('description', 'Descrption de l\'annonce')
                ->addtextArea('description', $description, ['id' => 'description', 'class' => 'form-control'])
                ->addButton('Ajouter l\'annonce', ['class' => 'btn btn-primary'])
                ->endForm();

            $this->render('annonces/add', ['form' => $form->create()]);
        } else {
            $_SESSION['error'] = "Vous devez être connecté pour accéder à cette page";
            header('Location: /users/login');
            exit;
        }
    }

    public function modify(int $id)
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {

            $annonceModel = new AnnoncesModel;

            $annonce = $annonceModel->find($id);

            if (!$annonce) {
                $_SESSION['error'] = "L'annonce recherchée n'existe pas";
                http_response_code(404);
                header('Location: /annonces');
                exit;
            }

            if ($annonce->users_id !== $_SESSION['user']['id']) {

                if (!in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) {

                    $_SESSION['error'] = "Vous n'avez pas accès à cette page";
                    header('Location: /annonces');
                    exit;
                }
            }

            if (Form::validate($_POST, ['title', 'description'])) {

                $title = strip_tags($_POST['title']);
                $description = strip_tags($_POST['description']);

                $annonceUpdate = new AnnoncesModel;

                $annonceUpdate->setId($annonce->id)
                    ->setTitle($title)
                    ->setDescription($description);

                $annonceUpdate->update();

                $_SESSION['message'] = "Votre annonce a été modifée avec succès";
                header('Location: /');
                exit;
            }

            $formModify = new Form;

            $formModify->startForm()
                ->addLabelFor('title', 'Titre de l\'annonce')
                ->addInput('text', 'title', ['id' => 'title', 'class' => 'form-control', 'value' => $annonce->title])
                ->addLabelFor('description', 'Descrption de l\'annonce')
                ->addtextArea('description', $annonce->description, ['id' => 'description', 'class' => 'form-control'])
                ->addButton('Modifié l\'annonce', ['class' => 'btn btn-primary'])
                ->endForm();

            $this->render('annonces/modify', ['formModify' => $formModify->create()]);
        } else {
            $_SESSION['error'] = "Vous devez être connecté pour accéder à cette page";
            header('Location: /users/login');
            exit;
        }
    }
}
