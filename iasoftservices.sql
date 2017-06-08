-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 09/06/2017 às 00:15
-- Versão do servidor: 10.1.16-MariaDB
-- Versão do PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `iasoftservices`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `cli_id_cliente` int(11) UNSIGNED NOT NULL,
  `cli_tx_nome_cliente` varchar(30) NOT NULL,
  `cli_tx_endereco` varchar(100) NOT NULL,
  `cli_tx_telefone` varchar(20) NOT NULL,
  `cli_in_desativado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`cli_id_cliente`, `cli_tx_nome_cliente`, `cli_tx_endereco`, `cli_tx_telefone`, `cli_in_desativado`) VALUES
(4, 'Jimi Hendrix', 'Rua das Flores, N.172', '(11) 2482-49184', '0'),
(6, 'Ian Anderson', 'Rua EmpresÃ¡rio JoÃ£o Rodrigues Alves', '(21) 3131-23123', '0'),
(7, 'Paul Di''anno', 'Rue Morgue, 45', '(23) 2532-52352', '0'),
(8, 'Nick Mason', 'Studio Miraval. Le Val, France', '(31) 3123-12123', '1'),
(10, 'Jimmy Page', 'England', '(12) 3213-12312', '0'),
(11, 'Robert Plant', 'England', '(31) 2312-3123', '0'),
(12, 'John Bonham', 'England', '(31) 3121-23123', '0'),
(13, 'Richard Wright', 'England', '(31) 3123-12123', '0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_funcionario`
--

CREATE TABLE `tb_funcionario` (
  `func_id_funcionario` int(11) UNSIGNED NOT NULL,
  `func_tx_nome_funcionario` varchar(60) NOT NULL,
  `func_cd_username` varchar(16) NOT NULL,
  `func_cd_senha` varchar(255) NOT NULL,
  `func_in_desativado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tb_funcionario`
--

INSERT INTO `tb_funcionario` (`func_id_funcionario`, `func_tx_nome_funcionario`, `func_cd_username`, `func_cd_senha`, `func_in_desativado`) VALUES
(1, 'Thiago Martins de Melo', 'thiagom', 'a326d0fb7d52efc4962fa694c229b6e7', '0'),
(7, 'Ricardo Barbi dos Santos', 'ricardo', 'aa1bf4646de67fd9086cf6c79007026c', '0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_ordem_servico`
--

CREATE TABLE `tb_ordem_servico` (
  `os_id_ordem_servico` int(11) UNSIGNED NOT NULL,
  `os_id_funcionario` int(11) UNSIGNED NOT NULL,
  `os_id_cliente` int(11) UNSIGNED NOT NULL,
  `os_dt_abertura` date NOT NULL,
  `os_dt_fechamento` date DEFAULT NULL,
  `os_vl_servico` decimal(10,2) NOT NULL,
  `os_cd_status` char(1) NOT NULL,
  `os_in_desativado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tb_ordem_servico`
--

INSERT INTO `tb_ordem_servico` (`os_id_ordem_servico`, `os_id_funcionario`, `os_id_cliente`, `os_dt_abertura`, `os_dt_fechamento`, `os_vl_servico`, `os_cd_status`, `os_in_desativado`) VALUES
(1, 1, 4, '2017-06-06', '2017-06-22', '152.00', '1', '1'),
(2, 1, 7, '2017-06-01', '2017-06-12', '140.00', '1', '0'),
(3, 1, 7, '2017-06-03', '2017-06-16', '130.00', '2', '0'),
(4, 7, 13, '2017-06-08', '2017-06-22', '132.00', '2', '0');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`cli_id_cliente`);

--
-- Índices de tabela `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  ADD PRIMARY KEY (`func_id_funcionario`);

--
-- Índices de tabela `tb_ordem_servico`
--
ALTER TABLE `tb_ordem_servico`
  ADD PRIMARY KEY (`os_id_ordem_servico`),
  ADD KEY `FK_tb_ordem_servico_tb_funcionario` (`os_id_funcionario`),
  ADD KEY `FK_tb_ordem_servico_tb_cliente` (`os_id_cliente`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `cli_id_cliente` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de tabela `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  MODIFY `func_id_funcionario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `tb_ordem_servico`
--
ALTER TABLE `tb_ordem_servico`
  MODIFY `os_id_ordem_servico` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tb_ordem_servico`
--
ALTER TABLE `tb_ordem_servico`
  ADD CONSTRAINT `FK_tb_ordem_servico_tb_cliente` FOREIGN KEY (`os_id_cliente`) REFERENCES `tb_cliente` (`cli_id_cliente`),
  ADD CONSTRAINT `FK_tb_ordem_servico_tb_funcionario` FOREIGN KEY (`os_id_funcionario`) REFERENCES `tb_funcionario` (`func_id_funcionario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
