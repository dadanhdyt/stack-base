<?php
namespace DadanDev\Core\System\Router\Attributes;
use \Attribute;
use DadanDev\Core\System\Router\Interface\RouteInterface;
#[Attribute]
class Route implements RouteInterface{
    public function __construct(public string $route = '/', public string $method = "GET", public mixed $middleware = []) {
        
    }
}
