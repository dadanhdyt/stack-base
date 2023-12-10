<?php
define("DS",DIRECTORY_SEPARATOR);
define("SELF_PATH",dirname(__FILE__).DS);
define("ROOT_DIR",dirname(SELF_PATH).DS);
/**
 * load composer autoload file
 */
$autoloadPath = ROOT_DIR.'vendor/autoload.php';
if ( !file_exists($autoloadPath) )
{
  die('System Error');
}
require $autoloadPath;
require ROOT_DIR.'config.php';
$router =  new DadanDev\Core\System\Router\Router();
$router->register(require(ROOT_DIR.'ControllerRegister.php'));
try{
    $router->run($_SERVER['PATH_INFO'] ?? '/');
}catch(Exception $e){
    die($e->getMessage());
}