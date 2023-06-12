<?php

namespace ApiBancoDigital\Model;
use ApiBancoDigital\DAO\CorrentistaDAO;

class CorrentistaModel extends Model {
    public $id, $nome, $cpf, $senha, $data_nasc;



    public function save() : ?CorrentistaModel
    {
        return (new CorrentistaDAO())->save($this);     

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

    public function getCorrentistaByCpfAndSenha($cpf, $senha) : CorrentistaModel
    {      
        return (new CorrentistaDAO())->selectCorrentistaByCpfAndSenha($cpf, $senha);
    }
}
