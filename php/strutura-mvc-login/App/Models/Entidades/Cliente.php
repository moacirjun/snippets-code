<?php

namespace App\Models\Entidades;

use App\Models\Entidades\Usuario;

/**
 *
 * @author Moacir
 */
class Cliente extends Usuario {
    
    protected $rg;
    protected $cpf;
    protected $telefone;
    protected $enderecos;
    
    public function __construct($array_assoc = null) {
        if ( isset($array_assoc) && is_array($array_assoc) ) {
            foreach ($array_assoc as $key => $item) {
                if (property_exists(Cliente::class, $key)) {
                    $this->{$key} = $item;                    
                }
            }
        }
    }
    
    public function get_rg() {
        return $this->rg;
    }

    public function get_cpf() {
        return $this->cpf;
    }

    public function get_telefone() {
        return $this->telefone;
    }

    public function get_enderecos() {
        return $this->enderecos;
    }

    public function set_rg($rg) {
        $this->rg = $rg;
    }

    public function set_cpf($cpf) {
        $this->cpf = $cpf;
    }

    public function set_telefone($telefone) {
        $this->telefone = $telefone;
    }

    public function set_enderecos($enderecos) {
        $this->enderecos = $enderecos;
    }
}
