<?php

class contatosController extends controller {

    public function index() {
        $this->validaSessao();
        $dados = array();
        $this->loadTemplate('contatos', $dados);
    }

    public function insere() {
        $contatos = new Contatos();
        $retorno = $contatos->adicionaUsuario($_POST);
        if ($retorno) {
            echo json_encode($retorno);
        } else {
            echo json_encode('erro');
        }
    }

    public function buscaTabela() {
        $contatos = new Contatos();
        $retorno = $contatos->buscaContatosTabela();
//        var_dump($retorno);
        echo json_encode($retorno);
    }

    public function contato($id) {
//        echo "OK$id";
//        echo realpath;
        $this->validaSessao();
        if (isset($id) && !empty($id) && $id > 0 && is_numeric($id)) {
            $dados = array(
                'id_contato' => $id
            );
            $this->loadTemplate('contato', $dados);
        }
    }

    public function contatoUnico($id) {
        if (isset($id) && !empty($id) && $id > 0 && is_numeric($id)) {
            $contatos = new Contatos();
            
            $retorno = $contatos->buscaContatoEspecifico($id);
            if ($retorno) {
//                var_dump($retorno);
                $passaArray = array();
                $cont = 0;
                foreach ($retorno as $value) {
                    $passaArray[$cont]['id'] = (int) $value['id'];
                    $data = $value['data'];
                    $mostrarData = date('d/m/Y H:i:s', strtotime($data));
                    $passaArray[$cont]['data'] = $mostrarData;

                    $data_nascimento = $value['data_nascimento'];
                    if ($data_nascimento != '0000-00-00 00:00:00') {
                        $data_nascimento = date('d/m/Y', strtotime($data_nascimento));
                        $passaArray[$cont]['data_nascimento'] = $data_nascimento;
                    } else {
                        $passaArray[$cont]['data_nascimento'] = '';
                    }
                    $passaArray[$cont]['nome'] = $value['nome'];
                    $passaArray[$cont]['email'] = $value['email'];
                    $passaArray[$cont]['cargo'] = $value['cargo'];
                    $passaArray[$cont]['tipo_tel1'] = $value['tipo_tel1'];
                    $passaArray[$cont]['id_user'] = $value['id_user'];
                    $passaArray[$cont]['telefone1'] = $value['telefone1'];
                    $passaArray[$cont]['id_empresa'] = $value['id_empresa'];
                    $passaArray[$cont]['tipo_tel2'] = $value['tipo_tel2'];
                    $passaArray[$cont]['telefone2'] = $value['telefone2'];
                    $passaArray[$cont]['tipo_tel3'] = $value['tipo_tel3'];
                    $passaArray[$cont]['telefone3'] = $value['telefone3'];
                    $passaArray[$cont]['origem'] = $value['origem'];
                    $passaArray[$cont]['cpf'] = $value['cpf'];
                    $passaArray[$cont]['endereco'] = $value['endereco'];
                    $passaArray[$cont]['observacao'] = $value['observacao'];
                    $passaArray[$cont]['empresa'] = $value['empresa'];
                    $passaArray[$cont]['user'] = $value['user'];
                    $passaArray[$cont]['contEdit'] = $contatos->countEdit($id)['c'];
//                    $passaArray[$cont]['nomeNegocios'] = $retornoNegocio;

                    $cont = $cont + 1;
                }
                echo json_encode($passaArray);
            } else {
                echo json_encode('erro');
            }
        }
    }

    public function edita() {
//        var_dump($_POST);
        shell_exec("echo '" . $_POST['id_contato'] . " << Chegou " . "' >> /var/log/log_developer/adm.log");
        $contatos = new Contatos();
        $retorno = $contatos->editaContato($_POST);
        if ($retorno) {
            echo json_encode('ok');
        } else {
            echo json_encode('erro');
        }
    }
    public function atividade(){
        echo 'ok';
        print_r($_POST);
    }
}
