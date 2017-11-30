<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contatos
 *
 * @author Diego
 */
class Contatos extends model {

    //put your code here
    public function adicionaUsuario($array) {
//        var_dump($array);
        if (isset($array['nome']) && !empty($array['nome']) && isset($array['id_user']) && !empty($array['id_user'])) {
            extract($array);
            $nome = addslashes($nome);
            $empresa = addslashes($empresa);
            $cargo = addslashes($cargo);
            $tipoCell = addslashes($tipoCell);
            if (empty($telefone) || !isset($telefone)) {
                $telefone = '';
            } else {
                $telefone = addslashes($telefone);
            }
            $tipoCell2 = addslashes($tipoCell2);
            if (empty($telefone2) || !isset($telefone2)) {
                $telefone2 = '';
            } else {
                $telefone2 = addslashes($telefone2);
            }
            $tipoCell3 = addslashes($tipoCell3);
            if (empty($telefone3) || !isset($telefone3)) {
                $telefone3 = '';
            } else {
                $telefone3 = addslashes($telefone3);
            }
            $email = addslashes($email);
            $origem = addslashes($origem);
            $cpf = addslashes($cpf);
            $data = addslashes($data);
            $endereco = addslashes($endereco);
            $observacao = addslashes($observacao);
            $id_user = addslashes($id_user);
            $dataInsercao = date("Y-m-d H:i:s");
            $sql = "INSERT INTO contatos VALUES('','$dataInsercao','$nome','$empresa','$cargo','$tipoCell','$telefone','$tipoCell2','$telefone2','$tipoCell3','$telefone3','$email','$origem','$cpf','$data','$endereco','$observacao','$id_user')";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function buscaContatosTabela() {
//     echo   $sql = "SELECT c.nome,c.telefone1,c.email,e.nome AS empresa FROM contatos AS c JOIN empresas AS e WHERE IF(c.id_empresa != 0) THEN c.id_empresa = e.id ELSE (c.id_empresa = 1)";
        $sql = "SELECT contatos.id, contatos.nome, contatos.telefone1, contatos.email, empresas.nome AS empresa FROM contatos LEFT JOIN empresas ON contatos.id_empresa = empresas.id";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

   

}
