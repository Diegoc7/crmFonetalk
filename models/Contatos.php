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
//            $empresa = addslashes($empresa);
            if (empty($empresa) || !isset($empresa)) {
                $empresa = '';
            } else {
                $empresa = addslashes($empresa);
            }
            if (empty($idBuscaEmpresa) || !isset($idBuscaEmpresa)) {
                $idBuscaEmpresa = '';
            } else {
                $idBuscaEmpresa = addslashes($idBuscaEmpresa);
            }
            $cargo = addslashes($cargo);
//            $tipoCell = addslashes($tipoCell);
            if (empty($tipoCell) || !isset($tipoCell)) {
                $tipoCell = '';
            } else {
                $tipoCell = addslashes($tipoCell);
            }
            if (empty($telefone) || !isset($telefone)) {
                $telefone = '';
            } else {
                $telefone = addslashes($telefone);
            }
//            $tipoCell2 = addslashes($tipoCell2);
            if (empty($tipoCell2) || !isset($tipoCell2)) {
                $tipoCell2 = '';
            } else {
                $tipoCell2 = addslashes($tipoCell2);
            }
            if (empty($telefone2) || !isset($telefone2)) {
                $telefone2 = '';
            } else {
                $telefone2 = addslashes($telefone2);
            }
//            $tipoCell3 = addslashes($tipoCell3);
            if (empty($tipoCell3) || !isset($tipoCell3)) {
                $tipoCell3 = '';
            } else {
                $tipoCell3 = addslashes($tipoCell3);
            }
            if (empty($telefone3) || !isset($telefone3)) {
                $telefone3 = '';
            } else {
                $telefone3 = addslashes($telefone3);
            }
            $email = addslashes($email);
//            $origem = addslashes($origem);
            if (empty($origem) || !isset($origem)) {
                $origem = '';
            } else {
                $origem = addslashes($origem);
            }
            $cpf = addslashes($cpf);
            $data = addslashes($data);
            $data = $this->formataHoraParaBanco($data);
            $endereco = addslashes($endereco);
            $observacao = addslashes($observacao);
            $id_user = addslashes($id_user);
            $dataInsercao = date("Y-m-d H:i:s");
            $sql = "INSERT INTO contatos VALUES('','$dataInsercao','$nome','$idBuscaEmpresa','$cargo','$tipoCell','$telefone','$tipoCell2','$telefone2','$tipoCell3','$telefone3','$email','$origem','$cpf','$data','$endereco','$observacao','$id_user')";
//            $sql = "INSERT INTO contatos VALUES('','$dataInsercao','$nome','$empresa','$cargo','$tipoCell','$telefone','$tipoCell2','$telefone2','$tipoCell3','$telefone3','$email','$origem','$cpf','$data','$endereco','$observacao','$id_user')";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function insereContatoArquivo($dataInsercao, $nome, $empresa, $cargo, $tipoCell, $telefone, $tipoCell2, $telefone2, $tipoCell3, $telefone3, $email, $origem, $cpf, $data, $endereco, $observacao, $id_user) {
//       $nome = utf8_encode($nome);
//       $email = utf8_encode($email);
        $sql = "INSERT INTO contatos VALUES('','$dataInsercao','$nome','$empresa','$cargo','$tipoCell','$telefone','$tipoCell2','$telefone2','$tipoCell3','$telefone3','$email','$origem','$cpf','$data','$endereco','$observacao','$id_user')";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $this->db->lastInsertId();
    }

    public function buscaContatosTabela() {
//     echo   $sql = "SELECT c.nome,c.telefone1,c.email,e.nome AS empresa FROM contatos AS c JOIN empresas AS e WHERE IF(c.id_empresa != 0) THEN c.id_empresa = e.id ELSE (c.id_empresa = 1)";
        $sql = "SELECT contatos.id, contatos.nome, contatos.telefone1, contatos.email, empresas.nome AS empresa FROM contatos LEFT JOIN empresas ON contatos.id_empresa = empresas.id";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function buscaContatoEspecifico($id) {
        $sql = "SELECT contatos.*, empresas.nome AS empresa, usuario.nome AS user FROM contatos LEFT JOIN empresas ON contatos.id_empresa = empresas.id JOIN usuario  WHERE contatos.id = '$id' AND usuario.id= contatos.id_user;";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function countEdit($id) {
        $sql = "SELECT COUNT(*) as c FROM historico_contatos WHERE id_contato = '$id'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetch();
    }

    public function editaContato($array) {
        if (is_array($array) && $array['id_contato'] > 0 && !empty($array['id_contato'])) {
            extract($array);
            $nomeEdit = addslashes($nomeEdit);
//            $empresa = addslashes($empresa);
            if (empty($empresaEdit) || !isset($empresaEdit)) {
                $empresaEdit = '';
            } else {
                $empresaEdit = addslashes($empresaEdit);
            }
            if (empty($idBuscaEmpresaEdit) || !isset($idBuscaEmpresaEdit)) {
                $idBuscaEmpresaEdit = '';
            } else {
                $idBuscaEmpresaEdit = addslashes($idBuscaEmpresaEdit);
            }
            $cargoEdit = addslashes($cargoEdit);
//            $tipoCell = addslashes($tipoCell);
            if (empty($tipoCellEdit) || !isset($tipoCellEdit)) {
                $tipoCellEdit = '';
            } else {
                $tipoCellEdit = addslashes($tipoCellEdit);
            }
            if (empty($telefoneEdit) || !isset($telefoneEdit)) {
                $telefoneEdit = '';
            } else {
                $telefoneEdit = addslashes($telefoneEdit);
            }
//            $tipoCell2 = addslashes($tipoCell2);
            if (empty($tipoCell2Edit) || !isset($tipoCell2Edit)) {
                $tipoCell2Edit = '';
            } else {
                $tipoCell2Edit = addslashes($tipoCell2Edit);
            }
            if (empty($telefone2Edit) || !isset($telefone2Edit)) {
                $telefone2Edit = '';
            } else {
                $telefone2Edit = addslashes($telefone2Edit);
            }
//            $tipoCell3 = addslashes($tipoCell3);
            if (empty($tipoCell3Edit) || !isset($tipoCell3Edit)) {
                $tipoCell3Edit = '';
            } else {
                $tipoCell3Edit = addslashes($tipoCell3Edit);
            }
            if (empty($telefone3Edit) || !isset($telefone3Edit)) {
                $telefone3Edit = '';
            } else {
                $telefone3Edit = addslashes($telefone3Edit);
            }
            $emailEdit = addslashes($emailEdit);
//            $origem = addslashes($origem);
            if (empty($origemEdit) || !isset($origemEdit)) {
                $origemEdit = '';
            } else {
                $origemEdit = addslashes($origemEdit);
            }
            $cpfEdit = addslashes($cpfEdit);
            $dataEdit = addslashes($dataEdit);
            if (!empty($dataEdit)) {
                $dataEdit = $this->formataHoraParaBanco($dataEdit);
            }
            $enderecoEdit = addslashes($enderecoEdit);
            $observacaoEdit = addslashes($observacaoEdit);
            $id_user_edit = addslashes($id_user_edit);
             $id_contato = addslashes($id_contato);
            $sql = "UPDATE contatos SET nome = '$nomeEdit', id_empresa = '$idBuscaEmpresaEdit', cargo = '$cargoEdit', tipo_tel1 = '$tipoCellEdit', telefone1 = '$telefoneEdit', tipo_tel2 = '$tipoCell2Edit', telefone2 = '$telefone2Edit', tipo_tel3 = '$tipoCell3Edit', telefone3 = '$telefone3Edit', email = '$emailEdit', origem = '$origemEdit', cpf = '$cpfEdit', data_nascimento = '$dataEdit', endereco = '$enderecoEdit', observacao = '$observacaoEdit'   WHERE id = '$id_contato'";
            shell_exec("echo '" . $id_user_edit . " << SQL id " . "' >> /var/log/log_developer/adm.log");
            shell_exec("echo '" . $sql . " << SQL Editando Contato " . "' >> /var/log/log_developer/adm.log");
            $sql = $this->db->prepare($sql);
            $sql->execute();

           
            $data = date("Y-m-d H:i:s");
            $sql = "INSERT INTO historico_contatos VALUES('','$id_user_edit','$id_contato','','$data')";
            $sql = $this->db->prepare($sql);
            $sql->execute();

            return TRUE;
        } else {
            return FALSE;
        }
    }
    
     public function buscaContato($busca) {
        $sql = "SELECT id,nome,cargo FROM  contatos WHERE nome LIKE '$busca%' LIMIT 50";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }
    
    public function ContUser($id_user){
         $sql = "SELECT COUNT(id) as c FROM contatos WHERE id_user = '$id_user'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $retorno = $sql->fetch();
//         var_dump($retorno);
         return $retorno['c'];
    }

}
