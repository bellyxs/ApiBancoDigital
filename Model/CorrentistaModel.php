<?php

namespace ApiBancoDigital\Model;
use ApiBancoDigital\DAO\CorrentistaDAO;

class CorrentistaModel extends Model {
    public $id, $nome, $cpf, $senha, $data_nasc;

    public function save()
    {
        $dao = new CorrentistaDAO();

        if(empty($this->id))
        {
            $dao->insert($this);
        } else {
            $dao->update($this);
        }

    }

    public function getAllRows()
    {
        $dao = new CorrentistaDAO();

        $this->rows = $dao->select();
    }

     public function delete()
    {
        (new CorrentistaDAO())->delete($this->id);
    }


    public function getById(int $id)
    {

        $dao = new CorrentistaDAO();
        $this->rows = $dao->selectById($id);
    }

    public function auth($cpf, $senha){
        $dao = new CorrentistaDAO();

        return $dao->getCorrentistaByCpfAndSenha($cpf, $senha);
    }
}