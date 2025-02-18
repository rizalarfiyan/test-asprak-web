<?php

namespace App\Core;

class Router
{
    protected $routes = [];

	protected $defaultValidation = [
		'id' => '[0-9]+',
	];

    private function addRoute($route, $controller, $action, $method, $req, $isHtmx, $validation)
    {
        $this->routes[$method][$route] = [
			'req' => $req,
			'controller' => $controller,
			'action' => $action,
			'htmx' => $isHtmx,
			'validation' => $validation ?? $this->defaultValidation,
		];
    }

	public function get($route, $controller, $action, $isHtmx = false, $validation = null)
	{
		$this->addRoute($route, $controller, $action, "GET", $_GET, $isHtmx, $validation);
	}

	public function post($route, $controller, $action, $isHtmx = false, $validation = null)
	{
		$this->addRoute($route, $controller, $action, "POST", $_POST,  $isHtmx, $validation);
	}

	public function put($route, $controller, $action, $isHtmx = false, $validation = null)
	{
		parse_str(file_get_contents("php://input"), $_PUT);
		$this->addRoute($route, $controller, $action, "PUT", $_PUT, $isHtmx, $validation);
	}

	public function patch($route, $controller, $action, $isHtmx = false, $validation = null)
	{
		parse_str(file_get_contents("php://input"), $_PATCH);
		$this->addRoute($route, $controller, $action, "PATCH", $_PATCH, $isHtmx, $validation);
	}

	public function delete($route, $controller, $action, $isHtmx = false, $validation = null)
	{
		parse_str(file_get_contents("php://input"), $_DELETE);
		$this->addRoute($route, $controller, $action, "DELETE", $_DELETE, $isHtmx, $validation);
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
				call_user_func_array([$controller, $action], [...$matches, $params['req']]);
				return;
			}
		}

		include __DIR__ . "/../Views/404.php";
	}
}
