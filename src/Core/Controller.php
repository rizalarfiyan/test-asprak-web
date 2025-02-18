<?php

namespace App\Core;

class Controller
{
	protected $layout = 'default';

    protected function render($view, $data = [])
    {
        extract($data);

        include __DIR__ . "/../Views/_layout/header.php";
        include __DIR__ . "/../Views/$view.php";
        include __DIR__ . "/../Views/_layout/footer.php";
    }

    protected function renderHTMX($view, $data = [])
    {
        extract($data);

        include __DIR__ . "/../Views/$view.php";
    }

    protected function model($model)
    {
        require_once __DIR__ ."/../Models/$model.php";
        $modelClass = "App\\Models\\$model";
        return new $modelClass;
    }
}
