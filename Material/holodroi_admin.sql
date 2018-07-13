-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 03-Jul-2018 às 16:11
-- Versão do servidor: 5.6.39
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `holodroi_admin`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_adm`
--

DROP TABLE IF EXISTS `tbl_adm`;
CREATE TABLE IF NOT EXISTS `tbl_adm` (
  `id_adm` int(11) NOT NULL AUTO_INCREMENT,
  `nome_adm` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email_adm` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `senha_adm` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_adm`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tbl_adm`
--

INSERT INTO `tbl_adm` (`id_adm`, `nome_adm`, `email_adm`, `senha_adm`) VALUES
(1, 'Gian Gadotti', 'gian@diglink.com.br', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1'),
(5, 'Helio Souza Jr', 'heliosouzajr@gmail.com', 'ef7d32a5385fd6c85f83b23c9992a369d3a926a4'),
(17, 'Cesar Augusto Franzoni', 'gutofranzoni@gmail.com', '59550cba7998d09f4e016255af2ca48aea1abec2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_cli`
--

DROP TABLE IF EXISTS `tbl_cli`;
CREATE TABLE IF NOT EXISTS `tbl_cli` (
  `id_cli` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_cli` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `nome_cli` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email_cli` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `imglogo_cli` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `senha_cli` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_txt` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_img` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_vid` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redir_cli` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `usr_cli` int(11) NOT NULL,
  PRIMARY KEY (`id_cli`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tbl_cli`
--

INSERT INTO `tbl_cli` (`id_cli`, `empresa_cli`, `nome_cli`, `email_cli`, `imglogo_cli`, `senha_cli`, `tipo_txt`, `tipo_img`, `tipo_vid`, `redir_cli`, `usr_cli`) VALUES
(43, 'Voto Certo', 'Gian Gadotti', 'votocerto@gmail.com', '5ab0000a675fc.png', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'txt', 'img', 'vid', '5aa84c304e615.php', 35),
(65, 'Canarinho', 'Cesar Augusto Franzoni', 'gutofranzoni@gmail.com', '5ab41095f3d2c.png', '59550cba7998d09f4e016255af2ca48aea1abec2', 'txt', 'img', 'vid', '5ab41095f3f72.php', 36),
(66, 'DIG Link Marketing Digital', 'DIG Link Marketing Digital', 'diglinkbr@gmail.com', '5ab46035a7088.jpg', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'txt', NULL, NULL, '5ab46035a736a.php', 38),
(72, 'Jacaré Grill Demo', 'Jacaré Grill Demo', 'dev@holodroide.com', '5ad8dffceaabd.png', '8eec16f032281673cf33b2059a3c3cccd59a6906', 'txt', 'img', 'vid', '5ad8dffceacef.php', 54),
(73, 'Voto Certo Demo 2', 'Holodroide Voto Certo Demo 2', 'dev@holodroide.com', '5aff1543a5222.png', '06a4a83d164d21592611ada3c2d53355c2425046', NULL, NULL, 'vid', '5aff1543a5466.php', 59),
(70, 'Riscando os Céus', 'Helinho', 'riscandoceus@gmail.com', '5abd6aedaca32.png', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'txt', 'img', 'vid', '5abd6aedacc95.php', 49),
(74, 'Holodroide Demo', 'HolodroideDev', 'dev@holodroide.com', '5b21159f51eee.png', 'b3a5f88d6f31b21838ebbace58bf74147b522480', NULL, NULL, 'vid', '5b21159f52139.php', 67);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_cnt_usr`
--

DROP TABLE IF EXISTS `tbl_cnt_usr`;
CREATE TABLE IF NOT EXISTS `tbl_cnt_usr` (
  `id_cnt` int(11) NOT NULL AUTO_INCREMENT,
  `id_usr` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `data_cnt` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `text_cnt` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_cnt` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `status_cnt` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_cnt`)
) ENGINE=MyISAM AUTO_INCREMENT=384 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tbl_cnt_usr`
--

INSERT INTO `tbl_cnt_usr` (`id_cnt`, `id_usr`, `id_cli`, `data_cnt`, `text_cnt`, `tipo_cnt`, `status_cnt`) VALUES
(149, 5, 43, '15/03/2018 14:41:34', 'Muitos softwares de publicação e editores de páginas na internet agora usam Lorem Ipsum como texto-modelo', 'txt', 'N'),
(112, 24, 43, '12/03/2018 20:12:01', 'eja nesse artigo os conceitos e exemplos com as cláusulas INNER JOIN, LEFT JOIN e RIGHT JOIN no SQL Serve', 'txt', 'N'),
(154, 5, 43, '15/03/2018 17:20:36', 'Ele usa um dicionário com mais de 200 palavras em Latim combinado com um punhado de modelos de estrutura ', 'txt', 'N'),
(109, 1, 43, '12/03/2018 17:34:40', '5aa6e460a5fa4.JPG', 'img', 'N'),
(193, 35, 43, '21/03/2018 11:37:53', 'fazendo com que ele tenha uma aparência similar a de um texto legível. ', 'txt', 'N'),
(223, 36, 65, '22/03/2018 17:50:19', '1521751810_columbia.mp4', 'vid', 'N'),
(231, 37, 65, '28/03/2018 15:28:32', 'Aqw', 'txt', 'N'),
(107, 1, 43, '12/03/2018 13:44:46', '1520873075_paramount.mp4', 'vid', 'N'),
(136, 1, 43, '14/03/2018 18:23:59', '1521062627_disney_perfeito.mp4', 'vid', 'N'),
(106, 1, 43, '12/03/2018 13:42:13', '1520872924_columbia.mp4', 'vid', 'N'),
(6, 4, 43, '27/02/2018 03:57:34', 'Morbi at mi magna. Vestibulum quis mauris sed elit malesuada condimentum nec a eros. Vestibulum sodales e', 'txt', 'N'),
(148, 5, 43, '15/03/2018 14:36:05', '1521135354_1519412551_teste1.mp4', 'vid', 'N'),
(10, 1, 43, '01/03/2018 01:09:28', 'Deseja adicionar um símbolo de marca registrada? Ainda que sejam essenciais, há muitos caracteres.', 'txt', 'N'),
(11, 1, 43, '01/03/2018 01:10:31', 'Resultados de 21 de fevereiro de 2018 27 de fevereiro de 2018 Observação: não inclui dados de hoje.', 'txt', 'N'),
(222, 36, 65, '22/03/2018 17:49:45', '5ab416e90b62f.jpg', 'img', 'N'),
(14, 1, 43, '01/03/2018 18:21:34', 'Como pegar o último registro de uma tabela no banco de dados mySQL ? Existem duas formas de retornar', 'txt', 'N'),
(113, 1, 43, '13/03/2018 13:04:47', '5aa7f69f1f736.jpg', 'img', 'N'),
(114, 1, 43, '13/03/2018 13:06:13', '1520957154_universal_new.mp4', 'vid', 'N'),
(232, 37, 65, '28/03/2018 15:29:23', '5abbdf0398e6d.jpg', 'img', 'N'),
(227, 37, 65, '23/03/2018 20:09:49', '1521846576_paramount.mp4', 'vid', 'N'),
(162, 1, 43, '16/03/2018 11:18:32', '5aabd2386e3ec.png', 'img', 'N'),
(126, 1, 43, '13/03/2018 16:55:13', 'The example below will output \"Have a good morning!\" if the current time is less than 10, and \"Have a goo', 'txt', 'N'),
(127, 1, 43, '13/03/2018 16:57:52', '5aa82d406e4b4.jpg', 'img', 'N'),
(163, 1, 43, '16/03/2018 11:19:31', '5aabd2737768e.JPG', 'img', 'N'),
(226, 37, 65, '23/03/2018 20:09:10', '5ab5891698c3f.jpg', 'img', 'N'),
(165, 1, 43, '16/03/2018 11:20:18', '1521209998_universal_new.mp4', 'vid', 'N'),
(201, 1, 43, '21/03/2018 12:38:26', 'Guto aqui', 'txt', 'N'),
(167, 26, 43, '16/03/2018 15:12:40', '5aac0918e89c9.png', 'img', 'S'),
(168, 1, 43, '16/03/2018 15:57:54', '1521226661_paramount.mp4', 'vid', 'N'),
(169, 1, 43, '16/03/2018 15:58:50', '1521226717_columbia.mp4', 'vid', 'N'),
(170, 1, 43, '16/03/2018 16:14:08', '1521227631_universal_new.mp4', 'vid', 'N'),
(97, 5, 43, '12/03/2018 01:50:40', ' Proin interdum volutpat sapien. Ut a nisl id neque venenatis facilisis ac et leo. Nullam facilisis, erat', 'txt', 'N'),
(110, 24, 43, '12/03/2018 20:10:31', '5aa708e7b0899.png', 'img', 'N'),
(111, 24, 43, '12/03/2018 20:12:01', 'eja nesse artigo os conceitos e exemplos com as cláusulas INNER JOIN, LEFT JOIN e RIGHT JOIN no SQL Serve', 'txt', 'S'),
(130, 23, 43, '13/03/2018 22:27:38', 'Style the next and previous buttons, the caption text and the dots:', 'txt', 'N'),
(131, 23, 43, '13/03/2018 22:30:09', '5aa87b2129cf6.jpg', 'img', 'N'),
(132, 23, 43, '13/03/2018 22:31:06', '1520991050_1519394232_universal_new.mp4', 'vid', 'N'),
(133, 23, 43, '13/03/2018 22:33:50', 'Um empreendimento que levou 7 meses de muita dedicação 20h/dia para tornar-se realidade.', 'txt', 'N'),
(134, 23, 43, '13/03/2018 22:37:50', '5aa87cee33cb7.gif', 'img', 'S'),
(135, 23, 43, '13/03/2018 22:38:47', '1520991517_1519412551_teste1.mp4', 'vid', 'S'),
(38, 5, 43, '04/03/2018 15:36:32', '5a9c1280237dc.gif', 'img', 'N'),
(152, 5, 43, '15/03/2018 17:11:50', 'Se você pretende usar uma passagem de Lorem Ipsum, precisa ter certeza de que não há algo embaraçoso escr', 'txt', 'N'),
(153, 5, 43, '15/03/2018 17:16:24', 'Todos os geradores de Lorem Ipsum na internet tendem a repetir pedaços predefinidos conforme necessário, ', 'txt', 'N'),
(93, 5, 43, '12/03/2018 01:27:21', '5aa601a966291.png', 'img', 'N'),
(94, 5, 43, '12/03/2018 01:30:16', '5aa602589b16c.jpg', 'img', 'N'),
(95, 5, 43, '12/03/2018 01:43:33', '1520829805_1519412551_teste1.mp4', 'vid', 'N'),
(228, 36, 65, '24/03/2018 22:00:13', 'Helio vamo q vamo ', 'txt', 'S'),
(96, 5, 43, '12/03/2018 01:47:45', '1520830054_1519394232_universal_new.mp4', 'vid', 'N'),
(139, 1, 43, '15/03/2018 00:26:41', 'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo ut', 'txt', 'N'),
(71, 1, 43, '09/03/2018 12:31:44', 'tetste 09/03/2018 as 12h31', 'txt', 'N'),
(217, 35, 43, '22/03/2018 13:32:01', '1521736308_20thcenturyfox.mp4', 'vid', 'N'),
(151, 5, 43, '15/03/2018 17:08:49', 'palavras aleatórias que não parecem nem um pouco convincentes\r\n', 'txt', 'N'),
(91, 5, 43, '11/03/2018 23:43:31', 'In hac habitasse platea dictumst. Sed non orci et tellus blandit egestas vestibulum at orci. Sed leo sem,', 'txt', 'N'),
(137, 1, 43, '14/03/2018 18:26:20', '5aa9937c19d90.jpg', 'img', 'N'),
(138, 1, 43, '15/03/2018 00:23:18', 'É um fato conhecido de todos que um leitor se distrairá com o conteúdo de texto legível de uma página qua', 'txt', 'N'),
(102, 5, 43, '12/03/2018 01:59:25', 'Quando logo como admin e simultaneamente logo como usuario e subo um vídeo e compilo, e na barra de ender', 'txt', 'N'),
(212, 35, 43, '21/03/2018 16:05:08', '1521659099_warnerbros.mp4', 'vid', 'N'),
(220, 35, 43, '22/03/2018 14:05:21', '1521738308_paramount.mp4', 'vid', 'N'),
(175, 1, 43, '16/03/2018 16:58:26', '1521230275_paramount.mp4', 'vid', 'N'),
(174, 1, 43, '16/03/2018 16:51:41', '1521229101_disney_perfeito.mp4', 'vid', 'N'),
(218, 35, 43, '22/03/2018 13:59:21', '1521737944_columbia.mp4', 'vid', 'N'),
(219, 35, 43, '22/03/2018 14:00:33', '1521738017_universal_new.mp4', 'vid', 'N'),
(128, 1, 43, '13/03/2018 18:05:58', '1520975148_1519412551_teste1.mp4', 'vid', 'N'),
(99, 5, 43, '12/03/2018 01:51:25', '5aa6074d3a5c3.jpg', 'img', 'N'),
(213, 35, 43, '21/03/2018 16:08:25', '1521659282_universal.mp4', 'vid', 'N'),
(171, 1, 43, '16/03/2018 16:19:40', '1521227964_paramount.mp4', 'vid', 'N'),
(142, 5, 43, '15/03/2018 14:03:02', '5aaaa74700d16.jpg', 'img', 'N'),
(143, 5, 43, '15/03/2018 14:06:49', '5aaaa829d66b0.jpg', 'img', 'N'),
(216, 35, 43, '22/03/2018 13:31:39', '1521736290_warnerbros.MP4', 'vid', 'N'),
(145, 5, 43, '15/03/2018 14:19:34', '5aaaab260d1e1.jpg', 'img', 'N'),
(146, 5, 43, '15/03/2018 14:26:13', '5aaaacb506e8b.jpg', 'img', 'N'),
(147, 5, 43, '15/03/2018 14:35:24', 'Você observou se o arquivo está em utf-8 ? Criei um arquivo aqui com seu texto e sem precisar incluir', 'txt', 'N'),
(214, 35, 43, '21/03/2018 16:09:30', '1521659360_20thcenturyfox.mp4', 'vid', 'N'),
(215, 35, 43, '22/03/2018 13:31:00', '1521736240_disney_perfeito.mp4', 'vid', 'N'),
(156, 1, 43, '16/03/2018 08:46:13', '5aabae8502157.jpg', 'img', 'N'),
(157, 1, 43, '16/03/2018 08:52:14', '1521201119_disney_perfeito.mp4', 'vid', 'N'),
(176, 1, 43, '16/03/2018 17:02:10', '1521230478_universal_new.mp4', 'vid', 'N'),
(177, 1, 43, '16/03/2018 17:03:33', '1521230589_paramount.mp4', 'vid', 'N'),
(178, 1, 43, '17/03/2018 12:22:31', '1521300097_StarTrekVoyager.mp4', 'vid', 'N'),
(230, 36, 65, '24/03/2018 22:07:42', '1521940046_0bf05860_903f_4991_81bb_a592c5c99ed1.mp4', 'vid', 'S'),
(225, 37, 65, '23/03/2018 20:09:01', 'Teste 23/09/2018', 'txt', 'N'),
(229, 36, 65, '24/03/2018 22:01:42', '5ab6f4f6c00af.JPG', 'img', 'S'),
(200, 35, 43, '21/03/2018 11:55:35', '5ab2726768e2d.png', 'img', 'N'),
(224, 35, 43, '22/03/2018 23:13:06', '1521771177_1520188552_1519412551_teste1.mp4', 'vid', 'N'),
(202, 1, 43, '21/03/2018 12:38:38', '5ab27c7ebb052.jpg', 'img', 'N'),
(221, 36, 65, '22/03/2018 17:49:29', 'aaaaaaaaaa', 'txt', 'N'),
(233, 37, 65, '28/03/2018 15:45:36', '1522262719_universal_new.mp4', 'vid', 'N'),
(234, 37, 65, '28/03/2018 15:54:45', '5abbe4f578983.png', 'img', 'N'),
(282, 42, 68, '29/03/2018 12:57:13', '1522339017_20180329_125621.mp4', 'vid', 'S'),
(236, 37, 65, '28/03/2018 16:11:52', '5abbe8f884240.png', 'img', 'N'),
(283, 42, 68, '29/03/2018 12:59:45', '5abd0d71016f7.gif', 'img', 'N'),
(238, 35, 43, '28/03/2018 16:12:29', '5abbe91d7516d.jpg', 'img', 'N'),
(239, 35, 43, '28/03/2018 16:14:54', '5abbe9aeec641.jpg', 'img', 'N'),
(240, 35, 43, '28/03/2018 16:15:30', '5abbe9d26f9ea.jpg', 'img', 'N'),
(242, 37, 65, '28/03/2018 16:18:12', '5abbea742a31c.jpg', 'img', 'N'),
(243, 37, 65, '28/03/2018 16:18:41', '5abbea9196078.jpg', 'img', 'N'),
(244, 37, 65, '28/03/2018 16:19:06', '5abbeaaa680dd.jpg', 'img', 'N'),
(245, 37, 65, '28/03/2018 16:19:45', '5abbead1c2a8f.jpg', 'img', 'N'),
(246, 35, 43, '28/03/2018 16:20:40', '5abbeb0828daa.jpg', 'img', 'N'),
(305, 44, 69, '29/03/2018 18:37:19', 'qqqqqqqqqqqqqqq', 'txt', 'S'),
(284, 42, 68, '29/03/2018 13:00:16', '5abd0d90cfc21.jpg', 'img', 'S'),
(249, 35, 43, '28/03/2018 16:22:17', '1522264917_20180328_162127.mp4', 'vid', 'N'),
(250, 35, 43, '28/03/2018 16:23:44', '1522265014_20180328_162316.mp4', 'vid', 'N'),
(303, 43, 69, '29/03/2018 18:31:02', '5abd5b1697d85.jpg', 'img', 'S'),
(277, 42, 68, '29/03/2018 12:52:27', 'sdfsdfsdf', 'txt', 'N'),
(278, 42, 68, '29/03/2018 12:52:54', '5abd0bd67256d.png', 'img', 'N'),
(253, 37, 65, '28/03/2018 16:33:17', '1522265583_20180328_163238.mp4', 'vid', 'N'),
(254, 35, 43, '28/03/2018 16:35:08', '5abbee6cd51d4.jpg', 'img', 'N'),
(276, 5, 43, '28/03/2018 18:48:08', '1522273655_20180328_184550.mp4', 'vid', 'N'),
(304, 43, 69, '29/03/2018 18:31:43', '1522359089_disney_perfeito.mp4', 'vid', 'S'),
(288, 37, 65, '29/03/2018 15:21:27', '5abd2ea779202.jpg', 'img', 'N'),
(289, 1, 43, '29/03/2018 15:22:57', '5abd2f0157510.jpg', 'img', 'N'),
(259, 37, 65, '28/03/2018 18:12:21', '5abc0535aa9fa.jpg', 'img', 'N'),
(260, 35, 43, '28/03/2018 18:13:14', '1522271586_20180328_181247.mp4', 'vid', 'N'),
(261, 1, 43, '28/03/2018 18:13:33', '5abc057d7e890.jpg', 'img', 'N'),
(262, 1, 43, '28/03/2018 18:14:51', '1522271680_20180328_181417.mp4', 'vid', 'N'),
(263, 37, 65, '28/03/2018 18:17:08', '1522271816_54396459938__31B8635E_2A34_4E17_9747_56D55BC01DC4.mp4', 'vid', 'N'),
(265, 35, 43, '28/03/2018 18:19:39', '5abc06ebe5748.jpg', 'img', 'N'),
(279, 42, 68, '29/03/2018 12:53:25', '1522338795_1519412551_teste1.mp4', 'vid', 'N'),
(267, 37, 65, '28/03/2018 18:29:14', '1522272544_paramount.mp4', 'vid', 'N'),
(280, 42, 68, '29/03/2018 12:54:58', 'Dthhdjsokd Hd jdksn', 'txt', 'N'),
(302, 43, 69, '29/03/2018 18:30:51', 'ddddddddddddd', 'txt', 'S'),
(270, 37, 65, '28/03/2018 18:40:42', '1522273235_54396602727__DF71492E_786A_4377_8EE4_DD3C77C76AC8.mp4', 'vid', 'N'),
(271, 1, 43, '28/03/2018 18:43:47', '1522273412_20180328_184302.mp4', 'vid', 'N'),
(272, 37, 65, '28/03/2018 18:44:17', '1522273446_20thcenturyfox.mp4', 'vid', 'N'),
(273, 1, 43, '28/03/2018 18:44:43', '5abc0ccb28e25.jpg', 'img', 'N'),
(274, 37, 65, '28/03/2018 18:45:23', '5abc0cf3723d5.jpg', 'img', 'N'),
(275, 5, 43, '28/03/2018 18:45:25', '5abc0cf59af77.jpg', 'img', 'N'),
(290, 1, 43, '29/03/2018 15:23:42', '5abd2f2ece755.jpg', 'img', 'N'),
(291, 37, 65, '29/03/2018 15:26:16', '1522347964_54404074972__414481EF_5C51_4427_A576_B37A1892E74B.mp4', 'vid', 'S'),
(292, 42, 68, '29/03/2018 15:28:17', '5abd30415a368.jpg', 'img', 'N'),
(293, 1, 43, '29/03/2018 15:28:47', '5abd305fae6b9.jpg', 'img', 'N'),
(294, 1, 43, '29/03/2018 15:30:10', '5abd30b2c625c.jpg', 'img', 'N'),
(295, 1, 43, '29/03/2018 15:34:26', '5abd31b2f171d.jpg', 'img', 'N'),
(296, 37, 65, '29/03/2018 15:35:07', '5abd31db41f12.jpg', 'img', 'N'),
(297, 42, 68, '29/03/2018 15:36:16', 'Tuyhjfgjy', 'txt', 'S'),
(298, 37, 65, '29/03/2018 15:36:22', 'Hesgjcgyjcd', 'txt', 'N'),
(299, 1, 43, '29/03/2018 15:36:43', 'Jota Cristo', 'txt', 'N'),
(300, 42, 68, '29/03/2018 15:37:05', '1522348615_20180329_153628.mp4', 'vid', 'N'),
(301, 42, 68, '29/03/2018 15:37:47', '5abd327b79eed.jpg', 'img', 'N'),
(306, 44, 69, '29/03/2018 18:37:27', '5abd5c974affe.png', 'img', 'S'),
(307, 44, 69, '29/03/2018 18:37:48', '1522359459_columbia.mp4', 'vid', 'S'),
(308, 45, 68, '29/03/2018 18:40:21', 'sgfdgfd', 'txt', 'S'),
(309, 46, 68, '29/03/2018 18:54:06', 'asdasdsa', 'txt', 'S'),
(310, 46, 68, '29/03/2018 18:54:19', '5abd608bab7f5.jpg', 'img', 'S'),
(311, 46, 68, '29/03/2018 18:54:50', '1522360478_1520191362_paramount.mp4', 'vid', 'S'),
(312, 49, 70, '29/03/2018 19:39:49', 'bbbbbbbbb', 'txt', 'S'),
(313, 49, 70, '29/03/2018 19:39:56', '5abd6b3ce244a.jpg', 'img', 'S'),
(314, 49, 70, '29/03/2018 19:40:26', '1522363217_paramount.mp4', 'vid', 'S'),
(315, 50, 70, '29/03/2018 19:42:37', 'Jota Cristinho', 'txt', 'S'),
(316, 50, 70, '29/03/2018 19:42:45', '5abd6be5c9294.JPG', 'img', 'S'),
(317, 50, 70, '29/03/2018 19:43:11', '1522363378_20thcenturyfox.mp4', 'vid', 'S'),
(318, 1, 43, '29/03/2018 20:03:46', 'Qwqqqqqw', 'txt', 'N'),
(319, 1, 43, '29/03/2018 20:04:13', '5abd70ed1a3f7.jpg', 'img', 'N'),
(320, 1, 43, '29/03/2018 20:05:40', '1522364732_54405751996__58794A49_2874_42B6_834F_B03B9881475F.mp4', 'vid', 'N'),
(321, 35, 43, '29/03/2018 20:05:41', 'Fhhdrhjfgb  yygfthh', 'txt', 'S'),
(322, 35, 43, '29/03/2018 20:06:18', '5abd716a3905b.jpg', 'img', 'S'),
(323, 35, 43, '29/03/2018 20:07:24', '1522364830_20180329_200638.mp4', 'vid', 'S'),
(324, 5, 43, '04/04/2018 14:51:19', 'Testando 123', 'txt', 'N'),
(325, 5, 43, '04/04/2018 14:51:59', '5ac510bfeb333.jpg', 'img', 'N'),
(326, 5, 43, '04/04/2018 14:53:24', '5ac51114e5875.jpg', 'img', 'N'),
(327, 5, 43, '04/04/2018 14:54:50', '1522864478_20180404_145409.mp4', 'vid', 'N'),
(328, 1, 43, '04/04/2018 20:43:00', '5ac563046fb75.jpg', 'img', 'S'),
(329, 5, 43, '04/04/2018 20:44:48', '5ac56370b33c6.jpg', 'img', 'N'),
(330, 52, 71, '05/04/2018 16:23:48', 'kkkkkkkk', 'txt', 'S'),
(331, 52, 71, '05/04/2018 16:24:16', '1522956245_20thcenturyfox.mp4', 'vid', 'S'),
(332, 53, 71, '05/04/2018 16:27:02', 'nnnnnnnnnnn', 'txt', 'S'),
(333, 53, 71, '05/04/2018 16:27:21', '1522956429_paramount.mp4', 'vid', 'S'),
(334, 1, 43, '07/04/2018 21:54:21', 'mmmmmmmmmmmmmm', 'txt', 'S'),
(335, 1, 43, '07/04/2018 21:54:52', '1523148874_universal_new.mp4', 'vid', 'N'),
(336, 1, 43, '07/04/2018 21:55:23', '1523148910_disney_perfeito.mp4', 'vid', 'N'),
(337, 1, 43, '07/04/2018 22:28:52', '1523150923_20thcenturyfox.mp4', 'vid', 'S'),
(338, 39, 65, '14/04/2018 14:41:54', 'Teste Tania', 'txt', 'S'),
(339, 39, 65, '14/04/2018 14:46:06', '5ad23e5e1688d.jpg', 'img', 'S'),
(340, 39, 65, '14/04/2018 14:47:12', '1523728012_universal_new.mp4', 'vid', 'S'),
(341, 37, 65, '14/04/2018 14:51:31', '5ad23fa3158ae.jpg', 'img', 'S'),
(342, 37, 65, '14/04/2018 14:55:03', 'Teste Guto \r\nUsuário\r\nNormal', 'txt', 'N'),
(343, 52, 71, '19/04/2018 15:09:19', '5ad8db4fa5c3a.png', 'img', 'S'),
(344, 55, 72, '19/04/2018 16:31:03', '1524166251_caipirinha3limoes.mp4', 'vid', 'S'),
(345, 57, 72, '19/04/2018 16:33:36', 'Lousa\r\nJacaré Grill\r\nInsira seu\r\ntexto\r\naqui', 'txt', 'N'),
(346, 56, 72, '19/04/2018 16:52:15', '1524167522_videofotosjacare1.mp4', 'vid', 'N'),
(347, 56, 72, '22/04/2018 11:51:49', '1524408697_videofotosjacare1.mp4', 'vid', 'S'),
(348, 5, 43, '07/05/2018 19:28:27', '1525732099_1519412551_teste1.mp4', 'vid', 'N'),
(349, 37, 65, '09/05/2018 15:58:25', 'iugiuyv.uigo', 'txt', 'S'),
(350, 60, 73, '20/05/2018 17:57:41', '1526849811_joao_doria.mp4', 'vid', 'S'),
(351, 63, 73, '20/05/2018 18:03:05', '1526850164_aildo_rodrigues.mp4', 'vid', 'S'),
(352, 61, 73, '20/05/2018 22:23:35', '1526865772_marcos_pereira.mp4', 'vid', 'S'),
(353, 66, 73, '20/05/2018 22:27:03', '1526865975_edir_macedo.mp4', 'vid', 'S'),
(354, 62, 73, '20/05/2018 22:28:35', '1526866103_victor_kobayashi.mp4', 'vid', 'S'),
(355, 64, 73, '20/05/2018 22:29:30', '1526866152_nilson_leitao.mp4', 'vid', 'S'),
(356, 65, 73, '20/05/2018 22:30:17', '1526866209_tereza_cristina.mp4', 'vid', 'S'),
(357, 5, 43, '27/05/2018 21:32:56', '1527467568_teste14.mp4', 'vid', 'N'),
(358, 57, 72, '30/05/2018 12:39:32', 'JACARÉ ESCREVE O Q VC QUISER, ', 'txt', 'N'),
(359, 57, 72, '30/05/2018 15:36:38', 'Jacare Grill o cara mais legal do Brasil', 'txt', 'S'),
(363, 68, 74, '14/06/2018 11:18:12', '1528985785_paris_holo.mp4', 'vid', 'S'),
(379, 80, 74, '30/06/2018 01:46:57', '1530333916_vegas_holo.mp4', 'vid', 'S'),
(366, 71, 74, '16/06/2018 11:18:50', '1529158553_dizi_holo.mp4', 'vid', 'S'),
(364, 69, 74, '14/06/2018 11:28:47', '1528986433_waves_holo.mp4', 'vid', 'S'),
(381, 67, 74, '01/07/2018 21:50:57', '1530492413_bigbunny_holo.mp4', 'vid', 'S'),
(367, 72, 74, '16/06/2018 11:22:21', '1529158854_rio_holo.mp4', 'vid', 'S'),
(368, 73, 74, '16/06/2018 11:30:58', '1529159347_burns_holo.mp4', 'vid', 'S'),
(369, 74, 74, '16/06/2018 11:36:31', '1529159714_vegas_holo.mp4', 'vid', 'S'),
(370, 59, 73, '17/06/2018 15:18:41', '1529259308_bigbunny_holo.mp4', 'vid', 'S'),
(380, 70, 74, '01/07/2018 19:22:24', '1530483644_voo_hsj_holo.mp4', 'vid', 'S'),
(372, 78, 76, '17/06/2018 17:32:16', '1529267526_20thcenturyfox.mp4', 'vid', 'S'),
(373, 77, 76, '17/06/2018 17:34:21', '1529267635_BadRobot.mp4', 'vid', 'S'),
(374, 79, 76, '17/06/2018 17:44:25', '1529268254_1519394232_universal_new_1.mp4', 'vid', 'S'),
(382, 38, 66, '01/07/2018 22:22:03', 'fsdfsdfsdf', 'txt', 'S'),
(376, 5, 43, '18/06/2018 13:44:59', 'gdfgdfgdfg', 'txt', 'S'),
(377, 5, 43, '18/06/2018 13:45:24', '5b27e1a4a3b1a.jpg', 'img', 'S'),
(378, 5, 43, '18/06/2018 13:46:43', '1529340382_1519394232_universal_new_1.mp4', 'vid', 'S'),
(383, 83, 73, '03/07/2018 15:39:01', '1530643125_bolsonaro2.mp4', 'vid', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_usr`
--

DROP TABLE IF EXISTS `tbl_usr`;
CREATE TABLE IF NOT EXISTS `tbl_usr` (
  `id_usr` int(11) NOT NULL AUTO_INCREMENT,
  `id_cli` int(11) NOT NULL,
  `nome_usr` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email_usr` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `senha_usr` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `redir_usr` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_usr`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tbl_usr`
--

INSERT INTO `tbl_usr` (`id_usr`, `id_cli`, `nome_usr`, `email_usr`, `senha_usr`, `redir_usr`) VALUES
(1, 43, 'Luísa Gadotti', 'luisa@gmail.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '5aa847dd21e5b.php'),
(23, 43, 'Jack Tequila', 'jack@gmail.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '5aa8486fc09c0.php'),
(5, 43, 'Sara Delabianca', 'sara@gmail.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '5aa8493189d72.php'),
(13, 43, 'Eliane Delabianca', 'eliane@gmail.com', '2d29b962490320f821db80cddf6ed4b6e4ac7498', '5aa849834b3d4.php'),
(14, 43, 'Gabi Rabelo', 'gabi@gmail.com', '2d29b962490320f821db80cddf6ed4b6e4ac7498', '5aa849b23ac5a.php'),
(49, 70, 'Helinho', 'riscandoceus@gmail.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '5abd6aedacc95.php'),
(35, 43, 'Gian Gadotti', 'holodroide.ra@gmail.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '5aac8bef0034a.php'),
(36, 65, 'Cesar Augusto Franzoni', 'gutofranzoni@gmail.com', '59550cba7998d09f4e016255af2ca48aea1abec2', '5ab41095f3f72.php'),
(37, 65, 'Guto', 'gutofranzoni@gmail.com', 'c0eec9df7d7d5e2133a92a6a673d8f4e37434a5b', '5abd0a24176f7.php'),
(38, 66, 'Gian Gadotti', 'diglinkbr@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '5ab46035a736a.php'),
(39, 65, 'Tania Bayeux', 'taniabayeux@hotmail.com', '84f7d5edf13d6084776ba4c4f795c88d11753da8', '5abd605a8807a.php'),
(40, 65, 'Gutinho', 'gutofranzoni@gmail.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '5abd5acc840d8.php'),
(50, 70, 'Helinho Usuário RC', 'riscandoceus@gmail.com', '48ef818ad8c9e4bc201863a7c89a6a524d834ce2', '5abd6bb5773e1.php'),
(51, 71, 'Jacaré Grill', 'contato@jacaregrill.com.br', '11e97de1101f5ace8f694bb23147ab2a336f25d3', '5ac3d55966778.php'),
(55, 72, 'Vídeo Camiseta Costas', 'contato@jacaregrill.com.br', '237ff13758f9b9b7116772582d5ce7b3b4e4c24b', '5ad8e2fcb41a1.php'),
(54, 72, 'Jacaré Grill Demo', 'dev@holodroide.com', '8eec16f032281673cf33b2059a3c3cccd59a6906', '5ad8dffceacef.php'),
(56, 72, 'Vídeo Extra Externo', 'contato@jacaregrill.com.br', '4892732da17373950a5e34957449be1a7015918c', '5ad8e39ce72a7.php'),
(57, 72, 'Lousa Externa', 'contato@jacaregrill.com.br', '7e993f61a4698613082f552b2d20e74453e7f238', '5ad8e457eb24d.php'),
(59, 73, 'Holodroide Voto Certo Demo 2', 'dev@holodroide.com', '06a4a83d164d21592611ada3c2d53355c2425046', '5aff1543a5466.php'),
(60, 73, 'Doria', 'dev@holodroide.com', '44bcf88a63b5e442fcfa538eab494d267e285560', '5aff15e85bb62.php'),
(61, 73, 'Marcos Pereira', 'dev@holodroide.com', '4efc0b583bc5268f071207bd86d9fc5c9936158b', '5aff1650cd855.php'),
(62, 73, 'Kobayashi', 'dev@holodroide.com', '8c1118e2cb3354dc8cc72e9d4d5ac387cabb4e0d', '5aff16a8d7a63.php'),
(63, 73, 'Aildo Rodrigues', 'dev@holodroide.com', '1b750ffb0ae784923d89d0fe02ea5cae4d3b4c21', '5aff16f7de6b4.php'),
(64, 73, 'Nilson Leitão', 'dev@holodroide.com', 'bdddedaf7939721ebc4065f92a0a7b4144f3092d', '5aff175089674.php'),
(65, 73, 'Tereza Cristina', 'dev@holodroide.com', '6bcdffff215fa6bcc1d2b08d13d837268a6b7330', '5aff17a0c1be0.php'),
(66, 73, 'Edir Macedo', 'dev@holodroide.com', '0f493bbd8aa715bf30e16652ff0385706a67f96e', '5aff1805363ec.php'),
(67, 74, 'HolodroideDev', 'dev@holodroide.com', 'b3a5f88d6f31b21838ebbace58bf74147b522480', '5b21159f52139.php'),
(68, 74, 'Guto Franzoni', 'gutofranzoni@gmail.com', '057dd594f497254f1ba9658e5fe618e41b846c2b', '5b2273cef13ad.php'),
(69, 74, 'Salim', 'salimrabay@gmail.com', 'd1c88a822cce4dc39c98098fd566be6518d25af6', '5b227af9325d4.php'),
(70, 74, 'Helio', 'heliosouzajr@gmail.com', '3ebfe74e7c0ee9cac801b3425f0faec2eae7e658', '5b227cd28a52c.php'),
(71, 74, 'PresentationOne', 'dev@holodroide.com', '97e184a034d45d12623df2788a2d63459052ee4a', '5b2519046e981.php'),
(72, 74, 'PresentationThree', 'dev@holodroide.com', 'dfac51c3f86d20afda4083cbcd2c0aff94ae8c17', '5b2519861a6cb.php'),
(73, 74, 'PresentationFive', 'dev@holodroide.com', '5b867446f70dcf50c0738f7993c61cdade7c3a2f', '5b2519dcdf6fd.php'),
(74, 74, 'PresentationSeven', 'dev@holodroide.com', 'b16fc3750d8f1e6125bec049fa312071e1e8934c', '5b251a3ae0bae.php'),
(80, 74, 'Website Exemplo 3', 'dev@holodroide.com', '95ff3699aed3cdb1720dced5c905cb87743381f6', '5b37095434ae2.php'),
(83, 73, 'Jair Bolsonaro', 'dev@holodroide.com', 'aad47b226937ab24ab9b373b87f568bad63e5b56', '5b3bc060a03dd.php');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
