<?php

include 'core/Controller.php';
include 'models/ordens.php';
include 'models/clientes.php';
include 'models/funcionarios.php';

class ordensController extends controller
{

    /*** Métodos para a view Ordens
    /********************************/

    public function home()
    {
        $o = new Ordens();
        $o->verificarLogin();

        $c = new Clientes();
        $lista_clientes = $c->getClienteSelect();

        $f = new Funcionarios();
        $lista_funcionarios = $f->getFuncionarioSelect();

        // Status da ordem de serviço.
        $lista_status = [
            '0' => 'Indiferente',
            '1' => 'Aberta',
            '2' => 'Fechada'
        ];

        $dados = array();

        $dados['ordens'] = $o->getOrdemJoin();
        $dados['status'] = $lista_status;
        $dados['clientes'] = $lista_clientes;
        $dados['funcionarios'] = $lista_funcionarios;

        $this->loadTemplateInPainel('ordens/home', $dados);
    }

    /*
    ** Método para cadastro de ordem de serviço.
    */

    public function ordem_servico_add()
    {
        
        $o = new Ordens();
        $o->verificarLogin();

        $c = new Clientes();

        $lista_clientes = $c->getClienteSelect();
        
        // Status da ordem de serviço.
        $lista_status = [
            '0' => 'Indiferente',
            '1' => 'Aberta',
            '2' => 'Fechada'
        ];

        $dados = array();

        /*
        ** Variável que será enviada a view para
        ** gerar o select de clientes.
        */

        $dados['clientes'] = $lista_clientes;
        $dados['status'] = $lista_status;

        if (isset($_POST['idcliente']) && !empty($_POST['idcliente']) &&
            isset($_POST['abertura']) && !empty($_POST['abertura']) && 
            isset($_POST['valorservico']) && !empty($_POST['valorservico'])            
            ) {

                /*
                ** Variável $idfuncionario é preenchida com o id do
                ** usuário logado na sessão.
                */

                $idfuncionario = $_SESSION['lgpainel'];
                $idcliente = addslashes($_POST['idcliente']);
                $abertura = addslashes($_POST['abertura']);
                $fechamento = addslashes($_POST['fechamento']);
                $valorservico = addslashes($_POST['valorservico']);
                $status = addslashes($_POST['status']);
                $ativacao = addslashes($_POST['ativacao']);


                /*
                ** Transformando a Data para o Formato do Mysql
                */

                $abertura = $this->convertData($abertura);

                if (isset($fechamento) && !empty($fechamento)) {
                    $fechamento = $this->convertData($fechamento);                    
                }


                /*
                ** Variável $_SESSION armazena o status da inserção
                ** em seguinda recebe a mensagem de cadastro com sucesso
                ** e caso exista algum erro retorna mensagem.
                */

                $_SESSION['msg-ordem-cadastrado'] = $o->insertOrdemServico($idfuncionario, $idcliente, $abertura, $fechamento, $valorservico, $status, $ativacao);

                if ($_SESSION['msg-ordem-cadastrado'] == 1) {
                    $_SESSION['msg-f'] = "Ordem de serviço cadastrado com sucesso.";
                } else {
                    $_SESSION['msg-f'] = "Ordem de serviço não foi cadastrado. Por favor, tente novamente.";
                }

                header("Location: ".BASE."ordens/home");
                exit;
            }

        $this->loadTemplateInPainel('ordens/ordem_servico_add', $dados);
    }

    /*
    ** Edita as informações de cadastro da ordem de serviço.
    */

    public function ordem_servico_edit($id)
    {

        $o = new Ordens();
        $o->verificarLogin();

        $c = new Clientes();

        $lista_clientes = $c->getClienteSelect();
        
        // Status da ordem de serviço.
        $lista_status = [
            '0' => 'Indiferente',
            '1' => 'Aberta',
            '2' => 'Fechada'
        ];

        $dados = array();

        /*
        ** Variável que será enviada a view para
        ** gerar o select de clientes.
        */

        $dados['clientes'] = $lista_clientes;
        $dados['status'] = $lista_status;        

        if (isset($_POST['idcliente']) && !empty($_POST['idcliente']) &&
            isset($_POST['abertura']) && !empty($_POST['abertura']) && 
            isset($_POST['valorservico']) && !empty($_POST['valorservico'])
            ) {
            
                /*
                ** Variável $idfuncionario é preenchida com o id do
                ** usuário logado na sessão.
                */

                $idfuncionario = $_SESSION['lgpainel'];
                $idcliente = addslashes($_POST['idcliente']);
                $abertura = addslashes($_POST['abertura']);
                $fechamento = addslashes($_POST['fechamento']);
                $valorservico = addslashes($_POST['valorservico']);
                $status = addslashes($_POST['status']);
                $ativacao = addslashes($_POST['ativacao']);


                /*
                ** Transformando a Data para o Formato do Mysql
                */

                $abertura = $this->convertData($abertura);

                if (isset($fechamento) && !empty($fechamento)) {
                    $fechamento = $this->convertData($fechamento);                    
                }                

                /*
                ** Variável $_SESSION armazena o status da atualização
                ** em seguinda recebe a mensagem de atualizado com sucesso
                ** e caso exista algum erro retorna mensagem.
                */                
                
                $_SESSION['msg-ordem-atualizado'] = $o->updateOrdemServico($id, $idfuncionario, $idcliente, $abertura, $fechamento, $valorservico, $status, $ativacao);

                if ($_SESSION['msg-ordem-atualizado'] == 1) {
                    $_SESSION['msg-f'] = "Ordem de serviço #{$id} atualizada com sucesso.";
                } else {
                    $_SESSION['msg-f'] = "Ordem de serviço #{$id} não foi atualizada. Por favor, tente novamente.";
                }                

                header("Location: ".BASE."ordens/home");
                exit;
        }

        $dados['ordem'] = $o->getOrdem($id);
        $this->loadTemplateInPainel('ordens/ordem_servico_edit', $dados);
    }

    public function os_id_ordem_servico($id)
    {
        $o = new Ordens();
        $o->verificarLogin();

        $dados = array();

        /*
        ** Pega dados do usuário.
        */

        $dados = $o->getOrdem($id);

        $id = $dados['os_id_ordem_servico'];
        
        $_SESSION['msg-ordem-delete'] = $f->deleteOrdemServico($id);

        if ($_SESSION['msg-ordem-delete'] == 1) {
            $_SESSION['msg-f'] = "Ordem de serviço {$id}  excluído com sucesso.";
        } else {
            $_SESSION['msg-f'] = "Ordem de serviço {$id} não foi excluído. Por favor, tente novamente.";
        }            

        header("Location: ".BASE.'ordens/home');
    }


    /*
    ** Método efetua a busca pelo cliente.
    */

    public function search()
    {
        $dados = array(); // recebe os dados que irão compor a view
        $o = new Ordens();
        $o->verificarLogin();

        $c = new Clientes();
        $lista_clientes = $c->getClienteSelect();

        $f = new Funcionarios();
        $lista_funcionarios = $f->getFuncionarioSelect();

        // Status da ordem de serviço.
        $lista_status = [
            '0' => 'Indiferente',
            '1' => 'Aberta',
            '2' => 'Fechada'
        ];        


        $dados['status'] = $lista_status;
        $dados['clientes'] = $lista_clientes;
        $dados['funcionarios'] = $lista_funcionarios;

        if (isset($_GET['idfuncionario']) && !empty($_GET['idfuncionario'])) {
            $idfuncionario = addslashes($_GET['idfuncionario']);
        } else {
            $idfuncionario = '';
        }

        if (isset($_GET['idcliente']) && !empty($_GET['idcliente'])) {
            $idcliente = addslashes($_GET['idcliente']);
        } else {
            $idcliente = '';
        }

        if (isset($_GET['abertura']) && !empty($_GET['abertura'])) {
            $abertura = addslashes($_GET['abertura']);
            $abertura = $this->convertData($abertura);
        } else {
            $abertura = '';
        }

        if (isset($_GET['fechamento']) && !empty($_GET['fechamento'])) {
            $fechamento = addslashes($_GET['fechamento']);
            $fechamento = $this->convertData($fechamento);
        } else {
            $fechamento = '';
        }        

        if (isset($_GET['status']) && !empty($_GET['status'])) {
            $status = addslashes($_GET['status']);
        } else {
            $status = '';
        }

        $dados['ordens'] = $o->searchOrdens($idfuncionario,
                                            $idcliente,
                                            $abertura,
                                            $fechamento,
                                            $status
                                           );

        $this->loadTemplateInPainel('ordens/home', $dados);
    }       

    /*
    ** Função que transforma a data do formado d/m/Y para
    ** o formato do mysql yyyy-mm-dd
    */

    private function convertData($data)
    {
        $data = $data;
        $data = explode('/', $data);     // transforma em array
        $data = array_reverse($data); // inverte posicoes do array
        $data = implode('-', $data);     // transforma em string novamente
        return $data;
    }

}