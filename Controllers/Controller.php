<?php

namespace App\Controllers;

abstract class Controller
{
    protected $template = 'default';

    public function render(string $file, array $datas = [])
    {
        extract($datas);

        ob_start();

        require_once ROOT . '/Views/' . $file . '.php';

        $content = ob_get_clean();

        require_once ROOT . '/Views/' . $this->template . '.php';
    }
}
