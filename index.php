<?php

use App\Autoload;
use App\DataBase\DataBase;
use App\Models\AnnoncesModel;
use App\Models\Model;

require_once 'Autoload.php';
Autoload::register();


$model = new AnnoncesModel;
$annonces = $model->findBy(['active' => 1]);
var_dump($annonces);

$model2 = new AnnoncesModel;
$annonces2 = $model2->find(2);
var_dump($annonces2);

$model3 = new AnnoncesModel;
$annonces3 = $model3->findAll();
var_dump($annonces3);

$model4 = new AnnoncesModel;

$annonces4 = $model4
    ->setTitle('Salut')
    ->setDescription('Ceci est la description de "salut"')
    ->setActive(1);

$model4->create($annonces4);

var_dump($model4);