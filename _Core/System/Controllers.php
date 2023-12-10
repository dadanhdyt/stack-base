<?php
namespace DadanDev\Core\System;

class Controllers{
    public $activeTemplate = 'dadan';
    public function f_view($viewName, $data = []){
        return view(templateActive:config('default_theme'), viewName: $viewName,data:$data);
    }
}