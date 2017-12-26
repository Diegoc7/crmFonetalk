<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Teste
 *
 * @author Diego
 */
class Teste extends model{
    //put your code here
     public function teste() {
        $data = date("Y-m-d H:i:s");
        $sql = "INSERT INTO teste VALUES('','1')";
       
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $this->db->lastInsertId();
    }
}
