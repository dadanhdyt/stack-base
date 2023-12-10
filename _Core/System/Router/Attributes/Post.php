<?php
namespace DadanDev\Core\System\Router\Attributes;

use DadanDev\Core\System\Router\Attributes\Route;
use Attribute;

#[Attribute]
class Post extends Route
{
    public function __construct(string $path = '', $middleware = [])
    {
        parent::__construct($path, "POST", $middleware);
    }
}