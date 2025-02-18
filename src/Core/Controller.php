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

	protected function successMessage($message)
	{
		echo `<div class="p-4 mb-4 text-sm text-success-800 rounded-lg bg-success-50" role="alert"><span class="font-medium">Success!</span>{$message}</div>`;
	}

	protected function errorMessage($message)
	{
		echo `<div class="p-4 mb-4 text-sm text-danger-800 rounded-lg bg-danger-50" role="alert"><span class="font-medium">Opps!</span>{$message}</div>`;
	}

	protected function closeModal()
	{
		echo `<button type="button" _="on click trigger closeModal" class="px-4 py-2 text-white bg-primary-500 rounded-md hover:bg-primary-600 transition-colors duration-300">Close</button>`;
	}
}
