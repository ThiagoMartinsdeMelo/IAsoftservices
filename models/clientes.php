<?php


class Clientes extends model
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
	** Lista todos os clientes cadastrados e retorna um array.
	** Se a variável $id for maior que 0 (zero) a consulta SQL
	** fará a busca pelo usuário solicitado, que também será retornado
	** em um array.
	*/

	public function getCliente($id = 0)
	{
		$array = array();

		$sql = "SELECT * FROM tb_cliente WHERE cli_in_desativado = '0'";

		if( $id > 0) {
			$sql .= " AND cli_id_cliente = '$id'";
		} else {
			$sql .= " ORDER BY cli_id_cliente DESC";
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
	** Método retorna a lista de clientes ativos para
	** ser utilizado no select do cadastrato / atualização / busca
	** das ordens de serviço.
	*/

	public function getClienteSelect()
	{
		$array = array();

		$sql = "SELECT * FROM tb_cliente WHERE cli_in_desativado = '0' ORDER BY cli_tx_nome_cliente ASC";

		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;	
	}

	/*
	** Inserir cliente.
	** A flag retorno = 1 -> indica que a query foi executada com sucesso.
	** A flag retorno = 2 -> indica que a query não foi executada.	
	*/

	public function insertCliente($nome, $endereco, $telefone, $status)
	{
		$execute = $this->db->query("INSERT INTO tb_cliente SET cli_tx_nome_cliente = '$nome',
														 		cli_tx_endereco = '$endereco', 
														 		cli_tx_telefone = '$telefone',
														 		cli_in_desativado = '$status'
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
	** Editar cliente.
	** A flag retorno = 1 -> indica que a query foi executada com sucesso.
	** A flag retorno = 2 -> indica que a query não foi executada.
	*/

	public function updateCliente($id, $nome, $endereco, $telefone, $status)
	{

		$execute = $this->db->query("UPDATE tb_cliente SET cli_tx_nome_cliente = '$nome', 
														   cli_tx_endereco = '$endereco',
													       cli_tx_telefone = '$telefone',
													       cli_in_desativado = '$status'
													       WHERE cli_id_cliente = '$id'"
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
	** Excluir cliente.
	** A flag retorno = 1 -> indica que a query foi executada com sucesso.
	** A flag retorno = 2 -> indica que a query não foi executada.
	*/

	public function deleteCliente($id)
	{
		$execute = $this->db->query("DELETE FROM tb_cliente WHERE cli_id_cliente = '$id'");
		
		if (isset($execute) && !empty($execute)) {
			$retorno = 1;
			return $retorno;
		} else {
			$retorno = 2;
			return $retorno;			
		}
	}

	/*
	** Método para buscar cliente pelo nome.
	*/

	public function searchCliente($search)
	{
		$array = array();

		$sql = "SELECT * FROM tb_cliente WHERE cli_tx_nome_cliente  LIKE '%$search%'";

		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;	
	}

}