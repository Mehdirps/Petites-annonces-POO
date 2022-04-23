<?php

namespace App\Controllers;

use App\Core\Form;

class UsersController extends Controller
{
    public function login()
    {
        $form = new Form;

        $form->startForm('get', 'login.php', ['class' => 'login', 'id' => 'login'])
            ->addLabelFor('email', 'E-mail')
            ->addInput('email', 'email', ['class' => 'form-control'])
            ->addLabelFor('password', 'Mot de passe')
            ->addInput('password', 'password', ['class' => 'form-control'])
            ->addLabelFor('message', 'Message')
            ->addtextArea('message', '', ['class' => 'form-control'])
            ->addButton('Envoyer le formulaire', ['class' => 'btn btn-primary'])
            ->endForm();

        $this->render('users/login', ['loginForm' => $form->create()]);
    }
}
