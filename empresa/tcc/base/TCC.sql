-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 07-Nov-2014 às 17:10
-- Versão do servidor: 5.5.40-0ubuntu0.14.04.1
-- versão do PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `u455146490_tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ABA`
--

CREATE TABLE IF NOT EXISTS `ABA` (
  `ABA_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `MOD_CODIGO` bigint(20) NOT NULL,
  `PAG_CODIGO` bigint(20) NOT NULL,
  `MEN_CODIGO` bigint(20) NOT NULL,
  `ABA_NOME` varchar(20) NOT NULL,
  `ABA_ORDEM` smallint(6) NOT NULL,
  `ABA_ATIVO` char(1) NOT NULL DEFAULT 'S',
  `ABA_ATRIBUTO` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ABA_CODIGO`,`MOD_CODIGO`),
  KEY `MODULO_ABA_FK` (`MOD_CODIGO`) USING BTREE,
  KEY `ABA_ATIVO` (`ABA_ATIVO`) USING BTREE,
  KEY `PAGINA_ABA_FK` (`PAG_CODIGO`) USING BTREE,
  KEY `MENU_PAGINA_ABA_FK` (`MEN_CODIGO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- Extraindo dados da tabela `ABA`
--

INSERT INTO `ABA` (`ABA_CODIGO`, `MOD_CODIGO`, `PAG_CODIGO`, `MEN_CODIGO`, `ABA_NOME`, `ABA_ORDEM`, `ABA_ATIVO`, `ABA_ATRIBUTO`) VALUES
(1, 1, 8, 4, 'Aba', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(2, 1, 31, 4, 'Nova', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(3, 1, 34, 4, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(4, 2, 10, 4, 'Aba AÃ§Ã£o', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(5, 2, 35, 4, 'Nova', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(6, 2, 36, 4, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(7, 3, 4, 2, 'FuncionÃ¡rio', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(8, 3, 18, 2, 'Novo', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(9, 3, 19, 2, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(10, 4, 12, 4, 'MÃ³dulo', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(11, 4, 26, 4, 'Novo', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(12, 4, 27, 4, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(13, 5, 2, 1, 'PeÃ§a', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(14, 5, 15, 1, 'Nova', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(15, 5, 17, 1, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(16, 6, 1, 1, 'Produto', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(17, 6, 13, 1, 'Novo', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(18, 6, 14, 1, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(19, 7, 37, 5, 'Suporte', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(20, 7, 38, 5, 'Novo', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(21, 7, 39, 5, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(22, 8, 6, 3, 'Tarefa', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(23, 8, 23, 3, 'Nova', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(24, 8, 25, 3, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(25, 9, 5, 2, 'UsuÃ¡rio', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(26, 9, 20, 2, 'Novo', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(27, 9, 22, 2, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(28, 10, 11, 4, 'AÃ§Ã£o', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(29, 10, 28, 4, 'Nova', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(30, 10, 30, 4, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(32, 11, 40, 2, 'Categoria', 1, 'N', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(33, 11, 41, 2, 'Nova', 2, 'N', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(34, 11, 42, 2, 'Lixeira', 3, 'N', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(38, 12, 43, 2, 'Empresa', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(40, 12, 45, 2, 'Novo', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(41, 12, 44, 2, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(42, 13, 46, 6, 'Pedido', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(43, 13, 48, 6, 'Novo', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(45, 13, 47, 6, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(46, 14, 49, 2, 'Unidade', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(47, 14, 51, 2, 'Nova', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(48, 14, 50, 2, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(49, 15, 52, 2, 'Cidade', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(50, 15, 54, 2, 'Nova', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(52, 15, 53, 2, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(53, 17, 55, 4, 'Submenu', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(55, 17, 57, 4, 'Novo', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(56, 17, 56, 4, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(57, 18, 58, 4, 'PÃ¡gina', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(61, 18, 60, 4, 'Nova', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(64, 18, 59, 4, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(65, 16, 61, 4, 'Menu', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(67, 16, 63, 4, 'Novo', 2, 'S', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(68, 16, 62, 4, 'Lixeira', 3, 'S', 'title=''Clique aqui para ir a lixeira'' class='' glyphicon glyphicon-trash'' style=''color: black'''),
(70, 6, 67, 1, 'RelatÃ³rio', 4, 'N', 'title=''Clique aqui para ir ao Relatorio'' class='' glyphicon glyphicon-list-alt'' style=''color: red'''),
(71, 8, 72, 3, 'RelatÃ³rio', 4, 'N', 'title=''Clique aqui para ir ao Relatorio'' class='' glyphicon glyphicon-list-alt'' style=''color: red'''),
(72, 12, 73, 2, 'RelatÃ³rio', 4, 'N', 'title=''Clique aqui para ir ao Relatorio'' class='' glyphicon glyphicon-list-alt'' style=''color: red'''),
(73, 3, 74, 2, 'RelatÃ³rio', 4, 'N', 'title=''Clique aqui para ir ao Relatorio'' class='' glyphicon glyphicon-list-alt'' style=''color: red'''),
(75, 5, 76, 1, 'RelatÃ³rio', 4, 'N', 'title=''Clique aqui para ir ao Relatorio'' class='' glyphicon glyphicon-list-alt'' style=''color: red'''),
(77, 13, 77, 6, 'RelatÃ³rio', 4, 'N', 'title=''Clique aqui para ir ao Relatorio'' class='' glyphicon glyphicon-list-alt'' style=''color: red'''),
(78, 19, 78, 2, 'HistÃ³rico', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(79, 20, 79, 2, 'SituaÃ§Ã£o', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(80, 20, 80, 2, 'Nova', 2, 'N', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green'''),
(81, 21, 81, 2, 'Perfil', 1, 'S', 'title=''Clique aqui para listar'' class=''glyphicon glyphicon-list'' style=''color: blue'''),
(82, 21, 82, 2, 'Novo', 2, 'N', 'title=''Clique aqui para adicionar'' class='' glyphicon glyphicon-plus'' style=''color: green''');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ABCABAACAO`
--

CREATE TABLE IF NOT EXISTS `ABCABAACAO` (
  `ABC_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `ABA_CODIGO` bigint(20) NOT NULL,
  `MOD_CODIGO` bigint(20) NOT NULL,
  `ACA_CODIGO` bigint(20) NOT NULL,
  `ABC_NOME` varchar(20) NOT NULL,
  `PER_CODIGO` bigint(20) NOT NULL,
  `ABC_ATIVO` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`ABC_CODIGO`,`ABA_CODIGO`,`MOD_CODIGO`,`ACA_CODIGO`),
  KEY `ABC_ATIVO` (`ABC_ATIVO`) USING BTREE,
  KEY `ABA_ABCABAACAO_FK` (`ABA_CODIGO`) USING BTREE,
  KEY `MODULO_ABCABAACAO_FK` (`MOD_CODIGO`) USING BTREE,
  KEY `ACAO_ABCABAACAO_FK` (`ACA_CODIGO`) USING BTREE,
  KEY `PERFIL_ABCABAACAO_FK` (`PER_CODIGO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;

--
-- Extraindo dados da tabela `ABCABAACAO`
--

INSERT INTO `ABCABAACAO` (`ABC_CODIGO`, `ABA_CODIGO`, `MOD_CODIGO`, `ACA_CODIGO`, `ABC_NOME`, `PER_CODIGO`, `ABC_ATIVO`) VALUES
(1, 1, 1, 1, 'novo', 2, 'S'),
(2, 1, 1, 2, 'listar', 2, 'S'),
(3, 1, 1, 4, 'listar', 3, 'S'),
(4, 2, 1, 3, 'listar', 2, 'S'),
(5, 3, 1, 5, 'lixeira', 2, 'S'),
(6, 4, 2, 1, 'novo', 2, 'S'),
(7, 4, 2, 2, 'listar', 2, 'S'),
(8, 4, 2, 4, 'listar', 3, 'S'),
(9, 5, 2, 3, 'listar', 2, 'S'),
(10, 6, 2, 5, 'lixeira', 2, 'S'),
(11, 7, 3, 1, 'novo', 2, 'S'),
(12, 7, 3, 2, 'listar', 2, 'S'),
(13, 7, 3, 4, 'listar', 3, 'S'),
(14, 8, 3, 3, 'listar', 2, 'S'),
(15, 9, 3, 5, 'lixeira', 3, 'S'),
(16, 10, 4, 1, 'novo', 2, 'S'),
(17, 10, 4, 2, 'listar', 2, 'S'),
(18, 10, 4, 4, 'listar', 3, 'S'),
(19, 11, 4, 3, 'listar', 2, 'S'),
(20, 12, 4, 5, 'lixeira', 2, 'S'),
(21, 13, 5, 1, 'novo', 2, 'S'),
(22, 13, 5, 2, 'listar', 2, 'S'),
(23, 13, 5, 4, 'listar', 3, 'S'),
(24, 14, 5, 3, 'listar', 2, 'S'),
(25, 15, 5, 5, 'lixeira', 2, 'S'),
(26, 16, 6, 1, 'novo', 2, 'S'),
(27, 16, 6, 2, 'listar', 2, 'S'),
(28, 16, 6, 4, 'listar', 3, 'S'),
(29, 17, 6, 3, 'listar', 2, 'S'),
(30, 18, 6, 5, 'lixeira', 2, 'S'),
(31, 19, 7, 1, 'novo', 2, 'S'),
(32, 19, 7, 2, 'listar', 2, 'S'),
(33, 19, 7, 4, 'listar', 3, 'S'),
(34, 20, 7, 3, 'listar', 2, 'S'),
(35, 21, 7, 5, 'lixeira', 2, 'S'),
(36, 22, 8, 1, 'novo', 2, 'S'),
(37, 22, 8, 2, 'listar', 2, 'S'),
(38, 22, 8, 4, 'listar', 3, 'S'),
(39, 23, 8, 3, 'listar', 2, 'S'),
(40, 24, 8, 5, 'lixeira', 2, 'S'),
(41, 25, 9, 1, 'novo', 3, 'S'),
(42, 25, 9, 2, 'listar', 2, 'S'),
(42, 25, 9, 4, 'listar', 3, 'S'),
(43, 26, 9, 3, 'listar', 2, 'S'),
(44, 27, 9, 5, 'lixeira', 2, 'S'),
(45, 28, 10, 1, 'novo', 2, 'S'),
(46, 28, 10, 2, 'listar', 2, 'S'),
(47, 28, 10, 4, 'listar', 3, 'S'),
(48, 29, 10, 3, 'listar', 2, 'S'),
(49, 30, 10, 5, 'lixeira', 2, 'S'),
(50, 32, 11, 1, 'novo', 2, 'S'),
(51, 32, 11, 2, 'listar', 2, 'S'),
(52, 32, 11, 4, 'listar', 3, 'S'),
(53, 33, 11, 3, 'listar', 2, 'S'),
(54, 34, 11, 5, 'lixeira', 2, 'S'),
(55, 38, 12, 1, 'novo', 2, 'S'),
(56, 38, 12, 2, 'listar', 2, 'S'),
(57, 38, 12, 4, 'listar', 3, 'S'),
(58, 40, 12, 3, 'listar', 2, 'S'),
(59, 41, 12, 5, 'lixeira', 2, 'S'),
(60, 42, 13, 1, 'novo', 2, 'S'),
(61, 42, 13, 2, 'listar', 2, 'S'),
(62, 42, 13, 4, 'listar', 3, 'S'),
(63, 43, 13, 3, 'listar', 2, 'S'),
(64, 45, 13, 5, 'lixeira', 2, 'S'),
(65, 46, 14, 1, 'novo', 2, 'S'),
(66, 46, 14, 2, 'listar', 2, 'S'),
(67, 46, 14, 4, 'listar', 3, 'S'),
(68, 47, 14, 3, 'listar', 2, 'S'),
(69, 48, 14, 5, 'lixeira', 2, 'S'),
(70, 49, 15, 1, 'novo', 2, 'S'),
(71, 49, 15, 2, 'listar', 2, 'S'),
(72, 49, 15, 4, 'listar', 3, 'S'),
(73, 50, 15, 3, 'listar', 2, 'S'),
(74, 52, 15, 5, 'lixeira', 2, 'S'),
(75, 53, 17, 1, 'novo', 2, 'S'),
(76, 53, 17, 2, 'listar', 2, 'S'),
(77, 53, 17, 4, 'listar', 3, 'S'),
(78, 55, 17, 3, 'listar', 2, 'S'),
(79, 56, 17, 5, 'lixeira', 2, 'S'),
(80, 57, 18, 1, 'novo', 2, 'S'),
(81, 57, 18, 2, 'listar', 2, 'S'),
(82, 57, 18, 4, 'listar', 3, 'S'),
(83, 61, 18, 3, 'novo', 2, 'S'),
(84, 64, 18, 5, 'lixeira', 2, 'S'),
(85, 65, 16, 1, 'novo', 2, 'S'),
(86, 65, 16, 2, 'listar', 2, 'S'),
(87, 65, 16, 4, 'listar', 3, 'S'),
(88, 67, 16, 3, 'listar', 2, 'S'),
(90, 68, 16, 5, 'lixeira', 2, 'S'),
(91, 72, 12, 4, 'relatorio', 3, 'S'),
(92, 70, 6, 4, 'relatorio', 3, 'S'),
(93, 71, 8, 4, 'relatorio', 3, 'S'),
(94, 77, 13, 4, 'relatorio', 3, 'S'),
(95, 73, 3, 4, 'relatorio', 3, 'S'),
(96, 75, 5, 4, 'relatorio', 3, 'S'),
(97, 42, 13, 6, 'imprimir', 2, 'S'),
(98, 78, 19, 4, 'listar', 3, 'S'),
(99, 79, 20, 1, 'novo', 2, 'S'),
(100, 79, 20, 4, 'listar', 3, 'S'),
(101, 81, 21, 4, 'listar', 3, 'S'),
(102, 81, 21, 1, 'novo', 2, 'S'),
(105, 42, 13, 7, 'trocar', 2, 'S'),
(106, 22, 8, 8, 'listar', 3, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ACAO`
--

CREATE TABLE IF NOT EXISTS `ACAO` (
  `ACA_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `ACA_NOME` varchar(20) NOT NULL,
  `ACA_OK` varchar(20) NOT NULL,
  `ACA_DESCRICAO` varchar(20) NOT NULL,
  `ACA_ATRIBUTO` varchar(500) DEFAULT NULL,
  `ACA_ACTION` varchar(50) DEFAULT NULL,
  `ACA_ATIVO` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`ACA_CODIGO`),
  KEY `ACA_ATIVO` (`ACA_ATIVO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `ACAO`
--

INSERT INTO `ACAO` (`ACA_CODIGO`, `ACA_NOME`, `ACA_OK`, `ACA_DESCRICAO`, `ACA_ATRIBUTO`, `ACA_ACTION`, `ACA_ATIVO`) VALUES
(1, 'alterar', 'alterado', 'Alterar', 'title=''Clique aqui para alterar ''class=''glyphicon glyphicon-pencil'' style=''color: orange''', NULL, 'S'),
(2, 'excluir', 'excluido', 'Excluir', 'title=''Clique aqui para excluir ''class=''glyphicon glyphicon-remove'' style=''color: red''', NULL, 'S'),
(3, 'incluir', 'incluido', 'Incluir', '', NULL, 'S'),
(4, 'listar', 'listado', 'Listar', '', NULL, 'S'),
(5, 'restaurar', 'restaurado', 'Restaurar', 'title=''Clique aqui para restaurar ''class=''glyphicon glyphicon-share-alt'' style=''color: silver''', NULL, 'S'),
(6, 'imprimir', 'impresso', 'Imprimir', 'title=''Clique aqui para imprimir'' class=''glyphicon glyphicon-print'' style=''color: silver''', NULL, 'S'),
(7, 'trocar', 'trocada', 'Trocar Sit.', 'title=''Trocar Situação'' class=''glyphicon glyphicon-refresh'' style=''color: blue''', '#', 'S'),
(8, 'detalhar_tarefa', 'detalhada', 'Detalhar', 'title=''Detalhar Tarefa'' class=''glyphicon glyphicon-list''', NULL, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `CIDADE`
--

CREATE TABLE IF NOT EXISTS `CIDADE` (
  `CID_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `EST_CODIGO` bigint(20) NOT NULL,
  `CID_NOME` varchar(100) NOT NULL,
  `CID_ATIVO` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`CID_CODIGO`),
  KEY `ESTADO_CIDADE_FK` (`EST_CODIGO`) USING BTREE,
  KEY `CID_ATIVO` (`CID_ATIVO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `CIDADE`
--

INSERT INTO `CIDADE` (`CID_CODIGO`, `EST_CODIGO`, `CID_NOME`, `CID_ATIVO`) VALUES
(1, 24, 'Rio do Sul', 'S'),
(2, 24, 'Alfredo Wagner', 'S'),
(3, 23, 'Santa Maria', 'S'),
(4, 24, 'Lontras', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `EMPRESA`
--

CREATE TABLE IF NOT EXISTS `EMPRESA` (
  `EMP_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `EMP_NOME` varchar(200) DEFAULT NULL,
  `CID_CODIGO` bigint(20) NOT NULL,
  `EMP_CPFCNPJ` varchar(20) DEFAULT NULL,
  `EMP_RGIE` varchar(20) DEFAULT NULL,
  `EMP_ENDERECO` varchar(100) DEFAULT NULL,
  `EMP_BAIRRO` varchar(100) DEFAULT NULL,
  `EMP_EMAIL` varchar(100) DEFAULT NULL,
  `EMP_TELEFONE` varchar(100) DEFAULT NULL,
  `EMP_OBSERVACAO` varchar(1000) DEFAULT NULL,
  `EMP_ATIVO` char(1) DEFAULT 'S',
  PRIMARY KEY (`EMP_CODIGO`),
  UNIQUE KEY `EMP_CPFCNPJ` (`EMP_CPFCNPJ`) USING BTREE,
  KEY `EMP_ATIVO` (`EMP_ATIVO`) USING BTREE,
  KEY `CIDADE_EMPRESA_FK` (`CID_CODIGO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `EMPRESA`
--

INSERT INTO `EMPRESA` (`EMP_CODIGO`, `EMP_NOME`, `CID_CODIGO`, `EMP_CPFCNPJ`, `EMP_RGIE`, `EMP_ENDERECO`, `EMP_BAIRRO`, `EMP_EMAIL`, `EMP_TELEFONE`, `EMP_OBSERVACAO`, `EMP_ATIVO`) VALUES
(1, 'Luiz OtÃ¡vio Dorigon', 1, '08318799984', '1233214', 'Rua BulcÃ£o Viana - 250', 'Jardim AmÃ©rica', 'luiztavio_aw@hotmail.com', '4891491615', 'teste', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `EMPRESA_PERFIL`
--

CREATE TABLE IF NOT EXISTS `EMPRESA_PERFIL` (
  `EMP_CODIGO` bigint(20) NOT NULL,
  `PER_CODIGO` bigint(20) NOT NULL,
  PRIMARY KEY (`EMP_CODIGO`,`PER_CODIGO`),
  KEY `PERFIL_EMPRESA_PERFIL_PFK` (`PER_CODIGO`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `EMPRESA_PERFIL`
--

INSERT INTO `EMPRESA_PERFIL` (`EMP_CODIGO`, `PER_CODIGO`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ESTADO`
--

CREATE TABLE IF NOT EXISTS `ESTADO` (
  `EST_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `EST_UF` char(2) NOT NULL,
  `EST_ATIVO` char(1) NOT NULL DEFAULT 'S',
  `EST_NOME` varchar(50) NOT NULL,
  PRIMARY KEY (`EST_CODIGO`),
  KEY `EST_ATIVO` (`EST_ATIVO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `ESTADO`
--

INSERT INTO `ESTADO` (`EST_CODIGO`, `EST_UF`, `EST_ATIVO`, `EST_NOME`) VALUES
(1, 'AC', 'S', 'Acre'),
(2, 'AL', 'S', 'Alagoas'),
(3, 'AM', 'S', 'Amazonas'),
(4, 'AP', 'S', 'AmapÃ¡'),
(5, 'BA', 'S', 'Bahia'),
(6, 'CE', 'S', 'CearÃ¡'),
(7, 'DF', 'S', 'Distrito Federal'),
(8, 'ES', 'S', 'EspÃ­rito Santo'),
(9, 'GO', 'S', 'GoiÃ¡s'),
(10, 'MA', 'S', 'MaranhÃ£o'),
(11, 'MG', 'S', 'Minas Gerais'),
(12, 'MS', 'S', 'Mato Grosso do Sul'),
(13, 'MT', 'S', 'Mato Grosso'),
(14, 'PA', 'S', 'ParÃ¡'),
(15, 'PB', 'S', 'ParaÃ­ba'),
(16, 'PE', 'S', 'Pernambuco'),
(17, 'PI', 'S', 'PiauÃ­'),
(18, 'PR', 'S', 'ParanÃ¡'),
(19, 'RJ', 'S', 'Rio de Janeiro'),
(20, 'RN', 'S', 'Rio Grande do Norte'),
(21, 'RO', 'S', 'RondÃ´nia'),
(22, 'RR', 'S', 'Roraima'),
(23, 'RS', 'S', 'Rio Grande do Sul'),
(24, 'SC', 'S', 'Santa Catarina'),
(25, 'SE', 'S', 'Sergipe'),
(26, 'SP', 'S', 'SÃ£o Paulo'),
(27, 'TO', 'S', 'Tocantins');

-- --------------------------------------------------------

--
-- Estrutura da tabela `MENU`
--

CREATE TABLE IF NOT EXISTS `MENU` (
  `MEN_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `MEN_NOME` varchar(50) NOT NULL,
  `MEN_ORDEM` smallint(6) NOT NULL,
  `MEN_ATIVO` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`MEN_CODIGO`),
  KEY `MEN_ATIVO` (`MEN_ATIVO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `MENU`
--

INSERT INTO `MENU` (`MEN_CODIGO`, `MEN_NOME`, `MEN_ORDEM`, `MEN_ATIVO`) VALUES
(1, 'Cadastros', 2, 'S'),
(2, 'Globais', 1, 'S'),
(3, 'Tarefa', 3, 'S'),
(4, 'ManutenÃ§Ã£o', 5, 'N'),
(5, 'Suporte', 0, 'N'),
(6, 'Pedido', 4, 'N'),
(8, 'NULL', 0, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `MODULO`
--

CREATE TABLE IF NOT EXISTS `MODULO` (
  `MOD_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `MOD_NOME` varchar(20) NOT NULL,
  `MOD_DESCRICAO` varchar(20) NOT NULL,
  `MOD_GENERO` char(1) NOT NULL,
  `MOD_ATIVO` char(1) NOT NULL DEFAULT 'S',
  `MOD_APELIDO` char(3) NOT NULL,
  PRIMARY KEY (`MOD_CODIGO`),
  UNIQUE KEY `MOD_APELIDO` (`MOD_APELIDO`) USING BTREE,
  KEY `MOD_ATIVO` (`MOD_ATIVO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `MODULO`
--

INSERT INTO `MODULO` (`MOD_CODIGO`, `MOD_NOME`, `MOD_DESCRICAO`, `MOD_GENERO`, `MOD_ATIVO`, `MOD_APELIDO`) VALUES
(1, 'aba', 'Aba', 'F', 'S', 'ABA'),
(2, 'abcabaacao', 'Aba AÃ§Ã£o', 'F', 'S', 'ABC'),
(3, 'funcionario', 'FuncionÃ¡rio', 'M', 'N', 'FUN'),
(4, 'modulo', 'MÃ³dulo', 'M', 'S', 'MOD'),
(5, 'peca', 'PeÃ§a', 'F', 'S', 'PEC'),
(6, 'produto', 'Produto', 'M', 'S', 'PRO'),
(7, 'suporte', 'Suporte', 'M', 'S', 'SUP'),
(8, 'tarefa', 'Tarefa', 'F', 'S', 'TAR'),
(9, 'usuario', 'UsuÃ¡rio', 'M', 'S', 'USU'),
(10, 'acao', 'AÃ§Ã£o', 'F', 'S', 'ACA'),
(11, 'categoria', 'Categoria', 'F', 'N', 'CAT'),
(12, 'empresa', 'Empresa', 'F', 'S', 'EMP'),
(13, 'pedido', 'Pedido', 'M', 'S', 'PED'),
(14, 'unidade', 'Unidade', 'F', 'S', 'UNI'),
(15, 'cidade', 'Cidade', 'F', 'S', 'CID'),
(16, 'menu', 'Menu', 'M', 'S', 'MEN'),
(17, 'submenu', 'Submenu', 'M', 'S', 'SUB'),
(18, 'pagina', 'PÃ¡gina', 'F', 'S', 'PAG'),
(19, 'historico', 'HistÃ³rico', 'M', 'S', 'HIS'),
(20, 'situacao', 'SituaÃ§Ã£o', 'F', 'S', 'SIT'),
(21, 'perfil', 'Perfil', 'M', 'S', 'PER'),
(22, 'estado', 'Estado', 'M', 'S', 'EST');

-- --------------------------------------------------------

--
-- Estrutura da tabela `PAGINA`
--

CREATE TABLE IF NOT EXISTS `PAGINA` (
  `PAG_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `MEN_CODIGO` bigint(20) NOT NULL,
  `SUB_CODIGO` bigint(20) NOT NULL,
  `PER_CODIGO` bigint(20) NOT NULL,
  `PAG_NOME` varchar(50) NOT NULL,
  `PAG_DESCRICAO` varchar(50) NOT NULL,
  `PAG_ORDEM` smallint(6) NOT NULL DEFAULT '0',
  `PAG_ATIVO` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`PAG_CODIGO`,`MEN_CODIGO`),
  KEY `MENU_PAGINA_PFK` (`MEN_CODIGO`) USING BTREE,
  KEY `PERFIL_PAGINA_FK` (`PER_CODIGO`) USING BTREE,
  KEY `PAG_ATIVO` (`PAG_ATIVO`) USING BTREE,
  KEY `SUBMENU_PAGINA_FK` (`SUB_CODIGO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- Extraindo dados da tabela `PAGINA`
--

INSERT INTO `PAGINA` (`PAG_CODIGO`, `MEN_CODIGO`, `SUB_CODIGO`, `PER_CODIGO`, `PAG_NOME`, `PAG_DESCRICAO`, `PAG_ORDEM`, `PAG_ATIVO`) VALUES
(1, 1, 1, 3, 'produto_listar', 'Produtos', 1, 'S'),
(2, 1, 2, 3, 'peca_listar', 'PeÃ§as', 0, 'S'),
(4, 2, 19, 3, 'funcionario_listar', 'FuncionÃ¡rios', 0, 'S'),
(5, 2, 4, 3, 'usuario_listar', 'UsÃ¡rios', 1, 'S'),
(6, 3, 19, 3, 'tarefa_listar', 'Tarefas', 1, 'S'),
(8, 4, 7, 3, 'aba_listar', 'Abas', 0, 'S'),
(10, 4, 8, 3, 'abcabaacao_listar', 'Aba AÃ§Ãµes', 0, 'S'),
(11, 4, 9, 3, 'acao_listar', 'AÃ§Ãµes', 0, 'S'),
(12, 4, 10, 3, 'modulo_listar', 'MÃ³dulos', 0, 'S'),
(13, 1, 19, 2, 'produto_novo', 'Produto', 0, 'S'),
(14, 1, 19, 3, 'produto_lixeira', 'Lixeira de Produto', 0, 'S'),
(15, 1, 19, 2, 'peca_novo', 'PeÃ§a', 0, 'S'),
(17, 1, 19, 3, 'peca_lixeira', 'Lixeira da PeÃ§a', 0, 'S'),
(18, 2, 19, 2, 'funcionario_novo', 'FuncionÃ¡rio', 0, 'S'),
(19, 2, 19, 3, 'funcionario_lixeira', 'Lixeira de FuncionÃ¡rio', 0, 'S'),
(20, 2, 19, 2, 'usuario_novo', 'UsuÃ¡rio', 0, 'S'),
(22, 2, 19, 3, 'usuario_lixeira', 'Lixeira de UsÃ¡rio', 0, 'S'),
(23, 3, 19, 2, 'tarefa_novo', 'Tarefa', 0, 'S'),
(25, 3, 19, 3, 'tarefa_lixeira', 'Lixeira de Tarefa', 0, 'S'),
(26, 4, 19, 2, 'modulo_novo', 'MÃ³dulo', 0, 'S'),
(27, 4, 19, 3, 'modulo_lixeira', 'Lixeira de MÃ³dulo', 0, 'S'),
(28, 4, 19, 2, 'acao_novo', 'Acao', 0, 'S'),
(30, 4, 19, 3, 'acao_lixeira', 'Lixeira de AÃ§Ãµes', 0, 'S'),
(31, 4, 19, 2, 'aba_novo', 'Aba', 0, 'S'),
(34, 4, 19, 3, 'aba_lixeira', 'Lixeira de Abas', 0, 'S'),
(35, 4, 19, 2, 'abcabaacao_novo', 'Aba AÃ§Ã£o', 0, 'S'),
(36, 4, 19, 3, 'abcabaacao_lixeira', 'Lixeira de Aba AÃ§Ã£o', 0, 'S'),
(37, 5, 19, 3, 'suporte_listar', 'Suportes', 0, 'S'),
(38, 5, 19, 2, 'suporte_novo', 'Suporte', 0, 'S'),
(39, 5, 19, 3, 'suporte_lixeira', 'Lixeira de Suporte', 0, 'S'),
(40, 2, 11, 3, 'categoria_listar', 'Categorias', 0, 'N'),
(41, 2, 19, 2, 'categoria_novo', 'Categoria', 0, 'N'),
(42, 2, 19, 3, 'categoria_lixeira', 'Lixeira de Categoria', 0, 'N'),
(43, 2, 12, 3, 'empresa_listar', 'Empresas', 0, 'N'),
(44, 2, 19, 3, 'empresa_lixeira', 'Lixeira de Empresas', 0, 'N'),
(45, 2, 19, 2, 'empresa_novo', 'Empresa', 0, 'N'),
(46, 6, 19, 3, 'pedido_listar', 'Pedido', 1, 'S'),
(47, 6, 19, 3, 'pedido_lixeira', 'Lixeira de Pedido', 0, 'S'),
(48, 6, 19, 2, 'pedido_novo', 'Pedido', 0, 'S'),
(49, 2, 13, 3, 'unidade_listar', 'Unidades', 0, 'N'),
(50, 2, 19, 2, 'unidade_lixeira', 'Lixeira de Unidade', 0, 'N'),
(51, 2, 19, 2, 'unidade_novo', 'Unidade', 0, 'N'),
(52, 2, 14, 3, 'cidade_listar', 'Cidades', 0, 'S'),
(53, 2, 19, 3, 'cidade_lixeira', 'Lixeira de Cidade', 0, 'S'),
(54, 2, 19, 2, 'cidade_novo', 'Cidade', 0, 'S'),
(55, 4, 16, 3, 'submenu_listar', 'Submenus', 0, 'S'),
(56, 4, 19, 3, 'submenu_lixeira', 'Lixeira de Submenu', 0, 'S'),
(57, 4, 19, 2, 'submenu_novo', 'Submenu', 0, 'S'),
(58, 4, 17, 3, 'pagina_listar', 'PÃ¡ginas', 0, 'S'),
(59, 4, 19, 3, 'pagina_lixeira', 'Lixeira de PÃ¡gina', 0, 'S'),
(60, 4, 19, 2, 'pagina_novo', 'PÃ¡gina', 0, 'S'),
(61, 4, 15, 3, 'menu_listar', 'Menus', 1, 'S'),
(62, 4, 19, 3, 'menu_lixeira', 'Lixeira de Menu', 0, 'S'),
(63, 4, 19, 2, 'menu_novo', 'Menu', 0, 'S'),
(67, 1, 19, 3, 'produto_relatorio', 'RelatÃ³rios de Produto', 0, 'N'),
(72, 3, 19, 3, 'tarefa_relatorio', 'RelatÃ³rios de Tarefa', 0, 'N'),
(73, 2, 19, 3, 'empresa_relatorio', 'RelatÃ³rios de Empresas', 0, 'N'),
(74, 2, 19, 3, 'funcionario_relatorio', 'RelatÃ³rios de FuncionÃ¡rio', 0, 'S'),
(76, 1, 19, 3, 'peca_relatorio', 'RelatÃ³rios de PeÃ§a', 0, 'N'),
(77, 6, 19, 3, 'pedido_relatorio', 'RelatÃ³rios de Pedido', 0, 'S'),
(78, 2, 20, 3, 'historico_listar', 'HistÃ³rico', 0, 'S'),
(79, 2, 21, 3, 'situacao_listar', 'SituaÃ§Ãµes', 0, 'S'),
(80, 2, 19, 2, 'situacao_novo', 'SituaÃ§Ã£o', 0, 'S'),
(81, 2, 22, 3, 'perfil_listar', 'Perfis', 0, 'S'),
(82, 2, 19, 2, 'perfil_novo', 'Perfil', 0, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `PECA`
--

CREATE TABLE IF NOT EXISTS `PECA` (
  `PEC_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `PEC_NOME` varchar(50) NOT NULL,
  `PEC_VALOR` decimal(10,2) NOT NULL,
  `PEC_ATIVO` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`PEC_CODIGO`),
  KEY `PEC_ATIVO` (`PEC_ATIVO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `PECA`
--

INSERT INTO `PECA` (`PEC_CODIGO`, `PEC_NOME`, `PEC_VALOR`, `PEC_ATIVO`) VALUES
(1, 'PÃ© de Mesa ', 23.20, 'S'),
(2, 'Tampa de mesa ', 34.00, 'S'),
(3, 'Vidro para mesa', 100.00, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `PERFIL`
--

CREATE TABLE IF NOT EXISTS `PERFIL` (
  `PER_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `PER_NOME` varchar(50) NOT NULL,
  `PER_ATIVO` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`PER_CODIGO`),
  KEY `PER_ATIVO` (`PER_ATIVO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `PERFIL`
--

INSERT INTO `PERFIL` (`PER_CODIGO`, `PER_NOME`, `PER_ATIVO`) VALUES
(2, 'Administrador', 'S'),
(3, 'FuncionÃ¡rio', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `PRODUTO`
--

CREATE TABLE IF NOT EXISTS `PRODUTO` (
  `PRO_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `PRO_NOME` varchar(50) NOT NULL,
  `PRO_OBSERVACAO` varchar(1000) DEFAULT NULL,
  `PRO_ATIVO` char(1) NOT NULL DEFAULT 'S',
  `PRO_VALOR` decimal(10,2) DEFAULT NULL,
  `PRO_PERCENTUAL` decimal(10,2) DEFAULT NULL,
  `PRO_ARQUIVO` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PRO_CODIGO`),
  KEY `PRO_ATIVO` (`PRO_ATIVO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `PRODUTO`
--

INSERT INTO `PRODUTO` (`PRO_CODIGO`, `PRO_NOME`, `PRO_OBSERVACAO`, `PRO_ATIVO`, `PRO_VALOR`, `PRO_PERCENTUAL`, `PRO_ARQUIVO`) VALUES
(1, 'Mesa completa', NULL, 'S', 254.02, 12.00, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `PRODUTO_PECA`
--

CREATE TABLE IF NOT EXISTS `PRODUTO_PECA` (
  `PRO_CODIGO` bigint(20) NOT NULL,
  `PEC_CODIGO` bigint(20) NOT NULL,
  `PEC_QUANTIDADE` decimal(10,2) DEFAULT NULL,
  `PEC_VALORUNITARIO` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`PRO_CODIGO`,`PEC_CODIGO`),
  KEY `PECA_PRODUTO_PECA_PFK` (`PEC_CODIGO`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `PRODUTO_PECA`
--

INSERT INTO `PRODUTO_PECA` (`PRO_CODIGO`, `PEC_CODIGO`, `PEC_QUANTIDADE`, `PEC_VALORUNITARIO`) VALUES
(1, 1, 4.00, 23.20),
(1, 2, 1.00, 34.00),
(1, 3, 1.00, 100.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `SITUACAO`
--

CREATE TABLE IF NOT EXISTS `SITUACAO` (
  `SIT_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `MOD_CODIGO` bigint(20) NOT NULL,
  `SIT_NOME` varchar(50) NOT NULL,
  `SIT_ORDEM` bigint(20) NOT NULL,
  `SIT_ATIVO` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`SIT_CODIGO`),
  KEY `SIT_ATIVO` (`SIT_ATIVO`) USING BTREE,
  KEY `MOD_CODIGO` (`MOD_CODIGO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `SITUACAO`
--

INSERT INTO `SITUACAO` (`SIT_CODIGO`, `MOD_CODIGO`, `SIT_NOME`, `SIT_ORDEM`, `SIT_ATIVO`) VALUES
(1, 13, 'Criada', 1, 'S'),
(2, 13, 'Iniciada', 2, 'S'),
(3, 13, 'Pausada', 3, 'S'),
(4, 13, 'Concluida', 4, 'S'),
(5, 13, 'Cancelada', 5, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `SUBMENU`
--

CREATE TABLE IF NOT EXISTS `SUBMENU` (
  `SUB_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `MEN_CODIGO` bigint(20) NOT NULL,
  `SUB_NOME` varchar(50) DEFAULT NULL,
  `SUB_ORDEM` smallint(6) NOT NULL,
  `SUB_ATIVO` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`SUB_CODIGO`),
  KEY `SUB_ATIVO` (`SUB_ATIVO`) USING BTREE,
  KEY `MENU_SUBMENU_FK` (`MEN_CODIGO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `SUBMENU`
--

INSERT INTO `SUBMENU` (`SUB_CODIGO`, `MEN_CODIGO`, `SUB_NOME`, `SUB_ORDEM`, `SUB_ATIVO`) VALUES
(1, 1, 'Produto', 1, 'S'),
(2, 1, 'PeÃ§a', 2, 'S'),
(3, 2, 'FuncionÃ¡rio', 2, 'N'),
(4, 2, 'UsuÃ¡rio', 3, 'S'),
(7, 4, 'Aba', 4, 'S'),
(8, 4, 'Aba AÃ§Ã£o', 5, 'S'),
(9, 4, 'AÃ§Ã£o', 7, 'S'),
(10, 4, 'MÃ³dulo', 6, 'S'),
(11, 2, 'Categoria', 5, 'N'),
(12, 2, 'Empresa', 1, 'N'),
(13, 2, 'Unidade', 5, 'N'),
(14, 2, 'Cidade', 4, 'S'),
(15, 4, 'Menu', 1, 'S'),
(16, 4, 'Submenu', 2, 'S'),
(17, 4, 'PÃ¡gina', 3, 'S'),
(19, 8, 'NULL', 1, 'S'),
(20, 2, 'HistÃ³rico', 4, 'N'),
(21, 2, 'SituaÃ§Ã£o', 5, 'S'),
(22, 2, 'Perfil', 6, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `TAREFA`
--

CREATE TABLE IF NOT EXISTS `TAREFA` (
  `TAR_CODIGO` int(11) NOT NULL AUTO_INCREMENT,
  `TAR_NOME` varchar(100) NOT NULL,
  `TAR_DATAINICIO` date NOT NULL,
  `TAR_ATIVO` char(1) NOT NULL DEFAULT 'S',
  `TAR_DESCRICAO` varchar(1000) NOT NULL,
  PRIMARY KEY (`TAR_CODIGO`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `TAREFA`
--

INSERT INTO `TAREFA` (`TAR_CODIGO`, `TAR_NOME`, `TAR_DATAINICIO`, `TAR_ATIVO`, `TAR_DESCRICAO`) VALUES
(1, 'Tarefa 001', '2014-11-07', 'S', 'Tarefa 001 de teste'),
(2, 'Teste 002', '2014-11-05', 'S', 'Tarefa 002 para testar a data ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `TAREFA_PECA`
--

CREATE TABLE IF NOT EXISTS `TAREFA_PECA` (
  `TAR_CODIGO` int(11) NOT NULL,
  `PEC_CODIGO` bigint(20) NOT NULL,
  `PEC_QUANTIDADE` int(11) NOT NULL,
  PRIMARY KEY (`TAR_CODIGO`,`PEC_CODIGO`),
  KEY `PECA_TAREFA_PECA_FK` (`PEC_CODIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `TAREFA_PECA`
--

INSERT INTO `TAREFA_PECA` (`TAR_CODIGO`, `PEC_CODIGO`, `PEC_QUANTIDADE`) VALUES
(1, 1, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `TAREFA_PRODUTO`
--

CREATE TABLE IF NOT EXISTS `TAREFA_PRODUTO` (
  `TAR_CODIGO` int(11) NOT NULL,
  `PRO_CODIGO` bigint(20) NOT NULL,
  `PRO_QUANTIDADE` int(11) NOT NULL,
  PRIMARY KEY (`TAR_CODIGO`,`PRO_CODIGO`),
  KEY `PRODUTO_TAREFA_PRODUTO_FK` (`PRO_CODIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `TAREFA_PRODUTO`
--

INSERT INTO `TAREFA_PRODUTO` (`TAR_CODIGO`, `PRO_CODIGO`, `PRO_QUANTIDADE`) VALUES
(1, 1, 10),
(2, 1, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `TAREFA_SITUACAO`
--

CREATE TABLE IF NOT EXISTS `TAREFA_SITUACAO` (
  `STA_CODIGO` int(11) NOT NULL AUTO_INCREMENT,
  `TAR_CODIGO` int(11) NOT NULL,
  `SIT_CODIGO` bigint(20) NOT NULL DEFAULT '1',
  `USU_CODIGO` bigint(20) NOT NULL,
  `STA_DATA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `STA_OBSERVACAO` varchar(1000) NOT NULL,
  PRIMARY KEY (`STA_CODIGO`,`TAR_CODIGO`,`USU_CODIGO`),
  KEY `TAREFA_TAREFA_SITUACAO_PFK` (`TAR_CODIGO`),
  KEY `SITUACAO_TAREFA_SITUACAO_FK` (`SIT_CODIGO`),
  KEY `USUARIO_TAREFA_SITUACAO_FK` (`USU_CODIGO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `TAREFA_SITUACAO`
--

INSERT INTO `TAREFA_SITUACAO` (`STA_CODIGO`, `TAR_CODIGO`, `SIT_CODIGO`, `USU_CODIGO`, `STA_DATA`, `STA_OBSERVACAO`) VALUES
(28, 1, 1, 1, '2014-11-07 15:50:31', ''),
(29, 1, 2, 1, '2014-11-07 15:51:16', 'Tarefa iniciada '),
(30, 1, 3, 1, '2014-11-07 15:54:26', 'A tarefa foi pausada para cafÃ© '),
(31, 1, 2, 1, '2014-11-07 15:55:04', 'A tarefa foi iniciada depois do cafÃ© '),
(32, 2, 1, 1, '2014-11-07 16:01:15', ''),
(33, 1, 4, 1, '2014-11-07 16:52:02', 'Tarefa concluÃ­da');

-- --------------------------------------------------------

--
-- Estrutura da tabela `TAREFA_USUARIO`
--

CREATE TABLE IF NOT EXISTS `TAREFA_USUARIO` (
  `TAR_CODIGO` int(11) NOT NULL,
  `USU_CODIGO` bigint(20) NOT NULL,
  PRIMARY KEY (`TAR_CODIGO`,`USU_CODIGO`),
  KEY `USUARIO_TAREFA_USUARIO_FK` (`USU_CODIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `TAREFA_USUARIO`
--

INSERT INTO `TAREFA_USUARIO` (`TAR_CODIGO`, `USU_CODIGO`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `USUARIO`
--

CREATE TABLE IF NOT EXISTS `USUARIO` (
  `USU_CODIGO` bigint(20) NOT NULL AUTO_INCREMENT,
  `EMP_CODIGO` bigint(20) NOT NULL,
  `PER_CODIGO` bigint(20) NOT NULL,
  `USU_LOGIN` varchar(50) NOT NULL,
  `USU_NOME` varchar(100) NOT NULL,
  `USU_SENHA` varchar(20) NOT NULL,
  `USU_ATIVO` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`USU_CODIGO`),
  UNIQUE KEY `USU_LOGIN` (`USU_LOGIN`) USING BTREE,
  KEY `PERFIL_USUARIO_FK` (`PER_CODIGO`) USING BTREE,
  KEY `EMPRESA_USUARIO_FK` (`EMP_CODIGO`) USING BTREE,
  KEY `USU_ATIVO` (`USU_ATIVO`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `USUARIO`
--

INSERT INTO `USUARIO` (`USU_CODIGO`, `EMP_CODIGO`, `PER_CODIGO`, `USU_LOGIN`, `USU_NOME`, `USU_SENHA`, `USU_ATIVO`) VALUES
(1, 1, 2, 'luiz', 'Luiz OtÃ¡vio Dorigon', '123', 'S'),
(2, 1, 3, 'pitoco', 'Pitoco', '123', 'S');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `ABA`
--
ALTER TABLE `ABA`
  ADD CONSTRAINT `MENU_PAGINA_ABA_FK` FOREIGN KEY (`MEN_CODIGO`) REFERENCES `PAGINA` (`MEN_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MODULO_ABA_PFK` FOREIGN KEY (`MOD_CODIGO`) REFERENCES `MODULO` (`MOD_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `PAGINA_ABA_FK` FOREIGN KEY (`PAG_CODIGO`) REFERENCES `PAGINA` (`PAG_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ABCABAACAO`
--
ALTER TABLE `ABCABAACAO`
  ADD CONSTRAINT `ABA_ABA_ACAO_PFK` FOREIGN KEY (`ABA_CODIGO`) REFERENCES `ABA` (`ABA_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ACAO_ABA_ACAO_PFK` FOREIGN KEY (`ACA_CODIGO`) REFERENCES `ACAO` (`ACA_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MODULO_ABA_ACAO_PFK` FOREIGN KEY (`MOD_CODIGO`) REFERENCES `ABA` (`MOD_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `PERFIL_ABCABAACAO_PER_CODIGO_FK` FOREIGN KEY (`PER_CODIGO`) REFERENCES `PERFIL` (`PER_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `CIDADE`
--
ALTER TABLE `CIDADE`
  ADD CONSTRAINT `ESTADO_CIDADE_FK` FOREIGN KEY (`EST_CODIGO`) REFERENCES `ESTADO` (`EST_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `EMPRESA`
--
ALTER TABLE `EMPRESA`
  ADD CONSTRAINT `CIDADE_CLIENTE_CID_CODIGO_FK` FOREIGN KEY (`CID_CODIGO`) REFERENCES `CIDADE` (`CID_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `EMPRESA_PERFIL`
--
ALTER TABLE `EMPRESA_PERFIL`
  ADD CONSTRAINT `EMPRESA_EMPRESA_PERFIL_PFK` FOREIGN KEY (`EMP_CODIGO`) REFERENCES `EMPRESA` (`EMP_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `PERFIL_EMPRESA_PERFIL_PFK` FOREIGN KEY (`PER_CODIGO`) REFERENCES `PERFIL` (`PER_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `PAGINA`
--
ALTER TABLE `PAGINA`
  ADD CONSTRAINT `MENU_PAGINA_PFK` FOREIGN KEY (`MEN_CODIGO`) REFERENCES `MENU` (`MEN_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `PERFIL_PAGINA_FK` FOREIGN KEY (`PER_CODIGO`) REFERENCES `PERFIL` (`PER_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `SUBMENU_PAGINA_FK` FOREIGN KEY (`SUB_CODIGO`) REFERENCES `SUBMENU` (`SUB_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `PRODUTO_PECA`
--
ALTER TABLE `PRODUTO_PECA`
  ADD CONSTRAINT `PECA_PRODUTO_PECA_PEC_CODIGO_PFK` FOREIGN KEY (`PEC_CODIGO`) REFERENCES `PECA` (`PEC_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `PRODUTO_PRODUTO_PECA_PRO_CODIGO_PFK` FOREIGN KEY (`PRO_CODIGO`) REFERENCES `PRODUTO` (`PRO_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `SITUACAO`
--
ALTER TABLE `SITUACAO`
  ADD CONSTRAINT `MODULO_SITUACAO_FK` FOREIGN KEY (`MOD_CODIGO`) REFERENCES `MODULO` (`MOD_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `SUBMENU`
--
ALTER TABLE `SUBMENU`
  ADD CONSTRAINT `SUBMENU_PAGINA_MEN_CODIGO_FK` FOREIGN KEY (`MEN_CODIGO`) REFERENCES `MENU` (`MEN_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `TAREFA_PECA`
--
ALTER TABLE `TAREFA_PECA`
  ADD CONSTRAINT `PECA_TAREFA_PECA_FK` FOREIGN KEY (`PEC_CODIGO`) REFERENCES `PECA` (`PEC_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `TAREFA_TAR_PECA_FK` FOREIGN KEY (`TAR_CODIGO`) REFERENCES `TAREFA` (`TAR_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `TAREFA_PRODUTO`
--
ALTER TABLE `TAREFA_PRODUTO`
  ADD CONSTRAINT `PRODUTO_TAREFA_PRODUTO_FK` FOREIGN KEY (`PRO_CODIGO`) REFERENCES `PRODUTO` (`PRO_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `TAREFA_TAREFA_PRODUTO_FK` FOREIGN KEY (`TAR_CODIGO`) REFERENCES `TAREFA` (`TAR_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `TAREFA_SITUACAO`
--
ALTER TABLE `TAREFA_SITUACAO`
  ADD CONSTRAINT `SITUACAO_TAREFA_SITUACAO_FK` FOREIGN KEY (`SIT_CODIGO`) REFERENCES `SITUACAO` (`SIT_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `TAREFA_TAREFA_SITUACAO_PFK` FOREIGN KEY (`TAR_CODIGO`) REFERENCES `TAREFA` (`TAR_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `USUARIO_TAREFA_SITUACAO_FK` FOREIGN KEY (`USU_CODIGO`) REFERENCES `USUARIO` (`USU_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `TAREFA_USUARIO`
--
ALTER TABLE `TAREFA_USUARIO`
  ADD CONSTRAINT `TAREFA_TAREFA_USUARIO_FK` FOREIGN KEY (`TAR_CODIGO`) REFERENCES `TAREFA` (`TAR_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `USUARIO_TAREFA_USUARIO_FK` FOREIGN KEY (`USU_CODIGO`) REFERENCES `USUARIO` (`USU_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD CONSTRAINT `EMPRESA_USUARIO_FK` FOREIGN KEY (`EMP_CODIGO`) REFERENCES `EMPRESA` (`EMP_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `PERFIL_USUARIO_FK` FOREIGN KEY (`PER_CODIGO`) REFERENCES `PERFIL` (`PER_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
