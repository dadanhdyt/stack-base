<?php

namespace DadanDev\Core\Controllers\Auth;
use DadanDev\Core\Middleware\LoginMiddleware;
use DadanDev\Core\System\Router\Attributes\Get;
class LoginController{
    #[Get('/auth/login')]
    public function index(){
        return view('auth.login');
    }
}