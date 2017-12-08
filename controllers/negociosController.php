<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of negociosController
 *
 * @author Diego
 */
class negociosController extends controller {

    //put your code here
    public function index() {
        $dados = array();
        $this->loadTemplate('negocios', $dados);
    }

    public function insere() {
        var_dump($_POST);
        if (isset($_POST) && !empty($_POST['id_user']) && $_POST['id_user'] > 0) {
            $negocios = new Negocios();
            $retorno = $negocios->insereNegocio($_POST);
            if ($retorno) {
                echo json_encode($retorno);
            } else {
                echo json_encode('erro');
            }
        }
    }

}
