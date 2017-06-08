<?php

class Ordens extends model
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
	** Lista todos as ordens de serviço cadastradas e retorna um array.
	** Se a variável $id for maior que 0 (zero) a consulta SQL
	** fará a busca pelo usuário solicitado, que também será retornado
	** em um array.
	*/

	public function getOrdem($id = 0)
	{
		$array = array();

		$sql = "SELECT *, DATE_FORMAT(`os_dt_abertura` , '%d/%c/%Y' ) AS `data_abertura`, DATE_FORMAT( `os_dt_fechamento` , '%d/%c/%Y') AS `data_fechamento` FROM tb_ordem_servico";

		if( $id > 0) {
			$sql .= " WHERE os_id_ordem_servico = '$id'";
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

	public function getOrdemJoin()
	{
		$sql = "SELECT o.*, f.func_tx_nome_funcionario, c.cli_tx_nome_cliente,
							DATE_FORMAT(`os_dt_abertura` , '%d/%c/%Y' ) AS `data_abertura`, DATE_FORMAT( `os_dt_fechamento` , '%d/%c/%Y') AS `data_fechamento`
							FROM tb_ordem_servico AS o 
							LEFT JOIN tb_funcionario AS f ON o.os_id_funcionario = f.func_id_funcionario
							LEFT JOIN tb_cliente AS c ON o.os_id_cliente = c.cli_id_cliente";

		$sql = $this->db->query($sql);		


		if ($sql->rowCount() > 0) {

				$array = $sql->fetchAll();
		}

		return $array;		
	}

	/*
	** Inserir ordem serviço.
	** A flag retorno = 1 -> indica que a query foi executada com sucesso.
	** A flag retorno = 2 -> indica que a query não foi executada.
	*/

	public function insertOrdemServico($idfuncionario, $idcliente, $abertura, $fechamento, $valorservico, $status, $ativacao)
	{
		$execute = $this->db->query("INSERT INTO tb_ordem_servico SET 
														os_id_funcionario = '$idfuncionario',
														os_id_cliente = '$idcliente', 
														os_dt_abertura = '$abertura',
														os_dt_fechamento = '$fechamento',
														os_vl_servico = '$valorservico',
														os_cd_status = '$status',
														os_in_desativado = '$ativacao'
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
	** Editar ordem serviço.
	** A flag retorno = 1 -> indica que a query foi executada com sucesso.
	** A flag retorno = 2 -> indica que a query não foi executada.
	*/

	public function updateOrdemServico($id, $idfuncionario, $idcliente, $abertura, $fechamento, $valorservico, $status, $ativacao)
	{

		$execute = $this->db->query("UPDATE tb_ordem_servico SET 
															os_id_funcionario = '$idfuncionario', 
															os_id_cliente = '$idcliente',
													        os_dt_abertura = '$abertura',
													        os_dt_fechamento = '$fechamento',
															os_vl_servico = '$valorservico',
														    os_cd_status = '$status',
														    os_in_desativado = '$ativacao'
													        WHERE os_id_ordem_servico = '$id'"
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
	** Excluir ordem seriço.
	** A flag retorno = 1 -> indica que a query foi executada com sucesso.
	** A flag retorno = 2 -> indica que a query não foi executada.
	*/

	public function deleteOrdemServico($id)
	{
		$execute = $this->db->query("DELETE FROM tb_ordem_servico WHERE os_id_ordem_servico = '$id'");
		
		if (isset($execute) && !empty($execute)) {
			$retorno = 1;
			return $retorno;
		} else {
			$retorno = 2;
			return $retorno;			
		}
	}


	public function checkOrdemFunc($idfunc)
	{
		$execute = $this->db->query("SELECT os_id_funcionario FROM tb_ordem_servico WHERE os_id_funcionario = '$idfunc'");

		$retorno = 1;

		if ($execute->rowCount() > 0) {
			$retorno = 2;
		}

		return $retorno;
	}

	public function checkOrdemCli($idfunc)
	{
		$execute = $this->db->query("SELECT os_id_cliente FROM tb_ordem_servico WHERE os_id_cliente = '$idfunc'");

		$retorno = 1;
		
		if ($execute->rowCount() > 0) {
			$retorno = 2;
		}

		return $retorno;
	}

	public function searchOrdens($idfuncionario, $idcliente, $abertura, $fechamento, $status)
	{
        /*
        ** Pesquisa por funcionário
        ** e ordena por com ORDER BY
        */
        $query_order = " ORDER BY o.os_dt_abertura DESC";

        $query1 = '';
        if (isset($idfuncionario) && !empty($idfuncionario)) {
        	$query1 = "o.os_id_funcionario = '$idfuncionario'";
        }

        $query2 = '';
        if (isset($idfuncionario) && !empty($idfuncionario)) {

        	if (isset($idcliente) && !empty($idcliente)) {
        		$query2 = " AND o.os_id_cliente = '$idcliente'";
        	}

        } else if (isset($idcliente) && !empty($idcliente)) {

        	$query2 = "o.os_id_cliente = '$idcliente'";
        }

        /*
        ** Pesquisa entre intervalo de datas
        */
        $query3 = '';
		if (isset($idfuncionario) && !empty($idfuncionario) || isset($idcliente) && !empty($idcliente)) {

			if (isset($abertura) && !empty($abertura) && isset($fechamento) && !empty($fechamento)) {
				$query3 = " AND o.os_dt_abertura >= '$abertura' AND o.os_dt_fechamento <= '$fechamento'";
			} else if (isset($abertura) && !empty($abertura)) {
				$query3 = " AND o.os_dt_abertura >= '$abertura'";
			}

		} else if (isset($abertura) && !empty($abertura) && isset($fechamento) && !empty($fechamento)) {
			$query3 = "o.os_dt_abertura >= '$abertura' AND o.os_dt_fechamento <= '$fechamento'";
		} else if (isset($abertura) && !empty($abertura)) {
			$query3 = "o.os_dt_abertura >= '$abertura'";
		}
        
        /*
        ** Pesquisa pelo status.
        */
        $query4 = '';
		if (isset($idfuncionario) && !empty($idfuncionario) || isset($idcliente) && !empty($idcliente) || isset($abertura) && !empty($abertura)) {

			if(isset($status) && !empty($status)) {
				$query4 = "AND o.os_cd_status = '$status'";
			}

		} else if (isset($status) && !empty($status)) {
			$query4 = "o.os_cd_status = '$status'";
		}

		$array = array();

		$sql = "SELECT o.*, f.func_tx_nome_funcionario, c.cli_tx_nome_cliente,
							DATE_FORMAT(`os_dt_abertura` , '%d/%c/%Y' ) AS `data_abertura`, DATE_FORMAT( `os_dt_fechamento` , '%d/%c/%Y') AS `data_fechamento`
							FROM tb_ordem_servico AS o 
							JOIN tb_funcionario AS f ON o.os_id_funcionario = f.func_id_funcionario
							JOIN tb_cliente AS c ON o.os_id_cliente = c.cli_id_cliente
							WHERE {$query1} {$query2} {$query3} {$query4} {$query_order}";

		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;					
	}

}