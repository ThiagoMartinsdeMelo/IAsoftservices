<?php

include 'core/Controller.php';
include 'models/funcionarios.php';
include 'models/ordens.php';

class funcionariosController extends controller
{

    /*** Métodos para a view Funcionários
    /********************************/    

    /*
    ** Lista funcionários na home de funcionários
    */

    public function home()
    {
        $f = new Funcionarios();
        $f->verificarLogin();

        $dados = array();

        $dados['funcionarios'] = $f->getFuncionario();

        $this->loadTemplateInPainel('funcionarios/home', $dados);
    }

    /*
    ** Recebe os dados da view e verifica
    ** se foram enviados corretamente.
    ** Em seguida chama o model Funconários 
    ** para inserir no banco.
    */

    public function funcionarios_add()
    {
        $f = new Funcionarios();
        $f->verificarLogin();

        $dados = array();

        if ( isset($_POST['nome']) && !empty($_POST['nome']) &&
             isset($_POST['username']) && !empty($_POST['username']) &&
             isset($_POST['senha']) && !empty($_POST['senha'])
            ) {
                $nome = addslashes($_POST['nome']);
                $username = addslashes($_POST['username']);
                $senha = addslashes($_POST['senha']);
                
                /*
                ** Criptografa a senha com md5
                */
                
                $senha = md5($senha);
                $status = addslashes($_POST['status']);

                /*
                ** Variável $_SESSION armazena o status da inserção
                ** em seguinda recebe a mensagem de cadastro com sucesso
                ** e caso exista algum erro retorna mensagem.
                */

                $_SESSION['msg-func-cadastrado'] = $f->insertFuncionario($nome, $username, $senha, $status);

                if ($_SESSION['msg-func-cadastrado'] == 1) {
                    $_SESSION['msg-f'] = "Funcionário {$nome} cadastrado com sucesso.";
                } else {
                    $_SESSION['msg-f'] = "Funcionário {$nome} não foi cadastrado. Por favor, tente novamente.";
                }

                header("Location: ".BASE."funcionarios/home");
                exit;
            }

        $this->loadTemplateInPainel('funcionarios/funcionarios_add', $dados);
    }

    public function funcionarios_edit($id)
    {
        $f = new Funcionarios();
        $f->verificarLogin();

        $dados = array();

        if ( isset($_POST['nome']) && !empty($_POST['nome']) &&
             isset($_POST['username']) && !empty($_POST['username']) &&
             isset($_POST['senha']) && !empty($_POST['senha'])
           ) {
            
                $nome = addslashes($_POST['nome']);
                $username = addslashes($_POST['username']);
                $senha = addslashes($_POST['senha']);
                
                /*
                ** Criptografa a senha com md5
                */
                
                $senha = md5($senha);
                $status = addslashes($_POST['status']);

                /*
                ** Variável $_SESSION armazena o status da inserção
                ** em seguinda recebe a mensagem de cadastro com sucesso
                ** e caso exista algum erro retorna mensagem.
                */                
                
                $_SESSION['msg-func-atualizado'] = $f->updateFuncionario($id, $nome, $username, $senha, $status);

                if ($_SESSION['msg-func-atualizado'] == 1) {
                    $_SESSION['msg-f'] = "Funcionário {$nome} atualizado com sucesso.";
                } else {
                    $_SESSION['msg-f'] = "Funcionário {$nome} não foi atualizado. Por favor, tente novamente.";
                }                

                header("Location: ".BASE."funcionarios/home");
                exit;
        }

        $dados['funcionario'] = $f->getFuncionario($id);

        $this->loadTemplateInPainel('funcionarios/funcionarios_edit', $dados);
    }

    public function funcionario_del($id)
    {
        $f = new Funcionarios();
        $f->verificarLogin();

        $o = new Ordens();

        $dados = array();

        /*
        ** Pega dados do usuário.
        */

        $dados = $f->getFuncionario($id);

        $nome = $dados['func_tx_nome_funcionario'];

        $contOrdens = $o->checkOrdemFunc($id);

        if ($contOrdens == 2) {
            $_SESSION['msg-func-delete'] = $contOrdens;
            $_SESSION['msg-f'] = "Funcionário {$nome} não foi excluído, ele(a) possui ordens de serviço.";
            header("Location: ".BASE.'funcionarios/home');
        } else {
            $_SESSION['msg-func-delete'] = $f->deleteFuncionario($id);

            if ($_SESSION['msg-func-delete'] == 1) {
                $_SESSION['msg-f'] = "Funcionário {$nome}  excluído com sucesso.";
            } else {
                $_SESSION['msg-f'] = "Funcionário {$nome} não foi excluído. Por favor, tente novamente.";
            }     
            header("Location: ".BASE.'funcionarios/home');
        }
        
    }


    /*
    ** Método efetua a busca pelo cliente.
    */

    public function search()
    {
        $f = new Funcionarios();
        $f->verificarLogin();

        if (isset($_GET['nome']) && !empty($_GET['nome'])) {

            $search = addslashes($_GET['nome']);
            
            $dados = array();
            $dados['funcionarios'] = $f->searchFuncionario($search);
            
            $this->loadTemplateInPainel('funcionarios/home', $dados);

        }
        
    }    

}