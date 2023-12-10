<?php

namespace DadanDev\Core\Controllers\Auth;
use DadanDev\Core\Middleware\LoginMiddleware;
use DadanDev\Core\System\Controllers;
use DadanDev\Core\System\Router\Attributes\Get;
class LoginController extends Controllers{
    #[Get('/auth/login')]
    public function index(){
        return $this->f_view('login');
    }
}