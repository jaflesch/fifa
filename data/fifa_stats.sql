-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18-Set-2016 às 21:16
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fifa_stats`
--
CREATE DATABASE IF NOT EXISTS `fifa_stats` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fifa_stats`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `campeonato`
--

CREATE TABLE IF NOT EXISTS `campeonato` (
`id` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `nome` varchar(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `campeonato`
--

INSERT INTO `campeonato` (`id`, `ano`, `nome`) VALUES
(1, 2014, 'COPA'),
(2, 2014, 'LIGA'),
(3, 2015, 'SCES'),
(4, 2015, 'COPA'),
(5, 2015, 'LIGA'),
(6, 2015, 'UCL'),
(7, 2016, 'SCES'),
(8, 2016, 'SCEU');

-- --------------------------------------------------------

--
-- Estrutura da tabela `partida`
--

CREATE TABLE IF NOT EXISTS `partida` (
`id` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `time` varchar(40) NOT NULL,
  `campeonato` varchar(4) NOT NULL,
  `gol` int(11) NOT NULL,
  `assistencia` int(11) NOT NULL,
  `dentro_area` int(11) NOT NULL,
  `fora_area` int(11) NOT NULL,
  `falta` int(11) NOT NULL,
  `penalti` int(11) NOT NULL,
  `cabeca` int(11) NOT NULL,
  `perna_trocada` int(11) NOT NULL,
  `cobertura` int(11) NOT NULL,
  `voleio` int(11) NOT NULL,
  `cartao_amarelo` int(11) NOT NULL,
  `cartao_vermelho` int(11) NOT NULL,
  `lesao` int(11) NOT NULL,
  `resultado` varchar(5) NOT NULL,
  `partida` varchar(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `partida`
--

INSERT INTO `partida` (`id`, `ano`, `time`, `campeonato`, `gol`, `assistencia`, `dentro_area`, `fora_area`, `falta`, `penalti`, `cabeca`, `perna_trocada`, `cobertura`, `voleio`, `cartao_amarelo`, `cartao_vermelho`, `lesao`, `resultado`, `partida`) VALUES
(1, 2014, 'West Brom', 'A', 2, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '5-0', 'C'),
(2, 2014, 'Napoli', 'A', 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '3-2', 'F'),
(3, 2014, 'OGC Nice', 'A', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-1', 'C'),
(4, 2014, 'Atlético Madrid', 'SCES', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, '3-0', 'C'),
(5, 2014, 'Real Sociedad', 'LIGA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'F'),
(6, 2014, 'Académica', 'UCL', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '3-1', 'C'),
(7, 2014, 'Deportivo La Coruna', 'LIGA', 1, 3, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '6-0', 'F'),
(8, 2014, 'Elche', 'LIGA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'C'),
(9, 2014, 'Villarreal', 'LIGA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-0', 'F'),
(10, 2014, 'Vaduz', 'UCL', 3, 1, 3, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, '5-0', 'F'),
(11, 2014, 'Atlétic Bilbao', 'LIGA', 3, 3, 2, 1, 0, 0, 0, 2, 0, 0, 0, 0, 0, '6-3', 'C'),
(12, 2014, 'Levante', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'F'),
(13, 2014, 'Everton', 'UCL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0-1', 'C'),
(14, 2014, 'Barcelona', 'LIGA', 2, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-0', 'c'),
(15, 2014, 'Granada', 'LIGA', 1, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '3-0', 'F'),
(16, 2014, 'Académica', 'UCL', 2, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, '5-0', 'F'),
(17, 2014, 'Rayo Vallecano', 'LIGA', 3, 3, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '6-0', 'C'),
(18, 2014, 'Eibar', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-1', 'C'),
(19, 2014, 'Everton', 'UCL', 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '4-3', 'F'),
(20, 2014, 'Malaga', 'LIGA', 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2-3', 'F'),
(21, 2014, 'Almeria', 'COPA', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '4-0', 'F'),
(22, 2014, 'Vaduz', 'UCL', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-0', 'C'),
(23, 2014, 'Almeria', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-1', 'F'),
(24, 2014, 'Almeria', 'COPA', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '4-0', 'C'),
(25, 2014, 'Sevilla', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-1', 'C'),
(26, 2014, 'Celta', 'LIGA', 2, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '4-2', 'C'),
(27, 2014, 'Valencia', 'LIGA', 2, 1, 2, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '3-0', 'F'),
(28, 2014, 'Mirandés', 'COPA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2-3', 'F'),
(29, 2014, 'Villarreal', 'LIGA', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-0', 'C'),
(30, 2014, 'PSG', 'UCL', 2, 0, 2, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '2-2', 'C'),
(31, 2014, 'Levante', 'LIGA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0-1', 'C'),
(33, 2014, 'Atlétic Bilbao', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-1', 'F'),
(34, 2014, 'Barcelona', 'LIGA', 2, 0, 2, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '3-2', 'F'),
(35, 2014, 'Granada', 'LIGA', 3, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '6-0', 'C'),
(36, 2014, 'Rayo Vallecano', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-1', 'F'),
(37, 2014, 'Barcelona', 'COPA', 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '3-2', 'C'),
(38, 2014, 'Malaga', 'LIGA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0-1', 'C'),
(39, 2014, 'Celta', 'LIGA', 2, 0, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, '3-1', 'F'),
(40, 2014, 'Almeria', 'LIGA', 3, 0, 3, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '3-0', 'C'),
(41, 2014, 'Sevilla', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'F'),
(42, 2014, 'Valencia', 'LIGA', 1, 2, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '3-2', 'C'),
(43, 2014, 'Espanyol', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '5-1', 'F'),
(44, 2014, 'Getafe', 'LIGA', 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-0', 'C'),
(45, 2015, 'Lyon', 'A', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-1', 'C'),
(46, 2015, 'West Brom', 'A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'C'),
(47, 2015, 'Hellas Verona', 'A', 2, 0, 2, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, '2-0', 'C'),
(48, 2015, 'Barcelona', 'SCES', 3, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, '3-0', 'C'),
(49, 2015, 'Barcelona', 'SCES', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-1', 'F'),
(50, 2015, 'Levante', 'LIGA', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-1', 'C'),
(51, 2015, 'Zaragoza', 'LIGA', 1, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '2-0', 'F'),
(52, 2015, 'Almeria', 'LIGA', 3, 2, 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '5-0', 'C'),
(53, 2015, 'Valencia', 'LIGA', 3, 1, 1, 0, 0, 2, 1, 0, 0, 0, 0, 0, 0, '4-0', 'C'),
(54, 2015, 'Marseille', 'UCL', 1, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '2-2', 'C'),
(55, 2015, 'Atlétic Bilbao', 'LIGA', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-3', 'F'),
(56, 2015, 'Getafe', 'LIGA', 3, 0, 3, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '3-1', 'C'),
(57, 2015, 'Spartak Moskva', 'UCL', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '5-2', 'F'),
(58, 2015, 'Villarreal', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-0', 'C'),
(59, 2015, 'Venezuela', 'ELIM', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-0', 'C'),
(60, 2015, 'Paraguai', 'ELIM', 3, 2, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '6-1', 'C'),
(61, 2015, 'Elche', 'LIGA', 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-0', 'F'),
(62, 2015, 'Galatasaray', 'UCL', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-1', 'C'),
(63, 2015, 'Barcelona', 'LIGA', 2, 2, 2, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '4-2', 'F'),
(64, 2015, 'Atlético Madrid', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '5-1', 'F'),
(65, 2015, 'Malaga', 'LIGA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0-1', 'C'),
(66, 2015, 'Spartak Moskva', 'UCL', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'C'),
(67, 2015, 'Betis', 'LIGA', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-1', 'F'),
(68, 2015, 'Rayo Vallecano', 'LIGA', 3, 0, 3, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '4-3', 'C'),
(69, 2015, 'Bolívia', 'ELIM', 2, 0, 2, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '3-0', 'F'),
(70, 2015, 'Uruguai', 'ELIM', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-3', 'C'),
(71, 2015, 'Marseille', 'UCL', 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-1', 'F'),
(72, 2015, 'Deportivo La Coruna', 'LIGA', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-0', 'C'),
(73, 2015, 'Lugo', 'COPA', 2, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-0', 'C'),
(74, 2015, 'Real Sociedad', 'LIGA', 2, 1, 2, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, '5-0', 'F'),
(75, 2015, 'Galatasaray', 'UCL', 2, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '4-1', 'F'),
(76, 2015, 'Granada', 'LIGA', 2, 0, 2, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, '3-0', 'C'),
(77, 2015, 'Lugo', 'COPA', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '1-0', 'F'),
(78, 2015, 'Barcelona', 'LIGA', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-1', 'F'),
(79, 2015, 'Almeria', 'COPA', 3, 1, 2, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, '5-0', 'F'),
(80, 2015, 'Elche', 'LIGA', 1, 1, 1, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, '5-3', 'C'),
(81, 2015, 'Atlético Madrid', 'COPA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'F'),
(82, 2015, 'Valencia', 'LIGA', 3, 2, 2, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, '5-0', 'F'),
(83, 2015, 'Atletico Madrid', 'COPA', 5, 1, 5, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '6-1', 'C'),
(84, 2015, 'Almeria', 'LIGA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'F'),
(85, 2015, 'Valencia', 'COPA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '5-2', 'F'),
(86, 2015, 'Deportivo La Coruna', 'LIGA', 2, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '4-0', 'F'),
(87, 2015, 'Valencia', 'COPA', 2, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2-0', 'C'),
(88, 2015, 'Espanyol', 'LIGA', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-1', 'C'),
(89, 2015, 'Malaga', 'LIGA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'F'),
(90, 2015, 'Wolfsburg', 'UCL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0-0', 'F'),
(91, 2015, 'Atletico Madrid', 'LIGA', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2-1', 'C'),
(92, 2015, 'Rayo Vallecano', 'LIGA', 2, 0, 2, 0, 0, 0, 0, 1, 0, 1, 0, 0, 1, '2-0', 'F'),
(93, 2015, 'Levante', 'LIGA', 2, 1, 2, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '3-1', 'F'),
(94, 2015, 'Inter', 'UCL', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-1', 'C'),
(95, 2015, 'Sevilla', 'LIGA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-1', 'C'),
(96, 2015, 'Inter', 'UCL', 3, 2, 2, 0, 0, 1, 0, 2, 0, 0, 0, 0, 0, '6-1', 'F'),
(97, 2015, 'Getafe', 'LIGA', 1, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2-0', 'F'),
(98, 2015, 'Barcelona', 'COPA', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-0', 'C'),
(99, 2015, 'Atlétic Bilbao', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '3-0', 'C'),
(100, 2015, 'PSG', 'UCL', 2, 0, 2, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '3-1', 'C'),
(101, 2015, 'Granada', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-0', 'F'),
(102, 2015, 'PSG', 'UCL', 2, 1, 2, 0, 0, 0, 0, 2, 0, 1, 0, 0, 0, '3-0', 'F'),
(103, 2015, 'Real Sociedad', 'LIGA', 2, 0, 2, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '2-0', 'C'),
(104, 2015, 'Villarreal', 'LIGA', 3, 0, 3, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '4-0', 'F'),
(105, 2015, 'Osasuna', 'LIGA', 4, 1, 3, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '6-0', 'C'),
(106, 2015, 'Manchester City', 'UCL', 2, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '4-0', 'C'),
(107, 2016, 'Marseille', 'A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-1', 'C'),
(108, 2016, 'Arsenal', 'A', 4, 1, 0, 3, 1, 0, 0, 1, 0, 0, 0, 0, 0, '6-2', 'C'),
(109, 2016, 'Catania', 'A', 3, 0, 2, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, '4-0', 'C'),
(110, 2016, 'Barcelona', 'SCES', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-2', 'C'),
(111, 2016, 'Barcelona', 'SCES', 4, 1, 4, 0, 0, 0, 0, 3, 0, 1, 0, 0, 0, '5-1', 'F'),
(112, 2016, 'Real Valladolid', 'LIGA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-1', 'C'),
(113, 2016, 'Almeria', 'LIGA', 3, 1, 3, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, '5-1', 'F'),
(114, 2016, 'Zenit', 'SCEU', 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-2', 'C'),
(115, 2016, 'Espanyol', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'C'),
(116, 2016, 'Colômbia', 'ELIM', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'F'),
(117, 2016, 'Chile', 'ELIM', 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-0', 'C'),
(118, 2016, 'Levante', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-1', 'F'),
(119, 2016, 'Milan', 'UCL', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-2', 'C'),
(120, 2016, 'Barcelona', 'LIGA', 1, 4, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '5-2', 'C'),
(121, 2016, 'Eibar', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '2-1', 'F'),
(122, 2016, 'Elche', 'LIGA', 3, 1, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '5-0', 'C'),
(123, 2016, 'Basel', 'UCL', 1, 5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '6-1', 'F'),
(124, 2016, 'Rayo Vallecano', 'LIGA', 2, 1, 2, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, '4-1', 'F'),
(125, 2016, 'Argentina', 'ELIM', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-1', 'F'),
(126, 2016, 'Chile', 'ELIM', 1, 2, 1, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, '4-2', 'F'),
(127, 2016, 'Atletico Madrid', 'LIGA', 1, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '3-1', 'C'),
(128, 2016, 'Liverpool', 'UCL', 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '1-1', 'C'),
(129, 2016, 'Sevilla', 'LIGA', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-1', 'C'),
(130, 2016, 'Getafe', 'LIGA', 5, 0, 3, 2, 0, 0, 0, 1, 0, 0, 0, 0, 0, '5-0', 'F'),
(131, 2016, 'Real Sociedad', 'LIGA', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-0', 'C'),
(132, 2016, 'Milan', 'UCL', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-0', 'F'),
(133, 2016, 'Betis', 'LIGA', 5, 0, 4, 0, 0, 1, 0, 3, 0, 0, 0, 0, 0, '5-0', 'F'),
(134, 2016, 'Granada', 'LIGA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-1', 'C'),
(135, 2016, 'Uruguai', 'AMS', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'C'),
(136, 2016, 'Egito', 'AMS', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-1', 'C'),
(137, 2016, 'Valencia', 'LIGA', 2, 1, 2, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '6-0', 'F'),
(138, 2016, 'Liverpool', 'UCL', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-1', 'F'),
(139, 2016, 'Malaga', 'LIGA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-0', 'C'),
(140, 2016, 'Real Valladolid', 'COPA', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-1', 'C'),
(141, 2016, 'Atlétic Bilbao', 'LIGA', 2, 2, 2, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '4-1', 'F'),
(142, 2016, 'Basel', 'UCL', 3, 0, 1, 0, 2, 0, 0, 1, 0, 0, 0, 0, 0, '4-1', 'C'),
(143, 2016, 'Villarreal', 'LIGA', 3, 1, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '4-2', 'C'),
(144, 2016, 'Real Valladolid', 'COPA', 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2-0', 'F'),
(145, 2016, 'Celta', 'LIGA', 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '2-1', 'F'),
(146, 2016, 'Rayo Vallecano', 'COPA', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2-2', 'F'),
(147, 2016, 'Rayo Vallecano', 'LIGA', 3, 0, 3, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '3-0', 'C'),
(148, 2016, 'Rayo Vallecano', 'COPA', 2, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '3-0', 'C'),
(149, 2016, 'Elche', 'LIGA', 4, 0, 3, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, '5-1', 'F'),
(150, 2016, 'Granada', 'COPA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1-1', 'F'),
(151, 2016, 'Villarreal', 'LIGA', 3, 1, 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '5-1', 'F'),
(152, 2016, 'Granada', 'COPA', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '3-0', 'C'),
(153, 2016, 'Atlétic Bilbao', 'LIGA', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2-1', 'C'),
(154, 2016, 'Atletico Madrid', 'COPA', 2, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '4-0', 'F'),
(155, 2016, 'Real Sociedad', 'LIGA', 3, 1, 2, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, '4-1', 'C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campeonato`
--
ALTER TABLE `campeonato`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partida`
--
ALTER TABLE `partida`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campeonato`
--
ALTER TABLE `campeonato`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `partida`
--
ALTER TABLE `partida`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=156;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
