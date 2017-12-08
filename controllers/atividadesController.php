<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of atividadesController
 *
 * @author Diego
 */
class atividadesController extends controller {

    //put your code here
    public function index() {
        echo 'ok';
    }

    public function insere() {
        $atividades = new Atividades();
        $retorno = $atividades->insereAtividade($_POST);
        if ($retorno) {
            echo json_encode($retorno);
        } else {
            echo json_encode('erro');
        }
    }

}
