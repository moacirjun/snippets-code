<?php

namespace App\Models\DAO;
use App\Models\Entidades\Cliente;

/**
 *
 * @author MoacirjuN
 */
class ClienteDAO extends BaseDAO {
    public function listar($id = null)
    {
        if (isset($id))
        {
            $resultado = $this->select(
                "SELECT * FROM tb_usuarios WHERE id = ?",
                [$id]
            );
        }
        else
        {
            $resultado = $this->select(
                "SELECT * FROM tb_usuarios"
            );
        }
        
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Cliente::class);
    }
    
    public function salvar(Cliente $cliente) {
        try 
        {            
            return $this->insert(
                'tb_usuarios',
                [
                    'nome' => $cliente->get_nome(),
                    'rg' => $cliente->get_rg(),
                    'cpf' => $cliente->get_cpf(),
                    'telefone' => $cliente->get_telefone(),
                    'email' => $cliente->get_email(),
                    'login' => $cliente->get_login(),
                    'senha' => $cliente->get_senha(),
                    'tipo' => $cliente->get_tipo(),
                ]
            );
        }

        catch (Exception $e)
        {
            throw new Exception("Erro na gravação de dados.");
        }
    }
    
    public function editar(Cliente $cliente) {
        try 
        {            
            return $this->update(
                'tb_usuarios',
                [
                    'nome' => $cliente->get_nome(),
                    'rg' => $cliente->get_rg(),
                    'cpf' => $cliente->get_cpf(),
                    'telefone' => $cliente->get_telefone(),
                    'email' => $cliente->get_email(),
                    'login' => $cliente->get_login(),
                    'senha' => $cliente->get_senha(),
                    'tipo' => $cliente->get_tipo()
                ],
                $cliente->get_id()
            );
        }

        catch (Exception $e)
        {
            throw new Exception("Erro na gravação de dados.");
        }
    }
    
    public function excluir(Cliente $usuario)
    {
        try 
        {
            $id = $usuario->get_id();

            return $this->delete('tb_usuarios',$id);

        }
        catch (Exception $e)
        {
            throw new Exception("Erro ao deletar");
        }
    }
    
    public function verificar_existencia_cpf(Cliente $cliente) {
        $resultado = $this->select(
            "SELECT count(*) FROM tb_usuarios WHERE cpf = ? ",
            [$cliente->get_cpf()]
        );
        
        return $resultado->fetchColumn();
    }
    
    public function verificar_existencia_rg(Cliente $cliente) {
        $resultado = $this->select(
            "SELECT count(*) FROM tb_usuarios WHERE rg = ? ",
            [$cliente->get_rg()]
        );
        
        return $resultado->fetchColumn();
    }
    
    public function verificar_existencia_email(Cliente $cliente) {
        $resultado = $this->select(
            "SELECT count(*) FROM tb_usuarios WHERE email = ? ",
            [$cliente->get_email()]
        );
        
        return $resultado->fetchColumn();
    }
    
    public function autenticar(Cliente $cliente) {
        
        $resultado = $this->select(
            "SELECT id, nome, email  FROM tb_usuarios WHERE email = ? AND senha = ? ",
            [
                $cliente->get_email(),
                $cliente->get_senha()
            ]
        );
        
        if ($resultado->rowCount() > 0) {
            $resultado->setFetchMode(\PDO::FETCH_CLASS, Cliente::class);
            $new_cliente = $resultado->fetch();
            
            return $new_cliente;
        }
        else {
            return false;
        }
    }
}
