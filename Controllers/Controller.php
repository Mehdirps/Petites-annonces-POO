<?php

namespace App\Controllers;

abstract class Controller
{
    public function render(string $file, array $datas = [])
    {
        extract($datas);

        require_once ROOT . '/Views/' . $file . '.php';
    }
}
