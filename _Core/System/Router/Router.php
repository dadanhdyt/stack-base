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
    public function run(string $urlServer = '/')
    {
        $this->parsingRoute();
        foreach ($this->routes as $routes) {
            $routePattern = str_replace(['id','slug'],['[0-9]+','[a-zA-Z0-9_-]+'],trim($routes['route'],'/'));
            echo $routePattern;
            if (preg_match('#^' . $routePattern . "$#", trim($urlServer,'/'), $params)) {
                $controller = new $routes['controller']();
                $method = $routes['method'];
                array_shift($params);
                $controller->$method(...$params);
            }
        }
    }
}