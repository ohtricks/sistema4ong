-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 01-Dez-2017 às 14:56
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistema4ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nomefantasia` varchar(255) NOT NULL,
  `razaosocial` varchar(255) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL,
  `cep` char(8) NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nomefantasia`, `razaosocial`, `cnpj`, `cpf`, `telefone`, `celular`, `email`, `endereco`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `status`) VALUES
(1, 'Batataria do japones', 'Restaurante do japones', '9860001978', '', '1120614504', '11985001148', 'restaurantedojapones@gmail.com', 'rua Dr. Mario Vicente 188', 'Extra', 'Ipiranga', 'São Paulo', 'SP', '04270000', 1),
(3, 'Restaurate do seu Ze', 'restaurante e bar Seu Ze', '98776330001', '3522570833', '11982038673', '11 333399763', 'restaurantebarseuze@gmail.com', 'rua jose mario costa', '122', 'Av Paulista', 'São Paulo', 'SP', '04270000', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `perfilid` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`perfilid`, `descricao`, `status`) VALUES
(1, 'Administrador', 1),
(2, 'Diretor', 1),
(3, 'Gerente', 1),
(4, 'Supervisor', 1),
(5, 'Responsavel', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `descricaoproduto` varchar(100) NOT NULL,
  `unidade` int(11) NOT NULL,
  `valormercadoria` float NOT NULL,
  `valorvenda` float NOT NULL,
  `qtdestoque` int(11) NOT NULL,
  `descontopermitido` float NOT NULL,
  `alertaestoque` int(11) NOT NULL,
  `qtdvendaminima` int(11) NOT NULL,
  `qtdvalorminimo` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `descricaoproduto`, `unidade`, `valormercadoria`, `valorvenda`, `qtdestoque`, `descontopermitido`, `alertaestoque`, `qtdvendaminima`, `qtdvalorminimo`) VALUES
(1, 'TEste', 1, 111, 122, 12, 123, 111, 23, 44),
(2, 'Arroz', 3, 100, 233, 12, 122, 2, 23, 122),
(3, 'Arroz', 3, 100, 233, 12, 122, 2, 23, 122),
(4, 'Arroz', 3, 100, 233, 12, 122, 2, 23, 122),
(5, 'Arroz', 3, 100, 233, 12, 122, 2, 23, 122),
(6, 'Arroz', 3, 100, 233, 12, 122, 2, 23, 122);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `login` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `datacadastro` datetime NOT NULL,
  `dataultimoacesso` datetime NOT NULL,
  `perfilid` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `email`, `senha`, `datacadastro`, `dataultimoacesso`, `perfilid`, `status`) VALUES
(1, 'Rafael Miyazaki', 'rafael.miyazaki', 'rafaelmiyazaki10@gmail.com', '102030', '2017-10-16 16:00:02', '2017-11-12 17:00:00', 1, 1),
(2, 'Douglas Seiko ', 'douglas.seiko', 'douglasseiko@gmail.com', '102030', '2017-11-10 22:00:39', '2017-11-12 11:00:00', 1, 1),
(3, 'João Vitor Freitas', 'joao.freitas', 'jvfreitas02@gmail.com', '102030', '2017-11-04 19:00:09', '2017-11-12 13:00:00', 1, 1),
(6, 'Rafael Aparecido', 'rafael.aparecido', 'rafa36ap@gmail.com', '102030', '2017-11-12 17:00:02', '2017-11-12 17:30:00', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`perfilid`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `perfilid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
