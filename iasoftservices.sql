-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07-Jun-2017 às 02:01
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iasoftservices`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `cli_id_cliente` int(11) UNSIGNED NOT NULL,
  `cli_tx_nome_cliente` varchar(30) NOT NULL,
  `cli_tx_endereco` varchar(100) NOT NULL,
  `cli_tx_telefone` varchar(20) NOT NULL,
  `cli_in_desativado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_funcionario`
--

CREATE TABLE `tb_funcionario` (
  `func_id_funcionario` int(11) UNSIGNED NOT NULL,
  `func_tx_nome_funcionario` varchar(60) NOT NULL,
  `func_cd_username` varchar(16) NOT NULL,
  `func_cd_senha` varchar(255) NOT NULL,
  `func_in_desativado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_funcionario`
--

INSERT INTO `tb_funcionario` (`func_id_funcionario`, `func_tx_nome_funcionario`, `func_cd_username`, `func_cd_senha`, `func_in_desativado`) VALUES
(1, 'Thiago Martins de Melo', 'thiagom', 'a326d0fb7d52efc4962fa694c229b6e7', '0'),
(2, 'Karla BrandÃ£o', 'karla', 'a326d0fb7d52efc4962fa694c229b6e7', '0'),
(3, 'Ricardo Barbi', 'ricardo', '81dc9bdb52d04dc20036dbd8313ed055', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_ordem_servico`
--

CREATE TABLE `tb_ordem_servico` (
  `os_id_ordem_servico` int(11) UNSIGNED NOT NULL,
  `os_id_funcionario` int(11) UNSIGNED NOT NULL,
  `os_id_cliente` int(11) UNSIGNED NOT NULL,
  `os_dt_abertura` date NOT NULL,
  `os_dt_fechamento` date NOT NULL,
  `os_vl_servico` decimal(10,2) NOT NULL,
  `os_cd_status` char(1) NOT NULL,
  `os_in_desativado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`cli_id_cliente`);

--
-- Indexes for table `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  ADD PRIMARY KEY (`func_id_funcionario`);

--
-- Indexes for table `tb_ordem_servico`
--
ALTER TABLE `tb_ordem_servico`
  ADD PRIMARY KEY (`os_id_ordem_servico`),
  ADD KEY `FK_tb_ordem_servico_tb_funcionario` (`os_id_funcionario`),
  ADD KEY `FK_tb_ordem_servico_tb_cliente` (`os_id_cliente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `cli_id_cliente` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  MODIFY `func_id_funcionario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_ordem_servico`
--
ALTER TABLE `tb_ordem_servico`
  MODIFY `os_id_ordem_servico` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_ordem_servico`
--
ALTER TABLE `tb_ordem_servico`
  ADD CONSTRAINT `FK_tb_ordem_servico_tb_cliente` FOREIGN KEY (`os_id_cliente`) REFERENCES `tb_cliente` (`cli_id_cliente`),
  ADD CONSTRAINT `FK_tb_ordem_servico_tb_funcionario` FOREIGN KEY (`os_id_funcionario`) REFERENCES `tb_funcionario` (`func_id_funcionario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
