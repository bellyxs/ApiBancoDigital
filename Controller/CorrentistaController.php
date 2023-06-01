<?php

namespace ApiBancoDigital\Controller;

use ApiBancoDigital\Model\CorrentistaModel;
use Exception;


class CorrentistaController extends Controller
{

    public static function save() : void
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();
            $model->id = $json_obj->Id;
            $model->nome = $json_obj->Nome;
            $model->cpf = $json_obj->Cpf;
            $model->senha = $json_obj->Senha;
            $model->data_nasc = $json_obj->Data_Nasc;

            $model->id = $model->save();
            parent::getResponseAsJSON($model);
              
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

    public static function delete() : void
    {
        try 
        {
            $model = new CorrentistaModel();
            
            $model->id = parent::getIntFromUrl(isset($_GET['id']) ? $_GET['id'] : null);

            $model->delete();

           
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    public static function buscar() : void
    {
        try
        {
            $model = new CorrentistaModel();
            
            $q = json_decode(file_get_contents('php://input'));
            
    
            $model->getAllRows($q);

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }
}