<?php

class Funcionarios extends model
{

	/*
	** Verifica se a sessão existe,
	** caso não exista reireciona para a página de login
	*/

	public function verificarLogin()
	{
		if (!isset($_SESSION['lgpainel']) || 
		   ( isset($_SESSION['lgpainel']) && empty($_SESSION['lgpainel']))
		   ) {
				header("Location: ".BASE."painel/login");
				exit;
			 }
	}

	/*
	** Verifica se o funcionário está cadastrado e se o perfil está ativo (valor 0),
	** se o campo func_in_desativado for igual a 1 o usuário estará desativado
	** e não conseguira fazer login.
	** Caso esteja cadastrado redireciona para o Dashboard,
	** se não informa mensagem de erro na página de login.
	*/	

	public function logar($username, $senha)
	{
		$retorno = '';

		$sql = "SELECT * FROM tb_funcionario WHERE func_cd_username = '$username' 
												  AND func_cd_senha = '$senha'
												  AND func_in_desativado = '0'";

		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$f = $sql->fetch();

			$_SESSION['lgpainel'] = $f['func_id_funcionario'];
			$_SESSION['nome'] = $f['func_tx_nome_funcionario'];
			$_SESSION['ativo'] = $f['func_in_desativado'];

			header("Location: ".BASE."painel");
		} else {
			$retorno = 'E-mail e/ou Senha não conferem.';
		}

		return $retorno;
	}


	/*
	** Lista todos os funcionários cadastrados e retorna um array.
	** Se a variável $id for maior que 0 (zero) a consulta SQL
	** fará a busca pelo usuário solicitado, que também será retornado
	** em um array.
	*/

	public function getFuncionario($id = 0)
	{
		$array = array();

		$sql = "SELECT * FROM tb_funcionario";

		if( $id > 0) {
			$sql .= " WHERE func_id_funcionario = '$id'";
		} else {
			$sql .= " ORDER BY func_id_funcionario DESC";
		}

		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {

			if ($id > 0) {
				$array = $sql->fetch();
			} else {
				$array = $sql->fetchAll();
			}
		}

		return $array;
	}

	/*
	** Método retorna a lista de funcionarios ativos para
	** ser utilizado no select da busca das ordens de serviço.
	*/

	public function getFuncionarioSelect()
	{
		$array = array();

		$sql = "SELECT * FROM tb_funcionario WHERE 	func_in_desativado = '0' ORDER BY func_tx_nome_funcionario ASC";

		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;	
	}


	/*
	** Inserir funcionário.
	** A flag retorno = 1 -> indica que a query foi executada com sucesso.
	** A flag retorno = 2 -> indica que a query não foi executada.
	*/

	public function insertFuncionario($nome, $username, $senha, $status)
	{
		$execute = $this->db->query("INSERT INTO tb_funcionario SET func_tx_nome_funcionario = '$nome',
														 			func_cd_username = '$username', 
														 			func_cd_senha = '$senha',
														 			func_in_desativado = '$status'
						");
		
		if (isset($execute) && !empty($execute)) {
			$retorno = 1;
			return $retorno;
		} else {
			$retorno = 2;
			return $retorno;			
		}

	}

	/*
	** Editar funcionário.
	** A flag retorno = 1 -> indica que a query foi executada com sucesso.
	** A flag retorno = 2 -> indica que a query não foi executada.
	*/

	public function updateFuncionario($id, $nome, $username, $senha, $status)
	{

		$execute = $this->db->query("UPDATE tb_funcionario SET func_tx_nome_funcionario = '$nome', 
															   func_cd_username = '$username',
													           func_cd_senha = '$senha',
													           func_in_desativado = '$status'
													           WHERE func_id_funcionario = '$id'"
									);

		if (isset($execute) && !empty($execute)) {
			$retorno = 1;
			return $retorno;
		} else {
			$retorno = 2;
			return $retorno;			
		}

	}

	/*
	** Excluir funcionário.
	** A flag retorno = 1 -> indica que a query foi executada com sucesso.
	** A flag retorno = 2 -> indica que a query não foi executada.
	*/

	public function deleteFuncionario($id)
	{
		$execute = $this->db->query("DELETE FROM tb_funcionario WHERE func_id_funcionario = '$id'");
		
		if (isset($execute) && !empty($execute)) {
			$retorno = 1;
			return $retorno;
		} else {
			$retorno = 2;
			return $retorno;			
		}
	}

	/*
	** Método para buscar funcionário pelo nome.
	*/

	public function searchFuncionario($search)
	{
		$array = array();

		$sql = "SELECT * FROM tb_funcionario WHERE func_tx_nome_funcionario  LIKE '%$search%'";

		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;		
	}	

}