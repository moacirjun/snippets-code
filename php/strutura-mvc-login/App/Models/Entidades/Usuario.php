<?php

namespace App\Models\Entidades;

/**
 *
 * @author Moacir Lima Jr 
 */
class Usuario {
    
    protected $id;
    protected $nome;
    protected $email;
    protected $login;
    protected $senha;
    protected $tipo;
    
    const TIPO_ADMIN = 9;
    const TIPO_CLIENTE = 1;
    const TIPO_VENDEDOR = 2;

    public function __construct($array_assoc = null) {
        if ( isset($array_assoc) && is_array($array_assoc) ) {
            foreach ($array_assoc as $key => $item) {
                if (property_exists(Usuario::class, $key)) {
                    $this->{$key} = $item;                    
                }
            }
        }
    }
    
    public function get_id() {
        return $this->id;
    }

    public function get_nome() {
        return $this->nome;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_login() {
        return $this->login;
    }

    public function get_senha() {
        return $this->senha;
    }

    public function get_tipo() {
        return $this->tipo;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function set_nome($nome) {
        $this->nome = $nome;
    }

    public function set_email($email) {
        $this->email = $email;
    }

    public function set_login($login) {
        $this->login = $login;
    }

    public function set_senha($senha) {
        $this->senha = $senha;
    }

    public function set_tipo($tipo) {
        $this->tipo = $tipo;
    }
}
