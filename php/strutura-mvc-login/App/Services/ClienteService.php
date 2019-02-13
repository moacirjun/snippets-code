<?php

namespace App\Services;

use App\Models\Entidades\Cliente;

use App\Models\DAO\ClienteDAO;

use App\Models\Validacao\ClienteValidadorInserir;

use App\Lib\Sessao;
use App\Lib\Criptografia;
use App\Lib\Cookie;
/**
 *
 * @author Moacir
 */
class ClienteService {
   
    private $cliente_DAO;
    
    public function __construct() {
        $this->cliente_DAO = new ClienteDAO();
    }
    
    public function listar($id = null) {
        return $this->cliente_DAO->listar($id);
    }
    
    public function salvar(Cliente $usuario) {
        
        $resutado_validacao = ClienteValidadorInserir::validar($usuario);
        
        if ($resutado_validacao->get_erros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resutado_validacao->get_erros());
        }
        else {
            $this->cliente_DAO->salvar($usuario);
            Sessao::limpaFormulario();
            return TRUE;
        }
        
        return FALSE;
    }
    
    public function editar(Cliente $cliente) {
        return $this->cliente_DAO->editar($cliente);
    }
    
    public function excluir(Cliente $cliente) {
        return $this->cliente_DAO->excluir($cliente);
    }
    
    public function autenticar(Cliente $cliente) {
        
        $criptografia = new Criptografia();
        $cliente->set_senha($criptografia->criptografar_senha($cliente->get_senha()));
        
        return $this->cliente_DAO->autenticar($cliente);
    }
    
    public function logar(Cliente $cliente) {
        Cookie::logar_cliente($cliente);
    }
    
    public function deslogar() {
        Cookie::deslogar();
    }
}
