<?php
// app/Core/Router.php - Sistema de roteamento

namespace Core;

class Router {
    private $routes = [];
    
    public function add($method, $path, $handler) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }
    
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }
            
            $pattern = $this->convertToRegex($route['path']);
            
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches);
                $this->callHandler($route['handler'], $matches);
                return;
            }
        }
        
        http_response_code(404);
        echo "Página não encontrada";
    }
    
    private function convertToRegex($path) {
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_-]+)', $path);
        return '#^' . $pattern . '$#';
    }
    
    private function callHandler($handler, $params) {
        list($controller, $method) = explode('@', $handler);
        $controllerClass = "Controllers\\{$controller}";
        
        if (class_exists($controllerClass)) {
            $controllerInstance = new $controllerClass();
            call_user_func_array([$controllerInstance, $method], $params);
        }
    }
}
