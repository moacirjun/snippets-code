<?php

use App\App;
use App\Lib\Erro;

session_start();

error_reporting(E_ALL & ~E_NOTICE);

require_once("vendor/autoload.php");

define('APP_HOST'       , $_SERVER['HTTP_HOST'] . "/jovens-pelo-futuro");
define('APP_HOST_HTTP'       , "http://" . $_SERVER['HTTP_HOST'] . "/jovens-pelo-futuro");
define('PATH'           , realpath('./'));       

try {
	$app = new App();
	$app->run();
}catch (\Exception $e){
	$oError = new Erro($e);
	$oError->render();
}
