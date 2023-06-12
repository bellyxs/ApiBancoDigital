<?php

namespace ApiBancoDigital\DAO;
use ApiBancoDigital\Model\CorrentistaModel;
use \PDO;

class CorrentistaDAO extends DAO
{
    public function __construct()
    {
        return parent::__construct();    
    }

    /**
     * 
     */
    public function save(CorrentistaModel $m) : CorrentistaModel
    {
        return ($m->id == null) ? $this->insert($m) : $this->update($m);
    }

    public function insert (CorrentistaModel $model)
    {
        $sql = "INSERT INTO correntista (nome, cpf, senha, data_nasc) VALUES (?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->cpf);
        $stmt->bindValue(3, $model->senha);
        $stmt->bindValue(4, $model->data_nasc);
        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function update(CorrentistaModel $model)
    {
        $sql = "UPDATE conta SET nome=?, cpf=?, senha=?, data_nasc=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->cpf);
        $stmt->bindValue(3, $model->senha);
        $stmt->bindValue(4, $model->data_nasc);
        $stmt->bindValue(5, $model->id);
        $stmt->execute();
    }


    public function selectById(int $id)
    {
        include_once 'Model/CorrentistaModel.php';

        $sql = "SELECT id, nome, cpf, senha, data_nasc FROM conta WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("ApiBancoDigital\Model\CorrentistaModel");
    }


    public function search(string $query) : array
    {
        $str_query = ['filtro' => '%' . $query . '%'];

        $sql = "SELECT * FROM correntista WHERE nome LIKE :filtro ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($str_query);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "ApiBancoDigital\Model\CorrentistaModel");
    }

    public function getCorrentistaByCpfAndSenha($cpf, $senha)
    {
        $sql = "SELECT *             
        FROM Correntista c             
       
        WHERE cpf = ? AND senha = sha1(?)
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->bindValue(2, $senha);

        $stmt->execute();

        return $stmt->fetchObject();
    }

    public function selectCorrentistaByCpfAndSenha($cpf, $senha) 
    {
        $sql = "SELECT * FROM correntista WHERE cpf = ? AND senha = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->bindValue(2, $senha);
        $stmt->execute();
        
        return $stmt->fetchObject("ApiBancoDigital\Model\CorrentistaModel");
       
    }
}

