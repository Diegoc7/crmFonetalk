<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuarios extends model {

    public function verificaUsuario($usuario, $senha) {
        $usuario = addslashes($usuario);
        $senha = addslashes(md5($senha));
        $sql = "SELECT * FROM usuario WHERE login = '$usuario' AND senha = '$senha'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() == 1) {
            return $sql->fetch();
        } else {
            return FALSE;
        }
    }

    public function buscaUsuario($usuario = '') {
        $usuario = addslashes($usuario);
        $senha = addslashes(md5($senha));
        $sql = "SELECT * FROM usuario WHERE login = '$usuario' AND senha = '$senha'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() == 1) {
            return $sql->fetch();
        } else {
            return FALSE;
        }
    }

    public function adicionaUsuario($array) {
//        var_dump($array);
        if (isset($array['login']) && !empty($array['login'])) {
            extract($array);
//            $this->verificaLogin($login);
            $login = addslashes($login);
            if ($this->verificaLogin($login) && $senha == $repitaSenha) {
                $nome = addslashes($nome);
                $senha = md5(addslashes($senha));
                $email = addslashes($email);
                $tipo = addslashes($tipo);
                $data = date("Y-m-d H:i:s");
                $sql = "INSERT INTO usuario VALUES('','$data','$nome','$login','$senha','$email','$tipo')";
                $sql = $this->db->prepare($sql);
                $sql->execute();
                return $this->db->lastInsertId();
            } else {
                return FALSE;
            }
        }
    }

    private function verificaLogin($login) {
        $sql = "SELECT COUNT(id) as c FROM usuario WHERE login = '$login'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $retorno = $sql->fetch();
//         var_dump($retorno);
        if ($retorno['c'] == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function buscaUsuariosTabela() {
        $sql = "SELECT * FROM usuario";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

}
