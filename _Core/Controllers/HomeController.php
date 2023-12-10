<?php

namespace DadanDev\Core\Controllers;

use DadanDev\Core\System\Router\Attributes\Get;
use DadanDev\Core\System\Router\Attributes\Post;

class HomeController
{
    #[Get('/')]
    public function index()
    {
        return "WORK!";
    }
    #[Post('/profile/(slug)')]
    public function about(string $slug)
    {
        echo "ABOUT".$slug;
    }
}