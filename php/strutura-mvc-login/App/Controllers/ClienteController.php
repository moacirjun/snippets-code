<?php

namespace App\Controllers;

use App\Services\ClienteService;
use App\Models\Entidades\Cliente;

use App\Lib\Cookie;
use App\Lib\Sessao;
use App\Lib\Criptografia;

/**
 *
 * @author MoacirjuN
 */
class ClienteController extends Controller {
    
    public function index() {
        
        if (Cookie::verificar_usuario_logado()) {
            $this->render("/cliente/index");
        }
        else {
            $this->redirect("/cliente/login");
        }
    }
    
    public function login() {
        if (Sessao::existeFormulario()) {
            $cliente = new Cliente(Sessao::retornaFormulario());
        }
        else {
            $cliente = new Cliente();
        }
        
        $this->setViewParam("cliente", $cliente);
        $this->render("/cliente/login");
        
        Sessao::limpaErro();
    }
    
    public function autenticar() {
        $campos = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $cliente_digitado = new Cliente($campos);
        $cliente_service = new ClienteService();
        
        Sessao::gravaFormulario($campos);
        
        $cliente_banco = $cliente_service->autenticar($cliente_digitado);
        
        if ( $cliente_banco ) {
            $cliente_service->logar($cliente_banco);
            $this->redirect("/home/index");
        }
        else {
            $this->redirect("/cliente/login");
        }
    }
    
    public function sair() {
        $cliente_service = new ClienteService();
        $cliente_service->deslogar();
        $this->redirect("/home");
    }

    public function cadastrar() {
        $this->render("/cliente/cadastrar");
    }

    public function registrar_cadastro() {
        $cliente_service = new ClienteService();
        $campos = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $cliente = new Cliente($campos);
        $cliente->set_tipo(Cliente::TIPO_CLIENTE);
        
        $criptpgrafia = new Criptografia();
        $cliente->set_senha($criptpgrafia->criptografar_senha($cliente->get_senha()));

        if ( $cliente_service->salvar($cliente) ) {
            $cliente_service->logar($cliente);
            $this->redirect("/home/");
        }
        else {
            Sessao::gravaFormulario($campos);
            $this->redirect("/cliente/login");
        }
    }
}
