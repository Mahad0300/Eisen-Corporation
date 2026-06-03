<?php
namespace App\Core;

class Router {
    protected $routes = [];

    // Add a GET route
    public function get($route, $controllerAction) {
        $this->addRoute('GET', $route, $controllerAction);
    }

    // Add a POST route
    public function post($route, $controllerAction) {
        $this->addRoute('POST', $route, $controllerAction);
    }

    protected function addRoute($method, $route, $controllerAction) {
        // Convert route string to a regular expression for dynamic parameters
        $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_-]+)', $route);
        $routeRegex = "#^" . $routeRegex . "$#";
        
        $this->routes[] = [
            'method' => $method,
            'pattern' => $routeRegex,
            'action' => $controllerAction
        ];
    }

    public function dispatch($url) {
        $method = $_SERVER['REQUEST_METHOD'];
        
        // Strip query string if present
        if (strpos($url, '?') !== false) {
            $url = explode('?', $url, 2)[0];
        }
        
        $url = '/' . ltrim($url, '/'); // Ensure leading slash

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $url, $matches)) {
                // Remove numeric keys from matches to leave only named parameters
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                return $this->executeAction($route['action'], array_values($params));
            }
        }

        // If no route matches at all, send 404
        $this->send404();
    }

    protected function executeAction($action, $params = []) {
        list($controllerName, $methodName) = explode('@', $action);
        
        $controllerClass = "App\\Controllers\\" . $controllerName;

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $methodName)) {
                call_user_func_array([$controller, $methodName], $params);
                return true;
            } else {
                throw new \Exception("Method {$methodName} not found in controller {$controllerClass}");
            }
        } else {
            throw new \Exception("Controller class {$controllerClass} not found");
        }
    }

    protected function send404() {
        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
        echo "<p>The requested URL was not found on this server.</p>";
        exit;
    }
}
