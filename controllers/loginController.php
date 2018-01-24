<?php

class loginController extends controller {

    public function index() {
        $this->loadViewLogin();
    }

    public function verificar() {
//        var_dump($_POST);
        $usuario = filter_input(INPUT_POST, 'usuario');
        $senha = filter_input(INPUT_POST, 'senha');
        if (isset($usuario) && isset($senha) && !empty($usuario) && !empty($senha)) {
            $usuarios = new Usuarios();
            $retorno = $usuarios->verificaUsuario($usuario, $senha);
            if ($retorno) {
                session_start();
                $_SESSION['ID'] = $retorno['id'];
                $_SESSION['login'] = $retorno['login'];
                $_SESSION['nome'] = $retorno['nome'];
                if($retorno['tipo'] == 1){
                    $_SESSION['tipo'] = 'Administração';
                }else if($retorno['tipo'] == 2){
                     $_SESSION['tipo'] = 'Operador(a)';
                
                }else if($retorno['tipo'] == 3){
                     $_SESSION['tipo'] = 'Vendedor(a)';
                }
                
                echo json_encode('ok');
            } else {
                echo json_encode('erro');
            }
        } else {
            echo json_encode('vazio');
        }
    }

}
