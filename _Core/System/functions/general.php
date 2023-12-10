<?php
use \Jenssegers\Blade\Blade;

function view($viewName = null, $data = [])
{

    $blade = new Blade(SELF_PATH."views", SELF_PATH."__cache".DS."views");
    return $blade->make($viewName, $data)->render();
}