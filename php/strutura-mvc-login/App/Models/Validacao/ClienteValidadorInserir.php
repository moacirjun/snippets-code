<?php

namespace App\Models\Validacao;

use App\Models\Validacao\ResultadoValidacao;
use App\Models\DAO\ClienteDAO;
use App\Models\Entidades\Cliente;
/**
 *
 * @author MoacirjuN
 */
class ClienteValidadorInserir {
    
    public static function validar(Cliente $cliente) {
        
        $resultado_validacao = new ResultadoValidacao();
        $cliente_dao = new ClienteDAO();
        
        if (empty($cliente->get_nome())) {
            $resultado_validacao->add_erro("Nome", "<b>Nome: Este campo não pode ser vazio");
        }        
        
        if (empty($cliente->get_cpf())) {
            $resultado_validacao->add_erro("CPF", "<b>CPF: Este campo não pode ser vazio");
        }        
        
        if (empty($cliente->get_email())) {
            $resultado_validacao->add_erro("Email", "<b>Email: Este campo não pode ser vazio");
        }        
        
        if (empty($cliente->get_senha())) {
            $resultado_validacao->add_erro("Senha", "<b>Senha: Este campo não pode ser vazio");
        }

        if ($cliente_dao->verificar_existencia_cpf($cliente)) {
            $resultado_validacao->add_erro("CPF", "<b>CPF: Já existe um cliente cadastrado com esse CPF");
        }

        if ($cliente_dao->verificar_existencia_rg($cliente)) {
            $resultado_validacao->add_erro("RG", "<b>RG: Já existe um cliente cadastrado com esse RG");
        }

        if ($cliente_dao->verificar_existencia_email($cliente)) {
            $resultado_validacao->add_erro("E-Mail", "<b>E-Mail: Já existe um cliente cadastrado com esse E-mail");
        }
        
        return $resultado_validacao;
    }
}
