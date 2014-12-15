-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 5.6.21
-- PHP Version: 5.6.3

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
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `time` datetime NOT NULL,
  `tags` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `posts`
--

INSERT INTO `posts` (`id`, `title`, `text`, `time`, `tags`) VALUES
(1, 'This is a test title in our blog', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sollicitudin turpis lectus, quis vulputate nunc scelerisque vel. Mauris lacinia urna mauris, ac tincidunt est vestibulum sed. Suspendisse eleifend mauris tellus, sit amet sagittis eros cursus quis. Vestibulum commodo pretium quam et pulvinar. In quis egestas nisl. Cras in dui nec nunc mollis blandit id quis ex. Quisque vitae leo eleifend, accumsan ex in, fringilla lorem. Cras dignissim lobortis nisl, sit amet viverra magna accumsan quis. Vivamus egestas vestibulum pretium. Quisque vitae maximus dui, quis rhoncus odio.\r\n\r\nPellentesque in ex eu eros facilisis vestibulum. Donec lectus eros, commodo nec blandit in, dignissim sed ipsum. Praesent efficitur leo id urna sagittis bibendum. Curabitur nec ante diam. Mauris non mauris finibus, aliquam urna sodales, convallis orci. Curabitur consectetur eros tortor, eu sollicitudin nibh convallis et. Sed at nulla mi. Curabitur ullamcorper velit eget quam imperdiet rhoncus. Nam aliquet mollis purus nec imperdiet. Praesent scelerisque, nulla et ultricies suscipit, ipsum lacus vulputate elit, consequat fermentum nulla sem sed orci. Cras gravida ipsum ac fringilla semper. Aenean sapien ante, malesuada id vehicula non, pharetra vitae lorem. Aenean leo eros, sollicitudin id elementum ac, hendrerit in neque. Phasellus consequat pharetra suscipit. Proin at porta nunc.\r\n\r\nAenean in efficitur libero. In hac habitasse platea dictumst. Morbi et ligula a lectus pulvinar efficitur. Duis hendrerit nulla a tortor auctor bibendum. Etiam sed massa neque. Donec in magna nec eros pharetra porta sed non elit. Nullam sit amet est quis ipsum aliquam vestibulum. Praesent pulvinar risus nisl, nec faucibus lacus pharetra in. Maecenas maximus, diam in pulvinar tempus, est enim cursus sapien, vitae dapibus nunc elit id elit. Aenean venenatis est eu molestie hendrerit. Aenean ac malesuada libero. Nulla at arcu at est posuere sodales.\r\n\r\nNullam eu commodo lectus, non porta odio. Donec et aliquam est. Vestibulum quis felis vel quam ullamcorper sollicitudin et nec purus. Donec accumsan augue ligula, et vestibulum eros mattis quis. Integer ligula odio, ornare eget neque quis, faucibus congue lectus. Proin at metus sed justo viverra tincidunt. In nisl orci, semper vel gravida eu, laoreet in sapien. Aliquam erat volutpat. Quisque ornare aliquam libero quis rhoncus.\r\n\r\nPhasellus eu arcu vel arcu imperdiet elementum quis at urna. Pellentesque purus justo, lobortis a neque eget, finibus consequat ante. Proin iaculis lorem sit amet nisl consequat, ac vulputate odio finibus. Ut aliquam non neque eu volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec laoreet scelerisque lorem, sed facilisis dolor sollicitudin eu. Vivamus eget euismod elit. Sed sed risus sit amet magna viverra elementum. Quisque lobortis mollis elit, in porttitor dolor rutrum quis. Quisque vel sollicitudin sapien, vel tempus nibh. Integer nec eleifend diam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla eros tortor, interdum quis nunc ac, sollicitudin auctor lectus. Nam ac tincidunt ex, id sagittis enim.\r\n\r\n??????????? ????? ???????? ?? ?????? Lorem Ipsum, ?? ???????? ?? ??? ?? ????????? ?? ???? ??? ???? ????? ???? ???????? ?? ?????? ???? ??? ??????????? ?? ??????, ????? ?? ???????? ????? ??????????. ??? ?????? ?? ?????????? ????? ?? Lorem Ipsum, ?????? ?? ??? ???????, ?? ? ???? ???? ????????? ??? ?????????? ????. ?????? Lorem Ipsum ?????????? ? ???????? ????????? ????????????? ??????, ????? ?? ????????, ????? ????? ???? ???? ????????? ?????? ???????? ?????. ??? ???????? ?????? ?? ??? 200 ???????? ????, ??????????? ?? ???????? ????? ???? ?????????, ?? ?? ????????? ???????? Lorem Ipsum ??????. ????? ??????, ?? ???????????? Lorem Ipsum ????? ?? ??????? ??????????, ?????????, ?????????? ? ???????? ??????????? ????.', '0000-00-00 00:00:00', 'test, lorem, ipsum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
