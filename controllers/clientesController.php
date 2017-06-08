<?php

include 'core/Controller.php';
include 'models/clientes.php';
include 'models/ordens.php';


class clientesController extends controller
{

    /*** Métodos para a view Clientes
    /********************************/

    public function home()
    {
        $c = new Clientes();
        $c->verificarLogin();

        $dados = array();

        $dados['clientes'] = $c->getCliente();

        $this->loadTemplateInPainel('clientes/home', $dados);
    }


    /*
    ** Método para cadastro de clientes.
    */

    public function clientes_add()
    {
        
        $c = new Clientes();
        $c->verificarLogin();

        $dados = array();

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {

                $nome = addslashes($_POST['nome']);
                $endereco = addslashes($_POST['endereco']);
                $telefone = addslashes($_POST['telefone']);
                $status = addslashes($_POST['status']);

                /*
                ** Variável $_SESSION armazena o status da inserção
                ** em seguinda recebe a mensagem de cadastro com sucesso
                ** e caso exista algum erro retorna mensagem.
                */

                $_SESSION['msg-cliente-cadastrado'] = $c->insertCliente($nome, $endereco, $telefone, $status);

                if ($_SESSION['msg-cliente-cadastrado'] == 1) {
                    $_SESSION['msg-f'] = "Cliente {$nome} cadastrado com sucesso.";
                } else {
                    $_SESSION['msg-f'] = "Cliente {$nome} não foi cadastrado. Por favor, tente novamente.";
                }

                header("Location: ".BASE."clientes/home");
                exit;
            }

        $this->loadTemplateInPainel('clientes/clientes_add', $dados);
    }

    public function clientes_edit($id)
    {
        $c = new Clientes();
        $c->verificarLogin();

        $dados = array();

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            
                $nome = addslashes($_POST['nome']);
                $endereco = addslashes($_POST['endereco']);
                $telefone = addslashes($_POST['telefone']);
                $status = addslashes($_POST['status']);

                /*
                ** Variável $_SESSION armazena o status da inserção
                ** em seguinda recebe a mensagem de cadastro com sucesso
                ** e caso exista algum erro retorna mensagem.
                */                
                
                $_SESSION['msg-cliente-atualizado'] = $c->updateCliente($id, $nome, $endereco, $telefone, $status);

                if ($_SESSION['msg-cliente-atualizado'] == 1) {
                    $_SESSION['msg-f'] = "Cliente {$nome} atualizado com sucesso.";
                } else {
                    $_SESSION['msg-f'] = "Cliente {$nome} não foi atualizado. Por favor, tente novamente.";
                }                

                header("Location: ".BASE."clientes/home");
                exit;
        }

        $dados['cliente'] = $c->getCliente($id);

        $this->loadTemplateInPainel('clientes/clientes_edit', $dados);
    }

    public function cliente_del($id)
    {
        $c = new Clientes();
        $c->verificarLogin();

        $o = new Ordens();

        $dados = array();

        /*
        ** Pega dados do cliente.
        */

        $dados = $c->getCliente($id);

        $nome = $dados['cli_tx_nome_cliente'];

        $contOrdens = $o->checkOrdemCli($id);

        if ($contOrdens == 2) {
              $_SESSION['msg-cliente-delete'] = $contOrdens;
              $_SESSION['msg-f'] = "Cliente {$nome} não foi excluído, ele(a) possui ordens de serviço.";
              header("Location: ".BASE.'clientes/home');
        } else {
            $_SESSION['msg-cliente-delete'] = $c->deleteCliente($id);

            if ($_SESSION['msg-cliente-delete'] == 1) {
                $_SESSION['msg-f'] = "Cliente {$nome}  excluído com sucesso.";
            } else {
                $_SESSION['msg-f'] = "Cliente {$nome} não foi excluído. Por favor, tente novamente.";
            }            

            header("Location: ".BASE.'clientes/home');
        }
    }

    /*
    ** Método efetua a busca pelo cliente.
    */

    public function search()
    {
        $c = new Clientes();
        $c->verificarLogin();

        if (isset($_GET['nome']) && !empty($_GET['nome'])) {

            $search = addslashes($_GET['nome']);
            
            $dados = array();
            $dados['clientes'] = $c->searchCliente($search);
            
            $this->loadTemplateInPainel('clientes/home', $dados);

        }
        
    }

}