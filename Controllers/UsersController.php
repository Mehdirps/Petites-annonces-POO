<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\UsersModel;

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

    /**
     * Register model for user
     *
     * @return void
     */
    public function register()
    {
        if (Form::validate($_POST, ['email', 'password'])) {

            $email = strip_tags($_POST['email']);

            $password = password_hash($_POST['password'], PASSWORD_ARGON2ID);

            $user = new UsersModel;

            $user->setEmail($email)
                ->setPassword($password);

            $user->create();
        }

        $form = new Form;

        $form->startForm()
            ->addLabelFor('email', 'E-mail')
            ->addInput('email', 'email', ['id' => 'email', 'class' => 'form-control'])
            ->addLabelFor('password', 'Mot de passe')
            ->addInput('password', 'password', ['id' => 'password', 'class' => 'form-control'])
            ->addButton('M\'inscrire', ['class' => 'btn btn-primary'])
            ->endForm();

        $this->render('users/register', ['registerForm' => $form->create()]);
    }
}
