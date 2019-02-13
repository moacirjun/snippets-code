<?php

namespace App\Models\DAO;

use App\Lib\Conexao;

abstract class BaseDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getConnection();
    }

    public function select($sql, $params = array()) 
    {
        if(!empty($sql))
        {
            if ( count($params) > 0) {
                $query = $this->conexao->prepare($sql);
                $query->execute($params);
                return $query;
            }
            
            return $this->conexao->query($sql);
        }
    }

    public function insert($tabela, $array_campos_valores)
    {
        if(!empty($tabela) && !empty($array_campos_valores))
        {
            foreach ($array_campos_valores as $key => $valor) {
                $array_colunas[] = $key;
                $array_valores[] = $valor;
                $array_parametros[] = " ?";
            }
            $colunas = implode(", ", $array_colunas);
            $params = implode(", ", $array_parametros);
            
            $stmt = $this->conexao->prepare("INSERT INTO $tabela ($colunas) VALUES ($params)");
            $stmt->execute($array_valores);

            return $this->conexao->lastInsertId();
        }else{
            return false;
        }
    }

    public function update($tabela, $array_campos_valores, $id=null) 
    {
        if(!empty($tabela) && !empty($array_campos_valores))
        {
            foreach ($array_campos_valores as $key => $valor) {
                $array_campos[] = $key . " = ?";
                $array_valores[] = $valor;
            }
            $str_campos = implode(", ", $array_campos);
            
            if($id)
            {
                $str_where = " WHERE id = $id ";
            }

            $sql = "UPDATE $tabela SET $str_campos $str_where";
            
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute($array_valores);

            return $stmt->rowCount();
        }
        else
        {
            return false;
        }
    }
    
    public function delete($tabela, $id=null) 
    {
        if(!empty($tabela))
        {
            if($id)
            {
                $str_where = " WHERE id = $id ";
            }

            $stmt = $this->conexao->prepare("DELETE FROM $tabela $str_where");
            $stmt->execute();

            return $stmt->rowCount();
        }
        else
        {
            return false;
        }
    }
}