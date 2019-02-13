<?php

namespace App\Lib;

use Exception;
use App\Lib\Cookie;

class Erro
{
    private $message;
    private $code;

    public function __construct($objetoException = Exception::class)
    {
        $this->code     = $objetoException->getCode();
        $this->message  = $objetoException->getMessage();
    }

    public function render()
    {
        $errorMessage = $this->message;
        $errorCode = $this->code;
        $usuario_logado = (Cookie::verificar_usuario_logado()) ? 
                Cookie::get_usuario_logado() : 
                null;

        require_once PATH  . '/App/Views/layouts/head.php';
        require_once PATH  . '/App/Views/layouts/header.php';
        require_once PATH  . '/App/Views/layouts/menu.php';
        require_once PATH  . '/App/Views/error/erro.php';
        require_once PATH  . '/App/Views/layouts/footer.php';
    }
}