<?php

use App\Autoload;
use App\DataBase\DataBase;
use App\Models\AnnoncesModel;

require_once 'Autoload.php';
Autoload::register();

$model = new AnnoncesModel();

$annonces = $model->findBy(['active' => 1]);

var_dump($annonces);