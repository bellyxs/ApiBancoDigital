<?php

namespace ApiBancoDigital\DAO;
use ApiBancoDigital\Model\ContaModel;
use \PDO;

class ContaDAO extends DAO
{
    public function __construct()
    {
        return parent::__construct();    
    }

    public function insert (ContaModel $model)
    {
        $sql = "INSERT INTO chave_pix (tipo, saldo, limite) VALUES (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->saldo);
        $stmt->bindValue(3, $model->limite);
        $stmt->execute();

    }

    public function update(ContaModel $model)
    {
        $sql = "UPDATE conta SET tipo=?, saldo=?, limite=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->saldo);
        $stmt->bindValue(3, $model->limite);
        $stmt->bindValue(4, $model->id);
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
        include_once 'Model/ContaModel.php';

        $sql = "SELECT id, tipo, saldo, limite FROM conta WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("ApiBancoDigital\Model\ContaModel");
    }


    public function delete(int $id)
    {
        $sql = "DELETE FROM conta WHERE id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}
