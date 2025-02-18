<?php

namespace App\Core;

class Router
{
    protected $routes = [];

	protected $defaultValidation = [
		'id' => '[1-9][0-9]*',
	];

    private function addRoute($route, $controller, $action, $method, $isHtmx, $validation)
    {
        $this->routes[$method][$route] = [
			'controller' => $controller,
			'action' => $action,
			'htmx' => $isHtmx,
			'validation' => $validation ?? $this->defaultValidation,
		];
    }

	public function get($route, $controller, $action, $isHtmx = false, $validation = null)
	{
		$this->addRoute($route, $controller, $action, "GET", $isHtmx, $validation);
	}

	public function post($route, $controller, $action, $isHtmx = false, $validation = null)
	{
		$this->addRoute($route, $controller, $action, "POST", $isHtmx, $validation);
	}

	public function put($route, $controller, $action, $isHtmx = false, $validation = null)
	{
		$this->addRoute($route, $controller, $action, "PUT", $isHtmx, $validation);
	}

	public function patch($route, $controller, $action, $isHtmx = false, $validation = null)
	{
		$this->addRoute($route, $controller, $action, "PATCH", $isHtmx, $validation);
	}

	public function delete($route, $controller, $action, $isHtmx = false, $validation = null)
	{
		$this->addRoute($route, $controller, $action, "DELETE", $isHtmx, $validation);
	}

	public function dispatch()
	{
		$uri = strtok($_SERVER['REQUEST_URI'], '?');
		$method = $_SERVER['REQUEST_METHOD'];
		$isHTMXRequest = isset($_SERVER['HTTP_HX_REQUEST']) && $_SERVER['HTTP_HX_REQUEST'] == 'true';

		foreach ($this->routes[$method] as $route => $params) {
			$pattern = preg_replace_callback('/\{([^\}]+)\}/', function ($matches) use ($params) {
				$key = $matches[1];
				return isset($params['validation'][$key]) ? '(' . $params['validation'][$key] . ')' : '([^/]+)';
			}, $route);

			$pattern = str_replace('/', '\/', $pattern);
			if (preg_match('/^' . $pattern . '$/', $uri, $matches)) {
				if ($params['htmx'] && !$isHTMXRequest) break;

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
