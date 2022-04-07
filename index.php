<?php

use App\Autoload;
use App\DataBase\DataBase;
use App\Models\AnnoncesModel;

require_once 'Autoload.php';
Autoload::register();

$model = new AnnoncesModel();
$model2 = new AnnoncesModel();
$model3 = new AnnoncesModel();

$annonces = $model->findBy(['active' => 1]);
var_dump($annonces);

$annonces2 = $model2->find(2);
var_dump($annonces2);

$annonces3 = $model3->findAll();
var_dump($annonces3);
