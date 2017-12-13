<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Arquivos
 *
 * @author Diego
 */
class Arquivos extends model {

    //put your code here
    public function insereArquivoBD($nome, $id, $caminho, $tipo) {
        $data = date("Y-m-d H:i:s");
        $sql = "INSERT INTO arquivo_$tipo VALUES('','$data','$nome','$caminho','$id')";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $this->db->lastInsertId();
    }
    
     public function buscaArquivos($id, $tipo) {
        $sql = "SELECT * FROM arquivo_$tipo WHERE id_$tipo = '$id'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

}
