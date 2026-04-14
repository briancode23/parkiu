<?php
/**
 * Router Class
 * Handles routing logic
 */
class Router
{
    private $routes = [];
    private $method = '';
    private $controller = '';
    private $action = '';
    private $params = [];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Register GET route
     */
    public function get($path, $controller)
    {
        $this->routes['GET'][$path] = $controller;
    }

    /**
     * Register POST route
     */
    public function post($path, $controller)
    {
        $this->routes['POST'][$path] = $controller;
    }

    /**
     * Register route
     */
    public function route($path, $controller, $method = 'GET')
    {
        if (!isset($this->routes[$method])) {
            $this->routes[$method] = [];
        }
        $this->routes[$method][$path] = $controller;
    }

    /**
     * Dispatch route
     */
    public function dispatch()
    {
        $uri = $this->getCurrentUri();

        // Check if route exists
        if (isset($this->routes[$this->method][$uri])) {
            $route = $this->routes[$this->method][$uri];
        } else {
            // Try to match with parameters
            $route = $this->matchRoute($uri);
        }

        if (!$route) {
            $this->notFound();
        }

        // Parse route
        $this->parseRoute($route);

        // Load controller
        $this->loadController();
    }

    /**
     * Get current URI
     */
    private function getCurrentUri()
    {
        if (isset($_GET['url'])) {
            $uri = '/' . trim($_GET['url'], '/');
            if ($uri !== '/' && preg_match('#^(.+)/index$#', $uri, $matches)) {
                $uri = $matches[1];
            }
            return $uri === '/' ? '/' : $uri;
        }

        // Check if path is passed via query parameter (from redirect)
        if (isset($_GET['path'])) {
            $uri = '/' . ltrim($_GET['path'], '/');
            if ($uri !== '/' && preg_match('#^(.+)/index$#', $uri, $matches)) {
                $uri = $matches[1];
            }
            return $uri;
        }

        // Fallback to parsing REQUEST_URI
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $basePath = str_replace('\\', '/', dirname(dirname($scriptName)));

        // For redirected requests, check if URI contains the script path
        if (strpos($uri, $scriptName) === 0) {
            $uri = substr($uri, strlen($scriptName));
        }

        // Remove base path if it exists
        if ($basePath !== '/' && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        return rtrim($uri, '/') ?: '/';
    }

    /**
     * Match route with parameters
     */
    private function matchRoute($uri)
    {
        foreach ($this->routes[$this->method] ?? [] as $path => $route) {
            $pattern = preg_replace('#:[a-z]+#', '([^/]+)', $path);
            if (preg_match("#^{$pattern}$#", $uri, $matches)) {
                array_shift($matches);
                $this->params = $matches;
                return $route;
            }
        }
        return false;
    }

    /**
     * Parse route
     */
    private function parseRoute($route)
    {
        list($this->controller, $this->action) = explode('@', $route);
    }

    /**
     * Load controller and execute action
     */
    private function loadController()
    {
        $controllerClass = ucfirst($this->controller) . 'Controller';
        $controllerPath = CONTROLLERS_PATH . '/' . $controllerClass . '.php';

        if (!file_exists($controllerPath)) {
            die("Controller not found: {$controllerPath}");
        }

        require_once $controllerPath;

        if (!class_exists($controllerClass)) {
            die("Controller class not found: {$controllerClass}");
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $this->action)) {
            die("Action not found: {$this->action} in {$controllerClass}");
        }

        $action = $this->action;
        echo $controller->$action(...$this->params);
    }

    /**
     * 404 Not Found
     */
    private function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        die("Page not found");
    }
}
