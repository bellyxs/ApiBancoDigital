<?php

use ApiBancoDigital\Controller;
use ApiBancoDigital\Controller\CorrentistaController;
use ApiBancoDigital\Controller\ContaController;
use ApiBancoDigital\Controller\ChavePixController;
use ApiBancoDigital\Controller\TransacaoController;


$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url) {

    /*CORRENTISTA*/

    case '/correntista/save':
       CorrentistaController::save();
    break;

    case 'correntista/entrar':
        CorrentistaController::auth();
    break;

    /*CONTA*/
    case 'conta/entrar':
         ContaController::listar();
    break;

    case 'conta/save':
         ContaController::save();
    break;

    case 'conta/delete':
         ContaController::delete();
    break;

    case 'conta/extrato':
        /*ContaController::*/
    break;
    
    
    /*TRANSACAO*/
    case 'conta/pix/enviar':
        /*TransacaoController::*/
    break;

    case 'conta/pix/receber':
        /*TransacaoController::*/
    break;

   

    default:
            http_response_code(403);
            break;

}