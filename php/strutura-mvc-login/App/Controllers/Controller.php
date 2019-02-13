<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Lib\Cookie;

abstract class Controller
{
    private $app;
    private $viewVar;

    public function __construct($app)
    {
        $this->app = $app;
        $this->setViewParam('nameController', $this->app->getControllerName());
        $this->setViewParam('nameAction', $this->app->getAction());
    }

    public function render($view)
    {
        $viewVar   = $this->getViewVar();
        $sessao    = Sessao::class;
        $usuario_logado = (Cookie::verificar_usuario_logado()) ? 
                Cookie::get_usuario_logado() : 
                null;

        require_once $this->app->getPath() . '/App/Views/layouts/head.php';
        require_once $this->app->getPath() . '/App/Views/layouts/header.php';
        require_once $this->app->getPath() . '/App/Views/layouts/menu.php';
        require_once $this->app->getPath() . '/App/Views/' . $view . '.php';
        require_once $this->app->getPath() . '/App/Views/layouts/footer.php';
    }

    public function redirect($view)
    {
        header('Location: http://' . $this->app->getHost() . $view);
        exit;
    }

    public function getViewVar()
    {
        return $this->viewVar;
    }

    public function setViewParam($varName, $varValue)
    {
        if ($varName != "" && $varValue != "") 
        {
            $this->viewVar[$varName] = $varValue;
        }
    }
    
    public function is_home() {
        return $this->app->getControllerName() == "HomeController";
    }
    
    public function dd($var) {
        echo "<pre>";
        var_dump($var);
        die;
    }
}