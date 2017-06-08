<?php

require 'environment.php';

/*
** Constante BASE recebe o path da aplicação
*/

define("BASE", "http://localhost:60/iasoftservices/");

global $config;
$config = array();

/*
** Configuração da conexão de banco de dados,
** no ambiente de desenvolvimento ou produção
*/

if (ENVIRONMENT == 'development') {
	$config['dbname'] = 'iasoftservices';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	$config['dbname'] = 'iasoftservices';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}
?>