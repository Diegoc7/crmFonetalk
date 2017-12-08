<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notas
 *
 * @author Diego
 */
class Notas extends model {

    //put your code here
    public function adiciona($array) {
//        print_r($array);
        if (isset($array) && is_array($array) && is_numeric($array['id_user']) && $array['id_user'] > 0 && is_numeric($array['id_client'])) {
            extract($array);
            $data = date("Y-m-d H:i:s");
            $nota = addslashes($nota);
            $sql = "INSERT INTO notas VALUES('','$data','$nota','$id_user','$id_client')";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            return $this->db->lastInsertId();
        } else {
            return FALSE;
        }
    }

    public function buscaNotas($id, $id_client) {
        if (isset($id) && !empty($id) && isset($id_client) && !empty($id_client)) {
            $sql = "SELECT notas.*, usuario.nome FROM notas JOIN usuario WHERE  notas.id_client = '$id_client' AND notas.id_user = usuario.id";
//            $sql = "SELECT notas.*, usuario.nome FROM notas JOIN usuario WHERE notas.id_user = '$id' AND usuario.id = '$id' AND notas.id_client = '$id_client'";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            $count = $sql->rowCount();
            $array = $sql->fetchAll();
            $retorno = array(
                $count,
                $array
            );
//            var_dump($retorno);
            return $retorno;
//            return $sql->fetchAll();
        } else {
            return FALSE;
        }
    }
    public function adicionaEmpresa($array) {
//        print_r($array);
        if (isset($array) && is_array($array) && is_numeric($array['id_user']) && $array['id_user'] > 0 && is_numeric($array['id_client'])) {
            extract($array);
            $data = date("Y-m-d H:i:s");
            $nota = addslashes($nota);
            $sql = "INSERT INTO notas_empresa VALUES('','$data','$nota','$id_user','$id_client')";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            return $this->db->lastInsertId();
        } else {
            return FALSE;
        }
    }

    public function buscaNotasEmpresa($id, $id_empresa) {
        if (isset($id) && !empty($id) && isset($id_empresa) && !empty($id_empresa)) {
            $sql = "SELECT notas_empresa.*, usuario.nome FROM notas_empresa JOIN usuario WHERE  notas_empresa.id_empresa = '$id_empresa' AND notas_empresa.id_user = usuario.id";
//            $sql = "SELECT notas.*, usuario.nome FROM notas JOIN usuario WHERE notas.id_user = '$id' AND usuario.id = '$id' AND notas.id_client = '$id_client'";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            $count = $sql->rowCount();
            $array = $sql->fetchAll();
            $retorno = array(
                $count,
                $array
            );
//            var_dump($retorno);
            return $retorno;
//            return $sql->fetchAll();
        } else {
            return FALSE;
        }
    }

}
