<?php

include 'core/Controller.php';
include 'models/funcionarios.php';

class painelController extends controller
{

	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $f = new Funcionarios();
        $f->verificarLogin();

        $dados = array();
   
        $this->loadTemplateInPainel('painel/home', $dados);
    }

    /*
    ** Método que chama o login.
    */

    public function login()
    {
    	$dados = array(
    		'erro' => ''
    	);

    	if(isset($_POST['username']) && !empty($_POST['username'])) {
    		$username = addslashes($_POST['username']);
    		$senha = md5($_POST['senha']);

            /*
            ** Chama o método que irá preencher
            ** a variável de sessão com os dados do
            ** usuário
            */

    		$f = new Funcionarios();
    		$dados['erro'] = $f->logar($username, $senha);
    	}

    	$this->loadView("painel/login", $dados);
    }

    /*
    ** Método que desloga do sistema.
    */

    public function logout()
    {
    	unset($_SESSION['lgpainel']);
    	header("Location: ".BASE."painel/login");
		exit;
    }

}