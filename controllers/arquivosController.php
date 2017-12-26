<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of arquivosController
 *
 * @author Diego
 */
class arquivosController extends controller{
    //put your code here
    public function anexar(){
//        var_dump($_FILES);
//        var_dump($_POST);
        if(isset($_FILES) && isset($_POST['id']) && !empty($_FILES)){
            extract($_POST);
            $extensao = $this->validaExtensao($_FILES['arquivo']['name']);
            if($_FILES['arquivo']['size'] <= 4000000 && $extensao){
                $newName =  md5(time()).".".$extensao;
                $this->validaPasta($tipo, $id);
                $caminho = "arquivos/$tipo/$id/$newName";
                if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho)) {
                    $arquivos = new Arquivos();
                    $retorno = $arquivos->insereArquivoBD($_FILES['arquivo']['name'], $id, $caminho, $tipo);
                    echo json_encode('ok');
                }else{
                     echo json_encode(3);
                }
                
            } else {
                echo json_encode(2);
            }
        } else {
             echo json_encode(1);
        }
    }
    private function validaPasta($tipo, $id){
        if(!file_exists("arquivos/$tipo/$id")){
             mkdir("arquivos/$tipo/$id");
        }
    }
    
    private function validaExtensao($nome){
        $nome = strtolower($nome);
        $extensoes = array('csv', 'txt', 'pdf', 'doc','zip', 'taz');
        $tmp = explode('.', $nome);
        $extensao = end($tmp);
        if (array_search($extensao, $extensoes) === false) {
            return FALSE;
        }else{
            return $extensao;
        }
    }
    
    public function busca($id, $tipo){
        $arquivos = new Arquivos();
        $retorno = $arquivos->buscaArquivos($id, $tipo);
        if(empty($retorno)){
            echo json_encode('erro');
        } else {
            echo json_encode($retorno);
        }
        
    }
}
