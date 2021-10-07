-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 07, 2021 at 10:57 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_litoral_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuracoes`
--

CREATE TABLE `configuracoes` (
                                 `id_configuracao` int(11) NOT NULL,
                                 `barrio` varchar(256) NOT NULL,
                                 `estado` varchar(64) NOT NULL,
                                 `pais` varchar(128) NOT NULL,
                                 `telefones` longtext NOT NULL,
                                 `tipo` longtext NOT NULL,
                                 `email` longtext NOT NULL,
                                 `numero_wp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configuracoes`
--

INSERT INTO `configuracoes` (`id_configuracao`, `barrio`, `estado`, `pais`, `telefones`, `tipo`, `email`, `numero_wp`) VALUES
    (10, 'Av.Oceânica, 819', 'Atalaia - Aracaju/SE', 'Brasil', '[\"79 99988.2442\",\"79 3025.2441\",\"79 99159.4759\"]', '[\"whatsapp\",\"fixo\",\"tim\"]', '[\"reservas@hotellitoral.com.br\"]', '5579999882442');

-- --------------------------------------------------------

--
-- Table structure for table `contato_hotel`
--

CREATE TABLE `contato_hotel` (
                                 `id_contato_hotel` int(11) NOT NULL,
                                 `nome` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `mensagem` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `data` datetime NOT NULL,
                                 `telefone` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `tipo` enum('contato','reserva') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `estado` enum('lido','sem_ler','arquivado','removido') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contato_hotel`
--

INSERT INTO `contato_hotel` (`id_contato_hotel`, `nome`, `email`, `mensagem`, `data`, `telefone`, `tipo`, `estado`) VALUES
                                                                                                                        (1, 'dddd', 'fffff@dd.ff', 'ffffff vvvbbbxx', '2020-08-18 20:59:17', '', 'contato', 'sem_ler'),
                                                                                                                        (2, 'dddd', 'fffff@dd.ff', 'ffffff vvvbbbxx', '2020-08-18 21:07:54', '', 'contato', 'sem_ler'),
                                                                                                                        (3, 'dddd', 'fffff@dd.ff', 'ffffff vvvbbbxx', '2020-08-18 21:09:05', '', 'contato', 'sem_ler'),
                                                                                                                        (4, 'dddd aaaaaa', 'fffff@dd.ffaaaa', 'ffffff vvvbbbxxaaaa', '2020-08-18 21:09:43', '', 'contato', 'sem_ler'),
                                                                                                                        (5, 'fffff', 'fffff@fff.ff', 'fffff ffff f f ff ', '2020-08-22 20:35:20', '', 'reserva', 'sem_ler'),
                                                                                                                        (6, 'rrrr', 'rrr@rrr.rrr', 'rrrrrrrr  rr rrr rrrr', '2020-08-22 20:38:21', '', 'reserva', 'sem_ler'),
                                                                                                                        (7, 'xxxx', 'xxxx@xxx.xxx', 'xxx x xxxx', '2020-08-22 20:40:36', '555555', 'reserva', 'sem_ler'),
                                                                                                                        (8, 'yyy', 'yyyy@yy.yyyyyy', 'yyy y y y y yy yyyy', '2020-08-22 20:43:45', '', 'reserva', 'sem_ler'),
                                                                                                                        (9, 'qqqqq', 'qqqq@qqq.qq', 'qq q  qqqqq q q q q', '2020-08-22 20:44:27', '', 'reserva', 'sem_ler'),
                                                                                                                        (10, 'nnnnn', 'nnnnn@nnn.nn', 'nnn nnn nnnn', '2020-08-22 21:17:55', '', 'reserva', 'sem_ler'),
                                                                                                                        (11, 'ppppp', 'pppppp@pp.pp', 'pppp pppp   ppppp', '2020-08-22 21:23:19', '5555666', 'reserva', 'sem_ler'),
                                                                                                                        (12, 'oooooo', 'ooooo@ooo.oo', 'oo o oooo  oooooo', '2020-08-22 21:26:59', '7778888444', 'reserva', 'sem_ler'),
                                                                                                                        (13, 'rrrr tttttt', 'rrttrrtt@rrtt.rrtt', 'rrttr trtrt trrrt trrt rttr rtrttrtt', '2020-08-22 22:40:30', '', 'reserva', 'sem_ler'),
                                                                                                                        (14, 'rrrr tttttt', 'rrttrrtt@rrtt.rrtt', 'rrttr trtrt trrrt trrt rttr rtrttrtt', '2020-08-22 22:48:35', '', 'reserva', 'sem_ler'),
                                                                                                                        (15, 'rrrr tttttt', 'rrttrrtt@rrtt.rrtt', 'rrttr trtrt trrrt trrt rttr rtrttrtt', '2020-08-22 22:48:48', '', 'reserva', 'sem_ler'),
                                                                                                                        (16, 'rrrr tttttt', 'rrttrrtt@rrtt.rrtt', 'rrttr trtrt trrrt trrt rttr rtrttrtt', '2020-08-22 22:54:55', '', 'reserva', 'sem_ler'),
                                                                                                                        (17, 'kiikikikik', 'kiii@kiki.kik', 'kik ik i kik ikikiki k ik ik ikikikiki', '2020-08-22 22:58:22', '', 'reserva', 'sem_ler'),
                                                                                                                        (18, 'Luis Tesy', 'lfchamorro@gmail.com', 'Esta es una prueba en DEV', '2021-01-02 14:40:29', '3203019089', 'reserva', 'sem_ler'),
                                                                                                                        (19, 'Luis Tesy', 'lfchamorro@gmail.com', 'Esta es una prueba en DEV', '2021-01-02 14:40:38', '3203019089', 'reserva', 'sem_ler'),
                                                                                                                        (20, 'Luiz Angel Speck Santos', 'angspeck@hotmail.com', 'Olá', '2021-04-10 10:08:40', '79991145387', 'reserva', 'sem_ler'),
                                                                                                                        (21, 'Luiz Angel Speck Santos', 'angspeck@hotmail.com', 'Olá', '2021-04-10 10:08:44', '79991145387', 'reserva', 'sem_ler'),
                                                                                                                        (22, 'Luiz Angel Speck Santos', 'angspeck@hotmail.com', 'Olá', '2021-04-10 10:09:05', '79991145387', 'reserva', 'sem_ler'),
                                                                                                                        (23, 'Luiz Angel Speck Santos', 'angspeck@hotmail.com', 'Olá', '2021-04-10 10:09:33', '79991145387', 'reserva', 'sem_ler'),
                                                                                                                        (24, 'Luiz Angel Speck Santos', 'angspeck@hotmail.com', 'Olá', '2021-04-10 10:10:31', '(55)79991145387', 'reserva', 'sem_ler'),
                                                                                                                        (25, 'Luiz Angel Speck Santos', 'angspeck@hotmail.com', 'Olá', '2021-04-10 10:10:35', '(55)79991145387', 'reserva', 'sem_ler'),
                                                                                                                        (26, 'Artur Queiroz ', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26 12:14:47', '54999383352', 'reserva', 'sem_ler'),
                                                                                                                        (27, 'Artur Queiroz ', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26 12:14:55', '54999383352', 'reserva', 'sem_ler'),
                                                                                                                        (28, 'Artur Queiroz ', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26 12:15:19', '54999383352', 'reserva', 'sem_ler'),
                                                                                                                        (29, 'Artur Queiroz ', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26 12:15:19', '54999383352', 'reserva', 'sem_ler'),
                                                                                                                        (30, 'Artur Queiroz ', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26 12:15:19', '54999383352', 'reserva', 'sem_ler'),
                                                                                                                        (31, 'Artur Queiroz ', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26 12:15:23', '54999383352', 'reserva', 'sem_ler'),
                                                                                                                        (32, 'Artur Queiroz ', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26 12:22:13', '54999383352', 'reserva', 'sem_ler'),
                                                                                                                        (33, 'Artur Queiroz ', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26 12:22:13', '54999383352', 'reserva', 'sem_ler'),
                                                                                                                        (34, 'Artur Queiroz ', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26 12:22:13', '54999383352', 'reserva', 'sem_ler'),
                                                                                                                        (35, 'Manuela', 'manupsgomes@gmail.com', 'Boa noite,\nFavor informar valor da diária de quarto para 01 casal e 2 crianças (10 e 16 anos)', '2021-08-02 19:43:38', '(071)988330018', 'contato', 'sem_ler'),
                                                                                                                        (36, 'Manuela', 'manupsgomes@gmail.com', 'Boa noite,\nFavor informar valor da diária de quarto para 01 casal e 2 crianças (10 e 16 anos)', '2021-08-02 19:43:44', '(071)988330018', 'contato', 'sem_ler'),
                                                                                                                        (37, 'Manuela', 'manupsgomes@gmail.com', 'Boa noite,\nFavor informar valor da diária de quarto para 01 casal e 2 crianças (10 e 16 anos)', '2021-08-02 19:44:08', '(071)988330018', 'contato', 'sem_ler'),
                                                                                                                        (38, 'Manuela', 'manupsgomes@gmail.com', 'Boa noite,\nFavor informar valor da diária de quarto para 01 casal e 2 crianças (10 e 16 anos)', '2021-08-02 19:44:20', '(071)988330018', 'contato', 'sem_ler'),
                                                                                                                        (39, ' Silvio Santos Trajano Firmino', 'sstfruas@hotmail.com', 'Gostaria de me hospedar neste hotel entre os dias 29/12/2021 a 02/01/2022. seremos 4 pessoas dois adultos e duas crianças de 05 e 16 anos cada. tem como me ajudar?', '2021-08-09 10:23:31', '(+61)61999866942', 'contato', 'sem_ler'),
                                                                                                                        (40, ' Silvio Santos Trajano Firmino', 'sstfruas@hotmail.com', 'Gostaria de me hospedar neste hotel entre os dias 29/12/2021 a 02/01/2022. seremos 4 pessoas dois adultos e duas crianças de 05 e 16 anos cada. tem como me ajudar?', '2021-08-09 10:23:42', '(+61)61999866942', 'contato', 'sem_ler'),
                                                                                                                        (41, 'Hillary Farias', 'hillaryfarias1000@gmail.com', 'Gostaria de saber a disponibilidade ', '2021-08-24 23:06:29', '82982085073', 'reserva', 'sem_ler'),
                                                                                                                        (42, 'Hillary Farias', 'hillaryfarias1000@gmail.com', 'Gostaria de saber a disponibilidade ', '2021-08-24 23:06:34', '82982085073', 'reserva', 'sem_ler'),
                                                                                                                        (43, 'Hillary Farias', 'hillaryfarias1000@gmail.com', 'Gostaria de saber a disponibilidade ', '2021-08-24 23:06:39', '82982085073', 'reserva', 'sem_ler'),
                                                                                                                        (44, 'Hillary Farias', 'hillaryfarias1000@gmail.com', 'Gostaria de saber a disponibilidade ', '2021-08-24 23:06:39', '82982085073', 'reserva', 'sem_ler'),
                                                                                                                        (45, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:45:48', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (46, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:45:51', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (47, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:45:55', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (48, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:46:01', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (49, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:46:06', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (50, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:46:08', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (51, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:47:56', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (52, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:47:59', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (53, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:48:03', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (54, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:48:09', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (55, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:48:13', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (56, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:48:16', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (57, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:50:06', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (58, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:50:08', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (59, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:50:10', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (60, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:50:16', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (61, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:51:11', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (62, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:51:17', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (63, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:52:14', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (64, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:52:17', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (65, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:52:18', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (66, 'Manoel Adolfo Gomes Sampaio ', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-02 18:52:24', '71992827242', 'reserva', 'sem_ler'),
                                                                                                                        (67, 'Margareth Rodrigues lobato', 'magpaiva64@gmail.com', 'Reserva de quarto e procedimentos para reserva e pagamento.', '2021-09-06 20:14:03', '61999494114', 'reserva', 'sem_ler'),
                                                                                                                        (68, 'Margareth Rodrigues lobato', 'magpaiva64@gmail.com', 'Reserva de quarto e procedimentos para reserva e pagamento.', '2021-09-06 20:14:09', '61999494114', 'reserva', 'sem_ler'),
                                                                                                                        (69, 'Margareth Rodrigues lobato', 'magpaiva64@gmail.com', 'Reserva de quarto e procedimentos para reserva e pagamento.', '2021-09-06 20:14:38', '61999494114', 'reserva', 'sem_ler'),
                                                                                                                        (70, 'Margareth Rodrigues lobato', 'magpaiva64@gmail.com', 'Reserva de quarto e procedimentos para reserva e pagamento.', '2021-09-06 20:14:40', '61999494114', 'reserva', 'sem_ler'),
                                                                                                                        (71, 'Margareth Rodrigues lobato', 'magpaiva64@gmail.com', 'Reserva de quarto e procedimentos para reserva e pagamento.', '2021-09-06 20:14:40', '61999494114', 'reserva', 'sem_ler'),
                                                                                                                        (72, 'Margareth Rodrigues lobato', 'magpaiva64@gmail.com', 'Reserva de quarto e procedimentos para reserva e pagamento.', '2021-09-06 20:14:41', '61999494114', 'reserva', 'sem_ler'),
                                                                                                                        (73, 'Bruno Vieira', 'brunocarlo2@gmail.com', 'Bom dia,\nGostaria de uma reserva para os dias citados.\nEstou disponível para contato.', '2021-09-13 08:45:57', '085996168440', 'reserva', 'sem_ler'),
                                                                                                                        (74, 'Bruno Vieira', 'brunocarlo2@gmail.com', 'Bom dia,\nGostaria de uma reserva para os dias citados.\nEstou disponível para contato.', '2021-09-13 08:46:11', '+(55)85996168440', 'reserva', 'sem_ler'),
                                                                                                                        (75, 'Bruno Vieira', 'brunocarlo2@gmail.com', 'Bom dia,\nGostaria de uma reserva para os dias citados.\nEstou disponível para contato.', '2021-09-13 08:46:16', '+(55)85996168440', 'reserva', 'sem_ler'),
                                                                                                                        (76, 'Bruno Vieira', 'brunocarlo2@gmail.com', 'Bom dia,\nGostaria de uma reserva para os dias citados.\nEstou disponível para contato.', '2021-09-13 09:20:28', '+(55)85996168440', 'reserva', 'sem_ler'),
                                                                                                                        (77, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade. Gostaria de reservar para a minha família', '2021-09-14 16:00:24', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (78, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:01:25', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (79, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:01:29', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (80, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:01:30', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (81, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:01:34', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (82, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:01:35', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (83, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:01:35', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (84, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:03:34', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (85, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:03:36', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (86, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:03:37', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (87, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:03:43', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (88, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:03:43', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (89, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:03:44', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (90, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:05:43', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (91, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:05:44', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (92, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:05:50', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (93, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:05:50', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (94, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:05:51', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (95, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:06:01', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (96, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:07:51', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (97, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:07:51', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (98, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:07:59', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (99, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:07:59', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (100, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:07:59', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (101, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:08:10', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (102, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:09:59', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (103, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:09:59', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (104, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:10:07', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (105, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:10:07', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (106, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:10:07', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (107, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:10:18', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (108, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:12:07', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (109, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:12:07', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (110, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:12:15', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (111, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:12:15', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (112, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:12:15', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (113, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:12:27', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (114, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:14:16', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (115, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:14:16', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (116, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:14:23', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (117, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:14:23', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (118, 'Tiana', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14 16:14:24', '+5592991299233', 'reserva', 'sem_ler'),
                                                                                                                        (119, 'Thaliane Cristina Favoretto Martiniano', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!', '2021-09-24 14:39:19', '(16)981887793', 'reserva', 'sem_ler'),
                                                                                                                        (120, 'Thaliane Cristina Favoretto Martiniano', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!', '2021-09-24 14:39:22', '(16)981887793', 'reserva', 'sem_ler'),
                                                                                                                        (121, 'Thaliane Cristina Favoretto Martiniano', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!', '2021-09-24 14:39:22', '(16)981887793', 'reserva', 'sem_ler'),
                                                                                                                        (122, 'Thaliane Cristina Favoretto Martiniano', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!!', '2021-09-24 14:39:23', '(16)981887793', 'reserva', 'sem_ler'),
                                                                                                                        (123, 'Thaliane Cristina Favoretto Martiniano', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!!', '2021-09-24 14:39:24', '(16)981887793', 'reserva', 'sem_ler'),
                                                                                                                        (124, 'Thaliane Cristina Favoretto Martiniano', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!', '2021-09-24 14:39:24', '(16)981887793', 'reserva', 'sem_ler'),
                                                                                                                        (125, 'Thaliane Cristina Favoretto Martiniano', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!', '2021-09-24 14:41:27', '(16)981887793', 'reserva', 'sem_ler'),
                                                                                                                        (126, 'Luís Ricardo Martins Lima', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-09-28 20:30:21', '98981652635', 'reserva', 'sem_ler'),
                                                                                                                        (127, 'Luís Ricardo Martins Lima', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-09-28 20:30:34', '98981652635', 'reserva', 'sem_ler'),
                                                                                                                        (128, 'Luís Ricardo Martins Lima', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-09-28 20:30:50', '98981652635', 'reserva', 'sem_ler'),
                                                                                                                        (129, 'Luís Ricardo Martins Lima', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-09-28 20:30:50', '98981652635', 'reserva', 'sem_ler'),
                                                                                                                        (130, 'Luís Ricardo Martins Lima', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-09-28 20:30:51', '98981652635', 'reserva', 'sem_ler'),
                                                                                                                        (131, 'Luís Ricardo Martins Lima', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-09-28 20:30:51', '98981652635', 'reserva', 'sem_ler'),
                                                                                                                        (132, 'Luís Ricardo Martins Lima', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-09-28 20:32:28', '98981652635', 'reserva', 'sem_ler'),
                                                                                                                        (133, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:46:26', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (134, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:46:32', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (135, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:46:32', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (136, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:46:40', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (137, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:46:41', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (138, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:46:56', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (139, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:46:56', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (140, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:50:37', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (141, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:50:50', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (142, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:50:51', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (143, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:51:11', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (144, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:51:42', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (145, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:51:43', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (146, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:51:44', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (147, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:52:44', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (148, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:52:58', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (149, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:52:58', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (150, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:53:18', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (151, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:53:50', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (152, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:53:50', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (153, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:53:51', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (154, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:54:52', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (155, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:55:05', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (156, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:55:05', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (157, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:55:26', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (158, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:56:52', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (159, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:58:17', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (160, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 01:59:10', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (161, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:02:51', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (162, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:09:54', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (163, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:09:55', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (164, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:12:30', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (165, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:16:55', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (166, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:18:08', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (167, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:22:30', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (168, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:22:31', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (169, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:22:32', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (170, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:22:33', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (171, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:22:34', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (172, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:22:34', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (173, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:22:35', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (174, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:24:38', '82996128957', 'reserva', 'sem_ler'),
                                                                                                                        (175, 'Wilson Silva de Souza', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-01 02:24:39', '82996128957', 'reserva', 'sem_ler');

-- --------------------------------------------------------

--
-- Table structure for table `feriados`
--

CREATE TABLE `feriados` (
                            `id_feriado` int(11) NOT NULL,
                            `data_inicial` date NOT NULL,
                            `data_final` date NOT NULL,
                            `nome` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feriados`
--

INSERT INTO `feriados` (`id_feriado`, `data_inicial`, `data_final`, `nome`) VALUES
                                                                                (2, '2021-10-06', '2021-10-13', 'São Joãox'),
                                                                                (3, '2021-10-18', '2021-10-27', 'Vacacional');

-- --------------------------------------------------------

--
-- Table structure for table `galeria`
--

CREATE TABLE `galeria` (
                           `id_galeria` int(11) NOT NULL,
                           `nome` varchar(128) NOT NULL,
                           `imagem` varchar(255) NOT NULL,
                           `descricao` varchar(255) DEFAULT NULL,
                           `tipo` enum('home','galery') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'galery',
                           `prioridade` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galeria`
--

INSERT INTO `galeria` (`id_galeria`, `nome`, `imagem`, `descricao`, `tipo`, `prioridade`) VALUES
                                                                                              (12, 'Conforto', '231b98b2037d345a80866ee695cb67fd02d37af3d89a903cfadc4f344bb060cd.jpeg', 'Espaço, conforto e tranquilidade', 'home', 0),
                                                                                              (13, 'Ótimo Serviço', 'b9f67c7f4cb6f74bd84b08cf10af3d9a270c75e5dda6d275820e3c09d0aa1657.jpeg', 'Ótimo Serviço', 'home', 0),
                                                                                              (14, 'Facada', 'acce9d31e829c81f1faf389311bf57da2d7a915b51ad51a20e436f304148e8e5.jpeg', 'Boa vista', 'galery', 0),
                                                                                              (15, 'Recepcao', '17422be70be5d134b50170b03c14709b9f5dc61a0a427e3a2892f1336f45decf.jpg', 'Bom servico', 'galery', 0);

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
                         `id` int(11) NOT NULL,
                         `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `nome`, `email`, `data`) VALUES
    (2, 'eduardo', 'bali_brinski@hotmail.com', '2018-04-16 00:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `oferecimentos`
--

CREATE TABLE `oferecimentos` (
                                 `id_oferecimento` int(11) NOT NULL,
                                 `nome` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `tipo` enum('possui','nao_possui') COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `icone` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `prioridade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oferecimentos`
--

INSERT INTO `oferecimentos` (`id_oferecimento`, `nome`, `tipo`, `icone`, `prioridade`) VALUES
                                                                                           (1, 'TV de LED com canais por assinatura', 'possui', 'fa-tv', 1),
                                                                                           (3, 'WI-FI', 'possui', 'fa-wifi', 2),
                                                                                           (5, 'Ótimo café da manhã (incluso)', 'possui', 'fa-coffee', 3),
                                                                                           (7, 'Ar condicionado split', 'possui', 'wind-solid.svg', 4),
                                                                                           (9, 'Garagem fechada - GRATUITA', 'possui', 'warehouse-solid.svg', 5),
                                                                                           (10, 'Secador de cabelo em todos os aptos', 'possui', 'secador-de-pelo-encendido.svg', 6),
                                                                                           (11, 'Berço (apenas 1)', 'possui', 'cuna-para-siesta.svg', 7),
                                                                                           (12, 'Frigobar com preços acessíveis', 'possui', 'minibar.svg', 8),
                                                                                           (13, 'Animais', 'nao_possui', 'fa-paw', 9),
                                                                                           (14, 'Elevador', 'nao_possui', 'fa-building', 10),
                                                                                           (15, 'Piscina', 'nao_possui', 'swimmer-solid.svg', 11),
                                                                                           (21, 'Cama box', 'possui', 'fa-bed', 12);

-- --------------------------------------------------------

--
-- Table structure for table `opiniao`
--

CREATE TABLE `opiniao` (
                           `id_opiniao` int(11) NOT NULL,
                           `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `sujeito` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `texto` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `data` datetime NOT NULL,
                           `puntuacao` int(11) NOT NULL,
                           `origem` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `status` enum('ativo','inativo') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `promocao`
--

CREATE TABLE `promocao` (
                            `id_promocao` int(11) NOT NULL,
                            `titulo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `texto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `data` date NOT NULL,
                            `estado` enum('ativo','inativo') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quartos`
--

CREATE TABLE `quartos` (
                           `id_quarto` int(11) NOT NULL,
                           `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `descricao` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `preco` float(16,2) NOT NULL,
  `preco_especial` float(16,2) DEFAULT NULL,
  `adultos` int(11) DEFAULT NULL,
  `estado` enum('disponivel','ocupado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_control` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quartos`
--

INSERT INTO `quartos` (`id_quarto`, `nome`, `descricao`, `image`, `preco`, `preco_especial`, `adultos`, `estado`, `order_control`) VALUES
                                                                                                                                       (6, 'Apto. Single', 'Apto. Single', '256a39e590c4219b850088160320d04638fbc730fc4b5174e18b1c5211c4f958.jpg', 115.00, NULL, 1, 'disponivel', 1),
                                                                                                                                       (10, 'Apto. Duplo', 'Apto. Duplo', '0abd83aeedf9f36f8ade751bf9aa9d64108f2205bc4b802e214813fcb25c02db.jpg', 120.00, NULL, 2, 'disponivel', 2),
                                                                                                                                       (11, 'Apto. Triplo', 'Apto. Triplo', 'd9d02aec485106b3fc0f06a49ab0f775818989a7773265668c31f5a055b4df79.jpg', 270.00, NULL, 3, 'disponivel', 3),
                                                                                                                                       (12, 'Apto. Quadruplo', 'Apto. Quadruplo', '6b1ab022015a8ac1e71b41ea2a686be4f96615fe96c63e735b677081e9a3021b.jpg', 310.00, NULL, 4, 'disponivel', 4),
                                                                                                                                       (13, 'Apto. Quintuplo', 'Apto. Quintuplo', '8b0812494ce073c01ec2a163eab7276c26acf227cad821362bd28047906cbbde.jpg', 420.00, NULL, 5, 'disponivel', 5);

-- --------------------------------------------------------

--
-- Table structure for table `quarto_feriado`
--

CREATE TABLE `quarto_feriado` (
                                  `id_quarto_feriado` int(11) NOT NULL,
                                  `id_quarto` int(11) NOT NULL,
                                  `id_feriado` int(11) NOT NULL,
                                  `preco` float(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quarto_feriado`
--

INSERT INTO `quarto_feriado` (`id_quarto_feriado`, `id_quarto`, `id_feriado`, `preco`) VALUES
                                                                                           (6, 6, 2, 110.00),
                                                                                           (7, 10, 2, 210.00),
                                                                                           (8, 11, 2, 310.00),
                                                                                           (9, 12, 2, 410.00),
                                                                                           (10, 13, 2, 510.00),
                                                                                           (11, 6, 3, 90.00),
                                                                                           (12, 10, 3, 100.00),
                                                                                           (13, 11, 3, 110.00),
                                                                                           (14, 12, 3, 120.00),
                                                                                           (15, 13, 3, 130.00);

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
                            `id_reserva` int(11) NOT NULL,
                            `id_quarto` int(11) NOT NULL,
                            `nome_cliente` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `telefone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `mensagem` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `data_entrada` date NOT NULL,
                            `data_saida` date NOT NULL,
                            `num_dias` int(11) NOT NULL,
                            `num_quartos` int(11) NOT NULL,
                            `num_adultos` int(11) NOT NULL,
                            `num_criancas` int(11) NOT NULL,
                            `valor_total` float(16,2) NOT NULL,
  `data_reserva` datetime NOT NULL,
  `estado` enum('pendente','confirmada','cancelada','finalizada') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_quarto`, `nome_cliente`, `telefone`, `email`, `mensagem`, `data_entrada`, `data_saida`, `num_dias`, `num_quartos`, `num_adultos`, `num_criancas`, `valor_total`, `data_reserva`, `estado`) VALUES
                                                                                                                                                                                                                                         (1, 6, 'Teste Luis (Reserva)', '322322322', 'correio@gmail.co', 'Mensagem de teste reserva', '2020-08-13', '2020-08-14', 1, 3, 1, 2, 270.00, '2020-08-13 20:43:00', 'pendente'),
                                                                                                                                                                                                                                         (2, 5, 'fffff', '', 'fffff@fff.ff', 'fffff ffff f f ff ', '2020-08-22', '2020-08-23', 1, 1, 4, 0, 224.00, '2020-08-22 20:34:58', 'pendente'),
                                                                                                                                                                                                                                         (3, 7, 'rrrr', '', 'rrr@rrr.rrr', 'rrrrrrrr  rr rrr rrrr', '2020-08-22', '2020-08-26', 4, 2, 3, 0, 1280.00, '2020-08-22 20:38:00', 'pendente'),
                                                                                                                                                                                                                                         (4, 6, 'xxxx', '555555', 'xxxx@xxx.xxx', 'xxx x xxxx', '2020-08-25', '2020-08-27', 2, 8, 1, 0, 1440.00, '2020-08-22 20:40:15', 'pendente'),
                                                                                                                                                                                                                                         (5, 8, 'yyy', '', 'yyyy@yy.yyyyyy', 'yyy y y y y yy yyyy', '2020-08-22', '2020-08-23', 1, 1, 2, 0, 120.00, '2020-08-22 20:43:24', 'pendente'),
                                                                                                                                                                                                                                         (6, 8, 'qqqqq', '', 'qqqq@qqq.qq', 'qq q  qqqqq q q q q', '2020-08-26', '2020-08-30', 4, 6, 2, 0, 2880.00, '2020-08-22 20:44:05', 'pendente'),
                                                                                                                                                                                                                                         (7, 5, 'nnnnn', '', 'nnnnn@nnn.nn', 'nnn nnn nnnn', '2020-08-22', '2020-10-22', 61, 9, 4, 0, 122.98, '2020-08-22 21:17:33', 'pendente'),
                                                                                                                                                                                                                                         (8, 5, 'ppppp', '5555666', 'pppppp@pp.pp', 'pppp pppp   ppppp', '2020-08-22', '2020-10-22', 61, 9, 4, 0, 122976.00, '2020-08-22 21:22:58', 'pendente'),
                                                                                                                                                                                                                                         (9, 5, 'oooooo', '7778888444', 'ooooo@ooo.oo', 'oo o oooo  oooooo', '2020-08-22', '2020-10-15', 54, 9, 4, 0, 108864.00, '2020-08-22 21:26:38', 'pendente'),
                                                                                                                                                                                                                                         (10, 8, 'rrrr tttttt', '', 'rrttrrtt@rrtt.rrtt', 'rrttr trtrt trrrt trrt rttr rtrttrtt', '0000-00-00', '0000-00-00', 0, 3, 2, 0, 0.00, '2020-08-22 22:40:09', 'pendente'),
                                                                                                                                                                                                                                         (11, 8, 'rrrr tttttt', '', 'rrttrrtt@rrtt.rrtt', 'rrttr trtrt trrrt trrt rttr rtrttrtt', '1969-12-31', '1969-12-31', 0, 3, 2, 0, 0.00, '2020-08-22 22:48:14', 'pendente'),
                                                                                                                                                                                                                                         (12, 8, 'rrrr tttttt', '', 'rrttrrtt@rrtt.rrtt', 'rrttr trtrt trrrt trrt rttr rtrttrtt', '1969-12-31', '1969-12-31', 0, 3, 2, 0, 0.00, '2020-08-22 22:48:27', 'pendente'),
                                                                                                                                                                                                                                         (13, 8, 'rrrr tttttt', '', 'rrttrrtt@rrtt.rrtt', 'rrttr trtrt trrrt trrt rttr rtrttrtt', '1969-12-31', '1969-12-31', 0, 3, 2, 0, 0.00, '2020-08-22 22:54:34', 'pendente'),
                                                                                                                                                                                                                                         (14, 8, 'kiikikikik', '', 'kiii@kiki.kik', 'kik ik i kik ikikiki k ik ik ikikikiki', '2020-08-23', '2020-08-31', 0, 3, 2, 0, 0.00, '2020-08-22 22:58:01', 'pendente'),
                                                                                                                                                                                                                                         (15, 8, 'Luis Tesy', '3203019089', 'lfchamorro@gmail.com', 'Esta es una prueba en DEV', '2021-01-02', '2021-01-03', 28, 1, 2, 0, 3360.00, '2021-01-02 14:40:07', 'pendente'),
                                                                                                                                                                                                                                         (16, 8, 'Luis Tesy', '3203019089', 'lfchamorro@gmail.com', 'Esta es una prueba en DEV', '2021-01-02', '2021-01-03', 28, 1, 2, 0, 3360.00, '2021-01-02 14:40:17', 'pendente'),
                                                                                                                                                                                                                                         (17, 8, 'Luiz Angel Speck Santos', '79991145387', 'angspeck@hotmail.com', 'Olá', '2021-04-13', '2021-04-14', 1, 2, 2, 0, 400.00, '2021-04-10 10:06:29', 'pendente'),
                                                                                                                                                                                                                                         (18, 8, 'Luiz Angel Speck Santos', '79991145387', 'angspeck@hotmail.com', 'Olá', '2021-04-13', '2021-04-14', 1, 2, 2, 0, 400.00, '2021-04-10 10:06:34', 'pendente'),
                                                                                                                                                                                                                                         (19, 8, 'Luiz Angel Speck Santos', '79991145387', 'angspeck@hotmail.com', 'Olá', '2021-04-13', '2021-04-14', 1, 2, 2, 0, 400.00, '2021-04-10 10:06:54', 'pendente'),
                                                                                                                                                                                                                                         (20, 8, 'Luiz Angel Speck Santos', '79991145387', 'angspeck@hotmail.com', 'Olá', '2021-04-13', '2021-04-14', 1, 2, 2, 0, 400.00, '2021-04-10 10:07:25', 'pendente'),
                                                                                                                                                                                                                                         (21, 8, 'Luiz Angel Speck Santos', '(55)79991145387', 'angspeck@hotmail.com', 'Olá', '2021-04-13', '2021-04-14', 1, 2, 2, 0, 400.00, '2021-04-10 10:08:21', 'pendente'),
                                                                                                                                                                                                                                         (22, 8, 'Luiz Angel Speck Santos', '(55)79991145387', 'angspeck@hotmail.com', 'Olá', '2021-04-13', '2021-04-14', 1, 2, 2, 0, 400.00, '2021-04-10 10:08:24', 'pendente'),
                                                                                                                                                                                                                                         (23, 6, 'Artur Queiroz ', '54999383352', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26', '2021-05-28', 2, 1, 1, 0, 210.00, '2021-05-26 12:12:38', 'pendente'),
                                                                                                                                                                                                                                         (24, 6, 'Artur Queiroz ', '54999383352', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26', '2021-05-28', 2, 1, 1, 0, 210.00, '2021-05-26 12:12:44', 'pendente'),
                                                                                                                                                                                                                                         (25, 6, 'Artur Queiroz ', '54999383352', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26', '2021-05-28', 2, 1, 1, 0, 210.00, '2021-05-26 12:13:07', 'pendente'),
                                                                                                                                                                                                                                         (26, 6, 'Artur Queiroz ', '54999383352', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26', '2021-05-28', 2, 1, 1, 0, 210.00, '2021-05-26 12:13:10', 'pendente'),
                                                                                                                                                                                                                                         (27, 6, 'Artur Queiroz ', '54999383352', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26', '2021-05-28', 2, 1, 1, 0, 210.00, '2021-05-26 12:13:10', 'pendente'),
                                                                                                                                                                                                                                         (28, 6, 'Artur Queiroz ', '54999383352', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26', '2021-05-28', 2, 1, 1, 0, 210.00, '2021-05-26 12:13:11', 'pendente'),
                                                                                                                                                                                                                                         (29, 6, 'Artur Queiroz ', '54999383352', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26', '2021-05-28', 2, 1, 1, 0, 210.00, '2021-05-26 12:20:01', 'pendente'),
                                                                                                                                                                                                                                         (30, 6, 'Artur Queiroz ', '54999383352', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26', '2021-05-28', 2, 1, 1, 0, 210.00, '2021-05-26 12:20:02', 'pendente'),
                                                                                                                                                                                                                                         (31, 6, 'Artur Queiroz ', '54999383352', 'artur.rodosul@gmail.com', 'Bom dia. Gostaria que o quarto tivesse cama de casal. Obrigado. ', '2021-05-26', '2021-05-28', 2, 1, 1, 0, 210.00, '2021-05-26 12:20:02', 'pendente'),
                                                                                                                                                                                                                                         (32, 5, 'Hillary Farias', '82982085073', 'hillaryfarias1000@gmail.com', 'Gostaria de saber a disponibilidade ', '2021-09-11', '2021-09-13', 2, 1, 4, 0, 370.00, '2021-08-24 23:04:22', 'pendente'),
                                                                                                                                                                                                                                         (33, 5, 'Hillary Farias', '82982085073', 'hillaryfarias1000@gmail.com', 'Gostaria de saber a disponibilidade ', '2021-09-11', '2021-09-13', 2, 1, 4, 0, 370.00, '2021-08-24 23:04:27', 'pendente'),
                                                                                                                                                                                                                                         (34, 5, 'Hillary Farias', '82982085073', 'hillaryfarias1000@gmail.com', 'Gostaria de saber a disponibilidade ', '2021-09-11', '2021-09-13', 2, 1, 4, 0, 370.00, '2021-08-24 23:04:31', 'pendente'),
                                                                                                                                                                                                                                         (35, 5, 'Hillary Farias', '82982085073', 'hillaryfarias1000@gmail.com', 'Gostaria de saber a disponibilidade ', '2021-09-11', '2021-09-13', 2, 1, 4, 0, 370.00, '2021-08-24 23:04:32', 'pendente'),
                                                                                                                                                                                                                                         (36, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:43:41', 'pendente'),
                                                                                                                                                                                                                                         (37, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:43:44', 'pendente'),
                                                                                                                                                                                                                                         (38, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:43:48', 'pendente'),
                                                                                                                                                                                                                                         (39, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:43:54', 'pendente'),
                                                                                                                                                                                                                                         (40, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:43:58', 'pendente'),
                                                                                                                                                                                                                                         (41, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:44:01', 'pendente'),
                                                                                                                                                                                                                                         (42, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:45:49', 'pendente'),
                                                                                                                                                                                                                                         (43, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:45:52', 'pendente'),
                                                                                                                                                                                                                                         (44, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:45:55', 'pendente'),
                                                                                                                                                                                                                                         (45, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:46:01', 'pendente'),
                                                                                                                                                                                                                                         (46, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:46:06', 'pendente'),
                                                                                                                                                                                                                                         (47, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:46:08', 'pendente'),
                                                                                                                                                                                                                                         (48, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:47:59', 'pendente'),
                                                                                                                                                                                                                                         (49, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:48:01', 'pendente'),
                                                                                                                                                                                                                                         (50, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:48:03', 'pendente'),
                                                                                                                                                                                                                                         (51, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:48:09', 'pendente'),
                                                                                                                                                                                                                                         (52, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:49:04', 'pendente'),
                                                                                                                                                                                                                                         (53, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:49:10', 'pendente'),
                                                                                                                                                                                                                                         (54, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:50:06', 'pendente'),
                                                                                                                                                                                                                                         (55, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:50:10', 'pendente'),
                                                                                                                                                                                                                                         (56, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:50:11', 'pendente'),
                                                                                                                                                                                                                                         (57, 8, 'Manoel Adolfo Gomes Sampaio ', '71992827242', 'cineadolfogomes1973@gmail.com', 'Quarto com 1 cama de casal.', '2021-09-27', '2021-09-30', 3, 1, 2, 0, 375.00, '2021-09-02 18:50:16', 'pendente'),
                                                                                                                                                                                                                                         (58, 7, 'Margareth Rodrigues lobato', '61999494114', 'magpaiva64@gmail.com', 'Reserva de quarto e procedimentos para reserva e pagamento.', '2021-10-12', '2021-10-13', 1, 1, 3, 0, 145.00, '2021-09-06 20:11:56', 'pendente'),
                                                                                                                                                                                                                                         (59, 7, 'Margareth Rodrigues lobato', '61999494114', 'magpaiva64@gmail.com', 'Reserva de quarto e procedimentos para reserva e pagamento.', '2021-10-12', '2021-10-13', 1, 1, 3, 0, 145.00, '2021-09-06 20:12:01', 'pendente'),
                                                                                                                                                                                                                                         (60, 7, 'Margareth Rodrigues lobato', '61999494114', 'magpaiva64@gmail.com', 'Reserva de quarto e procedimentos para reserva e pagamento.', '2021-10-12', '2021-10-13', 1, 1, 3, 0, 145.00, '2021-09-06 20:12:30', 'pendente'),
                                                                                                                                                                                                                                         (61, 7, 'Margareth Rodrigues lobato', '61999494114', 'magpaiva64@gmail.com', 'Reserva de quarto e procedimentos para reserva e pagamento.', '2021-10-12', '2021-10-13', 1, 1, 3, 0, 145.00, '2021-09-06 20:12:32', 'pendente'),
                                                                                                                                                                                                                                         (62, 7, 'Margareth Rodrigues lobato', '61999494114', 'magpaiva64@gmail.com', 'Reserva de quarto e procedimentos para reserva e pagamento.', '2021-10-12', '2021-10-13', 1, 1, 3, 0, 145.00, '2021-09-06 20:12:33', 'pendente'),
                                                                                                                                                                                                                                         (63, 7, 'Margareth Rodrigues lobato', '61999494114', 'magpaiva64@gmail.com', 'Reserva de quarto e procedimentos para reserva e pagamento.', '2021-10-12', '2021-10-13', 1, 1, 3, 0, 145.00, '2021-09-06 20:12:34', 'pendente'),
                                                                                                                                                                                                                                         (64, 6, 'Bruno Vieira', '085996168440', 'brunocarlo2@gmail.com', 'Bom dia,\nGostaria de uma reserva para os dias citados.\nEstou disponível para contato.', '2021-10-09', '2021-10-11', 2, 1, 1, 0, 210.00, '2021-09-13 08:43:50', 'pendente'),
                                                                                                                                                                                                                                         (65, 6, 'Bruno Vieira', '+(55)85996168440', 'brunocarlo2@gmail.com', 'Bom dia,\nGostaria de uma reserva para os dias citados.\nEstou disponível para contato.', '2021-10-09', '2021-10-11', 2, 1, 1, 0, 210.00, '2021-09-13 08:44:04', 'pendente'),
                                                                                                                                                                                                                                         (66, 6, 'Bruno Vieira', '+(55)85996168440', 'brunocarlo2@gmail.com', 'Bom dia,\nGostaria de uma reserva para os dias citados.\nEstou disponível para contato.', '2021-10-09', '2021-10-11', 2, 1, 1, 0, 210.00, '2021-09-13 08:44:09', 'pendente'),
                                                                                                                                                                                                                                         (67, 6, 'Bruno Vieira', '+(55)85996168440', 'brunocarlo2@gmail.com', 'Bom dia,\nGostaria de uma reserva para os dias citados.\nEstou disponível para contato.', '2021-10-09', '2021-10-11', 2, 1, 1, 0, 210.00, '2021-09-13 09:18:21', 'pendente'),
                                                                                                                                                                                                                                         (68, 9, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade. Gostaria de reservar para a minha família', '2021-09-14', '2021-09-15', 1, 1, 5, 0, 225.00, '2021-09-14 15:58:17', 'pendente'),
                                                                                                                                                                                                                                         (69, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 15:59:18', 'pendente'),
                                                                                                                                                                                                                                         (70, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 15:59:22', 'pendente'),
                                                                                                                                                                                                                                         (71, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 15:59:22', 'pendente'),
                                                                                                                                                                                                                                         (72, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 15:59:27', 'pendente'),
                                                                                                                                                                                                                                         (73, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 15:59:27', 'pendente'),
                                                                                                                                                                                                                                         (74, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 15:59:28', 'pendente'),
                                                                                                                                                                                                                                         (75, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:01:27', 'pendente'),
                                                                                                                                                                                                                                         (76, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:01:29', 'pendente'),
                                                                                                                                                                                                                                         (77, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:01:30', 'pendente'),
                                                                                                                                                                                                                                         (78, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:01:35', 'pendente'),
                                                                                                                                                                                                                                         (79, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:01:35', 'pendente'),
                                                                                                                                                                                                                                         (80, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:01:35', 'pendente'),
                                                                                                                                                                                                                                         (81, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:03:35', 'pendente'),
                                                                                                                                                                                                                                         (82, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:03:37', 'pendente'),
                                                                                                                                                                                                                                         (83, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:03:43', 'pendente'),
                                                                                                                                                                                                                                         (84, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:03:43', 'pendente'),
                                                                                                                                                                                                                                         (85, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:03:44', 'pendente'),
                                                                                                                                                                                                                                         (86, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:03:54', 'pendente'),
                                                                                                                                                                                                                                         (87, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:05:43', 'pendente'),
                                                                                                                                                                                                                                         (88, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:05:44', 'pendente'),
                                                                                                                                                                                                                                         (89, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:05:52', 'pendente'),
                                                                                                                                                                                                                                         (90, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:05:52', 'pendente'),
                                                                                                                                                                                                                                         (91, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:05:52', 'pendente'),
                                                                                                                                                                                                                                         (92, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:06:02', 'pendente'),
                                                                                                                                                                                                                                         (93, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:07:52', 'pendente'),
                                                                                                                                                                                                                                         (94, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:07:52', 'pendente'),
                                                                                                                                                                                                                                         (95, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:07:59', 'pendente'),
                                                                                                                                                                                                                                         (96, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:07:59', 'pendente'),
                                                                                                                                                                                                                                         (97, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:08:00', 'pendente'),
                                                                                                                                                                                                                                         (98, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:08:11', 'pendente'),
                                                                                                                                                                                                                                         (99, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:10:00', 'pendente'),
                                                                                                                                                                                                                                         (100, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:10:00', 'pendente'),
                                                                                                                                                                                                                                         (101, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:10:08', 'pendente'),
                                                                                                                                                                                                                                         (102, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:10:08', 'pendente'),
                                                                                                                                                                                                                                         (103, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:10:08', 'pendente'),
                                                                                                                                                                                                                                         (104, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:10:20', 'pendente'),
                                                                                                                                                                                                                                         (105, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:12:08', 'pendente'),
                                                                                                                                                                                                                                         (106, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:12:08', 'pendente'),
                                                                                                                                                                                                                                         (107, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:12:16', 'pendente'),
                                                                                                                                                                                                                                         (108, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:12:16', 'pendente'),
                                                                                                                                                                                                                                         (109, 5, 'Tiana', '+5592991299233', 'tianafraiji@gmail.com', 'Estamos chegando na cidade', '2021-09-14', '2021-09-15', 1, 1, 4, 0, 185.00, '2021-09-14 16:12:16', 'pendente'),
                                                                                                                                                                                                                                         (110, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:35:11', 'pendente'),
                                                                                                                                                                                                                                         (111, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:35:37', 'pendente'),
                                                                                                                                                                                                                                         (112, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:35:48', 'pendente'),
                                                                                                                                                                                                                                         (113, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:35:48', 'pendente'),
                                                                                                                                                                                                                                         (114, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:35:52', 'pendente'),
                                                                                                                                                                                                                                         (115, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:36:07', 'pendente'),
                                                                                                                                                                                                                                         (116, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:37:12', 'pendente'),
                                                                                                                                                                                                                                         (117, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:37:14', 'pendente'),
                                                                                                                                                                                                                                         (118, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:37:15', 'pendente'),
                                                                                                                                                                                                                                         (119, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:37:16', 'pendente'),
                                                                                                                                                                                                                                         (120, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:37:17', 'pendente'),
                                                                                                                                                                                                                                         (121, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:37:17', 'pendente'),
                                                                                                                                                                                                                                         (122, 8, 'Thaliane Cristina Favoretto Martiniano', '(16)981887793', 'thalicfm@yahoo.com.br', 'Boa tarde, \nGostaria de reservar duas suítes para dois casais dos dias 09/10 até o dia 10/10. Peço que pelo menos uma das suítes sejam no terréo, ou no máximo no primeiro andar (estou grávida, e não posso subir tanto escadas..)\nJá estivemos em sua pousada esse ano, a amamos!! \nO outro casal que irá com a gente um deles tem câncer e está com alguns dias difíceis, pode ser que de última hora ele tenha uma recaída com dores e não queira ir, podemos cancelar a reserva?\nSe puderem nos dar um desconto nesse valor eu agradeço muito!', '2021-10-09', '2021-10-10', 1, 2, 2, 0, 290.00, '2021-09-24 14:39:20', 'pendente'),
                                                                                                                                                                                                                                         (123, 6, 'Luís Ricardo Martins Lima', '98981652635', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-10-08', '2021-10-13', 5, 1, 1, 0, 575.00, '2021-09-28 20:28:13', 'pendente'),
                                                                                                                                                                                                                                         (124, 6, 'Luís Ricardo Martins Lima', '98981652635', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-10-08', '2021-10-13', 5, 1, 1, 0, 575.00, '2021-09-28 20:28:27', 'pendente'),
                                                                                                                                                                                                                                         (125, 6, 'Luís Ricardo Martins Lima', '98981652635', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-10-08', '2021-10-13', 5, 1, 1, 0, 575.00, '2021-09-28 20:28:42', 'pendente'),
                                                                                                                                                                                                                                         (126, 6, 'Luís Ricardo Martins Lima', '98981652635', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-10-08', '2021-10-13', 5, 1, 1, 0, 575.00, '2021-09-28 20:28:43', 'pendente'),
                                                                                                                                                                                                                                         (127, 6, 'Luís Ricardo Martins Lima', '98981652635', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-10-08', '2021-10-13', 5, 1, 1, 0, 575.00, '2021-09-28 20:28:44', 'pendente'),
                                                                                                                                                                                                                                         (128, 6, 'Luís Ricardo Martins Lima', '98981652635', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-10-08', '2021-10-13', 5, 1, 1, 0, 575.00, '2021-09-28 20:28:44', 'pendente'),
                                                                                                                                                                                                                                         (129, 6, 'Luís Ricardo Martins Lima', '98981652635', 'rico.555@hotmail.com', 'Verificar disponibilidade de quarto para 01 pessoa', '2021-10-08', '2021-10-13', 5, 1, 1, 0, 575.00, '2021-09-28 20:30:21', 'pendente'),
                                                                                                                                                                                                                                         (130, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:44:19', 'pendente'),
                                                                                                                                                                                                                                         (131, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:44:24', 'pendente'),
                                                                                                                                                                                                                                         (132, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:44:25', 'pendente'),
                                                                                                                                                                                                                                         (133, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:44:33', 'pendente'),
                                                                                                                                                                                                                                         (134, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:44:34', 'pendente'),
                                                                                                                                                                                                                                         (135, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:44:49', 'pendente'),
                                                                                                                                                                                                                                         (136, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:44:49', 'pendente'),
                                                                                                                                                                                                                                         (137, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:48:30', 'pendente'),
                                                                                                                                                                                                                                         (138, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:48:43', 'pendente'),
                                                                                                                                                                                                                                         (139, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:48:43', 'pendente'),
                                                                                                                                                                                                                                         (140, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:49:04', 'pendente'),
                                                                                                                                                                                                                                         (141, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:49:35', 'pendente'),
                                                                                                                                                                                                                                         (142, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:49:36', 'pendente'),
                                                                                                                                                                                                                                         (143, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:49:37', 'pendente'),
                                                                                                                                                                                                                                         (144, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:50:37', 'pendente'),
                                                                                                                                                                                                                                         (145, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:50:50', 'pendente'),
                                                                                                                                                                                                                                         (146, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:50:51', 'pendente'),
                                                                                                                                                                                                                                         (147, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:51:11', 'pendente'),
                                                                                                                                                                                                                                         (148, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:51:42', 'pendente'),
                                                                                                                                                                                                                                         (149, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:51:43', 'pendente'),
                                                                                                                                                                                                                                         (150, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:51:44', 'pendente'),
                                                                                                                                                                                                                                         (151, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:52:44', 'pendente'),
                                                                                                                                                                                                                                         (152, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:52:58', 'pendente'),
                                                                                                                                                                                                                                         (153, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:52:58', 'pendente'),
                                                                                                                                                                                                                                         (154, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:53:19', 'pendente'),
                                                                                                                                                                                                                                         (155, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:54:45', 'pendente'),
                                                                                                                                                                                                                                         (156, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:56:10', 'pendente'),
                                                                                                                                                                                                                                         (157, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 01:57:03', 'pendente'),
                                                                                                                                                                                                                                         (158, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:00:44', 'pendente'),
                                                                                                                                                                                                                                         (159, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:07:46', 'pendente'),
                                                                                                                                                                                                                                         (160, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:07:48', 'pendente'),
                                                                                                                                                                                                                                         (161, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:10:22', 'pendente'),
                                                                                                                                                                                                                                         (162, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:14:47', 'pendente'),
                                                                                                                                                                                                                                         (163, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:16:01', 'pendente'),
                                                                                                                                                                                                                                         (164, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:20:23', 'pendente'),
                                                                                                                                                                                                                                         (165, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:20:24', 'pendente'),
                                                                                                                                                                                                                                         (166, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:20:25', 'pendente'),
                                                                                                                                                                                                                                         (167, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:20:25', 'pendente'),
                                                                                                                                                                                                                                         (168, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:20:26', 'pendente'),
                                                                                                                                                                                                                                         (169, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:20:26', 'pendente'),
                                                                                                                                                                                                                                         (170, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:20:27', 'pendente'),
                                                                                                                                                                                                                                         (171, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:22:30', 'pendente'),
                                                                                                                                                                                                                                         (172, 7, 'Wilson Silva de Souza', '82996128957', 'wilsonss.mat@gmail.com', 'A reserva é para um casal, uma criança de 4 anos e uma criança de 6 meses. Gostaria de pedir um berço no quarto para a criança menor. Obrigado!', '2021-10-09', '2021-10-12', 3, 1, 3, 0, 525.00, '2021-10-01 02:22:31', 'pendente');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
                            `id_usuario` int(11) NOT NULL,
                            `nome` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `user` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `senha` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `rol` int(11) NOT NULL COMMENT '1. Admin - 2. User',
                            `estado` enum('ativo','inativo') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `user`, `senha`, `rol`, `estado`) VALUES
                                                                                    (1, 'Hermes Lira', 'hermes', 'e8297ec3f74ca17619cae6d356bd5babc1ae748f', 1, 'ativo'),
                                                                                    (2, 'Luis Chamorro', 'devluis', 'e8297ec3f74ca17619cae6d356bd5babc1ae748f', 1, 'ativo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configuracoes`
--
ALTER TABLE `configuracoes`
    ADD PRIMARY KEY (`id_configuracao`);

--
-- Indexes for table `contato_hotel`
--
ALTER TABLE `contato_hotel`
    ADD PRIMARY KEY (`id_contato_hotel`);

--
-- Indexes for table `feriados`
--
ALTER TABLE `feriados`
    ADD PRIMARY KEY (`id_feriado`,`data_inicial`,`data_final`);

--
-- Indexes for table `galeria`
--
ALTER TABLE `galeria`
    ADD PRIMARY KEY (`id_galeria`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oferecimentos`
--
ALTER TABLE `oferecimentos`
    ADD PRIMARY KEY (`id_oferecimento`);

--
-- Indexes for table `opiniao`
--
ALTER TABLE `opiniao`
    ADD PRIMARY KEY (`id_opiniao`);

--
-- Indexes for table `promocao`
--
ALTER TABLE `promocao`
    ADD PRIMARY KEY (`id_promocao`);

--
-- Indexes for table `quartos`
--
ALTER TABLE `quartos`
    ADD PRIMARY KEY (`id_quarto`);

--
-- Indexes for table `quarto_feriado`
--
ALTER TABLE `quarto_feriado`
    ADD PRIMARY KEY (`id_quarto_feriado`),
  ADD KEY `id_quarto` (`id_quarto`),
  ADD KEY `id_feriado` (`id_feriado`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
    ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_quarto` (`id_quarto`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
    ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configuracoes`
--
ALTER TABLE `configuracoes`
    MODIFY `id_configuracao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contato_hotel`
--
ALTER TABLE `contato_hotel`
    MODIFY `id_contato_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `feriados`
--
ALTER TABLE `feriados`
    MODIFY `id_feriado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galeria`
--
ALTER TABLE `galeria`
    MODIFY `id_galeria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oferecimentos`
--
ALTER TABLE `oferecimentos`
    MODIFY `id_oferecimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `opiniao`
--
ALTER TABLE `opiniao`
    MODIFY `id_opiniao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promocao`
--
ALTER TABLE `promocao`
    MODIFY `id_promocao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quartos`
--
ALTER TABLE `quartos`
    MODIFY `id_quarto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quarto_feriado`
--
ALTER TABLE `quarto_feriado`
    MODIFY `id_quarto_feriado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
    MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
    MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;