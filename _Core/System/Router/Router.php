<?php
namespace DadanDev\Core\System\Router;

class Router
{
    public $controllerRegistered;
    public $routes = [];
    public function addRoute($routes)
    {
        $this->routes = array_merge($this->routes, $routes);
    }

    public function register(array $controllerRegistered)
    {
        $this->controllerRegistered = $controllerRegistered;
    }
    public function parsingRoute()
    {
        foreach ($this->controllerRegistered as $controller) {
            $classReflection = new \ReflectionClass($controller);
            foreach ($classReflection->getMethods() as $method) {
                $attributes = $method->getAttributes(\DadanDev\Core\System\Router\Attributes\Route::class, \ReflectionAttribute::IS_INSTANCEOF);
                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();
                    $this->addRoute([
                        $route->method => [
                            'method' => $method->getName(),
                            'controller' => $controller,
                            'route' => $route->route,
                            'middleware' => $route->middleware,
                        ]
                    ]);
                }
            }
        }
    }
    public function runMiddleware($middleware)
    {
        if (is_array($middleware)) {
            foreach ($middleware as $value) {
                $middleware = new $value();
                $middleware->before();
            }
        }
        $middleware = new $middleware();
        $middleware->before();
    }
    public function run(string $urlServer = '/')
    {
        $this->parsingRoute();
        foreach ($this->routes as $key => $routes) {
            $routePattern = str_replace(['id', 'slug'], ['[0-9]+', '[a-zA-Z0-9_-]+'], trim($routes['route'], '/'));
            if (preg_match('#^' . $routePattern . "$#", trim($urlServer, '/'), $params)) {
                $controller = new $routes['controller']();
                $method = $routes['method'];
                array_shift($params);
                if ($_SERVER['REQUEST_METHOD'] == $key) {
                    if (isset($routes['middleware']) && !empty($routes['middleware'])) {
                        $this->runMiddleware($routes['middleware']);
                    }
                    return $controller->$method(...$params);
                } else {
                    http_response_code(405);
                    return "Method Not Allowed";
                }
            }
        }
        return "Page Not Found";
    }
}