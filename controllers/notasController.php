<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of notasController
 *
 * @author Diego
 */
class notasController extends controller {

    //put your code here
    public function index() {
        echo 'ok';
    }

    public function insere() {
//        print_r($_POST);
        $notas = new Notas();
        $retorno = $notas->adiciona($_POST);
        if ($retorno) {
            echo json_encode($retorno);
        } else {
            echo json_encode('erro');
        }
    }

    public function busca($id, $id_client) {
//        echo $id_client;
//        echo 'ok';
        $notas = new Notas();
        $retorno = $notas->buscaNotas($id, $id_client);
//        var_dump($retorno[1]);
        if ($retorno) {
            $passaArray = array();
            $cont = 0;
            foreach ($retorno[1] as $value) {
                $passaArray[$cont]['id'] = (int) $value['id'];
                $data = $value['data'];
                $mostrarData = date('d/m/Y H:i:s', strtotime($data));
                $passaArray[$cont]['data'] = $mostrarData;
                $passaArray[$cont]['nota'] = $value['nota'];
                $passaArray[$cont]['id_user'] = $value['id_user'];
                $passaArray[$cont]['id_client'] = $value['id_client'];
                $passaArray[$cont]['nome'] = $value['nome'];
                $passaArray[$cont]['cont'] = $retorno[0];
                $cont = $cont + 1;
            }
            echo json_encode($passaArray);
        } else {
            echo json_encode('erro');
        }
    }

}
