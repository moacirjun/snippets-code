<?php

namespace App\Models\Validacao;
/**
 *
 * @author MoacirjuN
 */
class ResultadoValidacao {
    
    private $erros = [];
    
    public function add_erro($campo, $mensagem) {
        $this->erros[$campo] = $mensagem;
    }
    
    public function get_erros() {
        return $this->erros;
    }
}
