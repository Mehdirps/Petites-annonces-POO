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
            ->endForm();

        var_dump($form);
    }
}
