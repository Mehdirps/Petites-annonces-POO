<?php

use App\Autoload;
use App\Core\Main;

define ('ROOT', dirname(__DIR__));

require_once ROOT.'/Autoload.php';
Autoload::register();

$app = new Main;

$app->start();