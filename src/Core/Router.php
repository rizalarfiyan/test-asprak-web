<?php

namespace App\Core;

class Router
{
    protected $routes = [];

	protected $defaultValidation = [
		'id' => '[1-9][0-9]*',
	];

    private function addRoute($route, $controller, $action, $method, $validation)
    {
        $this->routes[$method][$route] = [
			'controller' => $controller,
			'action' => $action,
			'validation' => $validation ?? $this->defaultValidation,
		];
    }

	public function get($route, $controller, $action, $validation = null)
	{
		$this->addRoute($route, $controller, $action, "GET", $validation);
	}

	public function post($route, $controller, $action, $validation = null)
	{
		$this->addRoute($route, $controller, $action, "POST", $validation);
	}

	public function put($route, $controller, $action, $validation = null)
	{
		$this->addRoute($route, $controller, $action, "PUT", $validation);
	}

	public function patch($route, $controller, $action, $validation = null)
	{
		$this->addRoute($route, $controller, $action, "PATCH", $validation);
	}

	public function delete($route, $controller, $action, $validation = null)
	{
		$this->addRoute($route, $controller, $action, "DELETE", $validation);
	}

	public function dispatch()
	{
		$uri = strtok($_SERVER['REQUEST_URI'], '?');
		$method = $_SERVER['REQUEST_METHOD'];

		foreach ($this->routes[$method] as $route => $params) {
			$pattern = preg_replace_callback('/\{([^\}]+)\}/', function ($matches) use ($params) {
				$key = $matches[1];
				return isset($params['validation'][$key]) ? '(' . $params['validation'][$key] . ')' : '([^/]+)';
			}, $route);

			$pattern = str_replace('/', '\/', $pattern);
			if (preg_match('/^' . $pattern . '$/', $uri, $matches)) {
				array_shift($matches);
				$controller = $params['controller'];
				$action = $params['action'];

				$controller = new $controller();
				call_user_func_array([$controller, $action], $matches);
				return;
			}
		}

		include __DIR__ . "/../Views/404.php";
	}
}
