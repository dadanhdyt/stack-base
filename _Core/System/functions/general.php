<?php
use Jenssegers\Blade\Blade;

function view($viewName = null, $data = [], $templateActive = 'default')
{

    $blade = new Blade(SELF_PATH . "views" . DS . "template" . DS . $templateActive, SELF_PATH . "_cache" . DS . "views");
    return $blade->make($viewName, $data)->render();
}

function base_url($relativePath = '')
{
    $scheme = 'http';
    if (($_SERVER['https'] ?? false) == true && $_SERVER['https'] == 'on') {
        $scheme = 'https';
    }
    $host = $scheme . "://" . $_SERVER['HTTP_HOST'];
    return $host . str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']) . $relativePath;
}

function config($configName = '')
{
    require ROOT_DIR . 'config.php';
    $config = array_change_key_case($CONFIG, CASE_LOWER);
    if (isset($config[$configName]))
        return $config[$configName];
    $conf = $config;
    foreach (explode('.', $configName) as $value) {
        $conf = $conf[$value] ?? null;
    }
    return $conf;
}

