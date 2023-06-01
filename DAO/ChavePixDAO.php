<?php

namespace ApiBancoDigital\DAO;
use ApiBancoDigital\Model\ChavePixModel;
use \PDO;


class ChavePixDAO extends DAO
{
    public function __construct()
    {
        return parent::__construct();    
    }

    public function insert (ChavePixModel $model)
    {
        $sql = "INSERT INTO chave_pix (tipo, chave) VALUES (?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->chave);
        $stmt->execute();

    }

    public function update(ChavePixModel $model)
    {
        $sql = "UPDATE chave_pix SET tipo=?, chave=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->chave);
        $stmt->bindValue(3, $model->id);
        $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM chave_pix";

        $stmt=$this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectById(int $id)
    {
        include_once 'Model/ChavePixModel.php';

        $sql = "SELECT id, tipo, chave FROM chave_pix WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("ApiBancoDigital\Model\ChavePixModel");
    }


    public function delete(int $id)
    {
        $sql = "DELETE FROM chave_pix WHERE id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}
