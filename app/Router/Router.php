<?php

namespace App\Router;

class Router
{
    private array $routes = [];
    private string $currentPath = '';
    private string $currentMethod = 'GET';

    public function __construct()
    {
        $this->currentMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->parseCurrentPath();
    }

    private function parseCurrentPath(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $basePath = $this->getBasePath();

        if (!empty($basePath)) {
            $path = preg_replace('#^' . preg_quote($basePath, '#') . '#', '', $path);
        }

        $this->currentPath = '/' . ltrim($path, '/');
    }

    private function getBasePath(): string
    {
        $scriptPath = dirname($_SERVER['SCRIPT_NAME'] ?? '');
        return $scriptPath === '/' ? '' : $scriptPath;
    }

    public function get(string $path, callable|string $controller): self
    {
        return $this->addRoute('GET', $path, $controller);
    }

    public function post(string $path, callable|string $controller): self
    {
        return $this->addRoute('POST', $path, $controller);
    }

    public function put(string $path, callable|string $controller): self
    {
        return $this->addRoute('PUT', $path, $controller);
    }

    public function delete(string $path, callable|string $controller): self
    {
        return $this->addRoute('DELETE', $path, $controller);
    }

    public function any(string $path, callable|string $controller): self
    {
        foreach (['GET', 'POST', 'PUT', 'DELETE'] as $method) {
            $this->addRoute($method, $path, $controller);
        }
        return $this;
    }

    private function addRoute(string $method, string $path, callable|string $controller): self
    {
        $pattern = $this->pathToRegex($path);
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'pattern' => $pattern,
            'controller' => $controller,
        ];
        return $this;
    }

    private function pathToRegex(string $path): string
    {
        $pattern = preg_replace_callback(
            '#\{([a-z_]+)(?::([^}]+))?\}#i',
            fn($matches) => '(?P<' . $matches[1] . '>' . ($matches[2] ?? '[^/]+') . ')',
            $path
        );

        return '#^' . $pattern . '$#i';
    }

    public function match(): ?array
    {
        foreach ($this->routes as $route) {
            if ($route['method'] !== $this->currentMethod) {
                continue;
            }

            if (preg_match($route['pattern'], $this->currentPath, $matches)) {
                $params = array_filter($matches, fn($k) => !is_numeric($k), ARRAY_FILTER_USE_KEY);
                return [
                    'path' => $route['path'],
                    'controller' => $route['controller'],
                    'params' => $params,
                ];
            }
        }

        return null;
    }

    public function dispatch(): void
    {
        $matched = $this->match();

        if (!$matched) {
            header('HTTP/1.1 404 Not Found');
            require __DIR__ . '/../../public/404.php';
            exit;
        }

        $controller = $matched['controller'];
        $params = $matched['params'];

        if (is_callable($controller)) {
            call_user_func_array($controller, $params);
        } elseif (is_string($controller)) {
            $this->callControllerString($controller, $params);
        }
    }

    private function callControllerString(string $controller, array $params): void
    {
        [$class, $method] = explode('@', $controller);

        if (!class_exists($class)) {
            throw new \RuntimeException("Controller class $class not found");
        }

        $instance = new $class();
        if (!method_exists($instance, $method)) {
            throw new \RuntimeException("Method $method not found in $class");
        }

        call_user_func_array([$instance, $method], $params);
    }

    public function getPath(): string
    {
        return $this->currentPath;
    }

    public function getMethod(): string
    {
        return $this->currentMethod;
    }
}
