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

    public function insert (CorrentistaModel $model)
    {
        $sql = "INSERT INTO correntista (nome, cpf, senha, data_nasc) VALUES (?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->cpf);
        $stmt->bindValue(3, $model->senha);
        $stmt->bindValue(4, $model->data_nasc);
        $stmt->execute();

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

    public function select()
    {
        $sql = "SELECT * FROM conta";

        $stmt=$this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
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


    public function delete(int $id)
    {
        $sql = "DELETE FROM conta WHERE id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
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
}