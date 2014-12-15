-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Структура на таблица `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL,
  `time` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `tags` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Схема на данните от таблица `posts`
--

INSERT INTO `posts` (`id`, `title`, `text`, `time`, `views`, `tags`) VALUES
(1, 'Lorem Ipsum is simply', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1418481781, 0, 'debel, parjoli, mnogo, kufteta'),
(2, 'rtgfdcfdscxzdfs', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1418482398, 0, 'fasdfasdfasdf'),
(6, 'Наков и Тенчев в', 'Ежегодно Дарик радио избира т. нар &quot;40 до 40&quot; измежду българи, доказали се в различни области. Това са иновативни, креативни хора, които създават и подобряват България.\r\n\r\nМиналият месец на закрита дискусия, журито отличи 40 от общо 230 номинирани.\r\n\r\nЕдин от призовете отиде при Светлин Наков и Христо Тенчев като основатели на Софтуерния университет.\r\n\r\nТази година статистиката показва, че най-често номинирани са хора, успешни в сфери като образование, социални проекти, медицина, изкуство и творчески индустрии, предприемачество и публичен сектор.\r\n\r\nВсички отличени можете да видите в новината на Дарик радио.', 1418602383, 0, 'софтуерен-университет , nakov , наков , софтуни , tenchev , darik , nomination , тенчев , номинация'),
(7, 'Наков и Тенчев в', 'Ежегодно Дарик радио избира т. нар &quot;40 до 40&quot; измежду българи, доказали се в различни области. Това са иновативни, креативни хора, които създават и подобряват България.\r\n\r\nМиналият месец на закрита дискусия, журито отличи 40 от общо 230 номинирани.\r\n\r\nЕдин от призовете отиде при Светлин Наков и Христо Тенчев като основатели на Софтуерния университет.\r\n\r\nТази година статистиката показва, че най-често номинирани са хора, успешни в сфери като образование, социални проекти, медицина, изкуство и творчески индустрии, предприемачество и публичен сектор.\r\n\r\nВсички отличени можете да видите в новината на Дарик радио.', 1418602451, 0, 'софтуерен-университет , nakov , наков , софтуни , tenchev , darik , nomination , тенчев , номинация'),
(8, 'asdasd sad sad &quot;&quot; asd &quot;asd sad &quot;', 'asdjasdasd s asf asf asdf asf asd fasd fasd f\r\nsadf\r\n sa\r\nf \r\nasd\r\nfasdf &quot;&quot;&quot; asdasd &quot; '''' '''''''' ''  ''', 1418602623, 0, 'sadsa,dasd'),
(9, 'Наков и Тенчев в &quot;40 до 40&quot; на Дарик радио', 'Наков и Тенчев в &quot;40 до 40&quot; на Дарик радио\r\nНаков и Тенчев в &quot;40 до 40&quot; на Дарик радио\r\nНаков и Тенчев в &quot;40 до 40&quot; на Дарик радио\r\nНаков и Тенчев в &quot;40 до 40&quot; на Дарик радио\r\nНаков и Тенчев в &quot;40 до 40&quot; на Дарик радио', 1418602723, 0, 'sadsa,dasd'),
(10, 'Наков и Тенчев в &quot;40 до 40&quot; на Дарик радио', 'Ежегодно Дарик радио избира т. нар &quot;40 до 40&quot; измежду българи, доказали се в различни области. Това са иновативни, креативни хора, които създават и подобряват България.\r\n\r\nМиналият месец на закрита дискусия, журито отличи 40 от общо 230 номинирани.\r\n\r\nЕдин от призовете отиде при Светлин Наков и Христо Тенчев като основатели на Софтуерния университет.\r\n\r\nТази година статистиката показва, че най-често номинирани са хора, успешни в сфери като образование, социални проекти, медицина, изкуство и творчески индустрии, предприемачество и публичен сектор.\r\n\r\nВсички отличени можете да видите в новината на Дарик радио.', 1418602777, 0, 'софтуерен-университет , nakov , наков , софтуни , tenchev , darik , nomination , тенчев'),
(11, 'софтуерен-университет , nakov , наков , софтуни , tenchev , darik , nomination , тенчев , номинация , награда , 40-до-40', 'asdjasdasd s asf asf asdf asf asd fasd fasd f\r\nsadf\r\n sa\r\nf \r\nasd\r\nfasdf &quot;&quot;&quot; asdasd &quot; '''' '''''''' ''  ''', 1418602789, 0, 'sadsa,dasd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
