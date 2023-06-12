<?php

namespace ApiBancoDigital\Controller;

use ApiBancoDigital\Model\CorrentistaModel;
use Exception;


class CorrentistaController extends Controller
{


    
    public static function salvar() : void
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();
            $model->id = $json_obj->id;
            $model->nome = $json_obj->nome;
            $model->cpf = $json_obj->cpf;
            $model->senha = $json_obj->senha;
            $model->data_nasc = $json_obj->data_nasc;            

            parent::getResponseAsJSON($model->save());
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    public static function auth() 
	{
		$json_obj = parent::getJSONFromRequest();

		$model = new CorrentistaModel();

		parent::getResponseAsJSON($model->auth(isset($_GET['cpf']), $_GET['senha']));		
	}


        public static function login()
    {
        try
        {

            $model = new CorrentistaModel();

            parent::getResponseAsJSON($model->getCorrentistaByCpfAndSenha($_GET['cpf'], $_GET['senha']));

        } catch(Exception $e) {
            
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }  
    }
}