<?php

namespace App\Lib;
use App\Models\Entidades\Cliente;
use App\Models\Entidades\Usuario;
/**
 * Manipulação de Cookies
 * 
 * @author MoacirjuN
 */
class Cookie {
    
    public static function verificar_usuario_logado() {
        return isset($_COOKIE["USER"]);
    }
    
    public static function logar_cliente(Cliente $cliente) {
        $array_assoc["id"] = $cliente->get_id();
        $array_assoc["nome"] = $cliente->get_nome();
        $array_assoc["email"] = $cliente->get_email();
        $array_assoc["CEP"] = "";
        
        setcookie("USER", json_encode($array_assoc), time()+86400, "/", $_SERVER['HTTP_HOST'] ); //Um dia
    }
    
    public static function deslogar() {
        setcookie("USER", null, -1, "/", $_SERVER['HTTP_HOST'] );
        unset($_COOKIE["USER"]);
    }
    
    public static function get_usuario_logado() {
        $campos = json_decode( filter_input(INPUT_COOKIE, "USER"), JSON_UNESCAPED_UNICODE );
        
        return (Cookie::verificar_usuario_logado()) ? new Usuario($campos) : FALSE;
    }
}