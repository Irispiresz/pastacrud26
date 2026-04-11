-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/11/2025 às 21:25
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CkLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `wda_crud`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(15) NOT NULL,
  `birthdate` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `hood` varchar(100) NOT NULL,
  `zip_code` varchar(8) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `ie` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `customers`
--

INSERT INTO `customers` (`id`, `name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `mobile`, `ie`, `created`, `modified`) VALUES
(1, 'Fulano de Tal', '123.456.789-00', '1989-01-01 00:00:00', 'Rua da Web, 123', 'Internet', '12345678', 'Teste', 'Te', '15 12345678', '15987654321', '123456', '2016-05-24 00:00:00', '2016-05-24 00:00:00'),
(2, 'Ciclano de Tal', '123.456.789-00', '1989-01-01 00:00:00', 'Rua da Web, 123', 'Internet', '12345678', 'Teste', 'Te', '15 12345678', '15987654321', '123456', '2016-05-24 00:00:00', '2016-05-24 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabelaplantas`
--

CREATE TABLE `tabelaplantas` (
  `id` int(11) NOT NULL,
  `especie` varchar(50) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  `porte` int(11) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `datacad` datetime NOT NULL,
  `foto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tabelaplantas`
--

INSERT INTO `tabelaplantas` (`id`, `especie`, `tipo`, `porte`, `descricao`, `datacad`, `foto`) VALUES
(1, 'Rosa Vermelha', 'Flor', 30, 'Planta ornamental com flores vermelhas intensas.', '2025-06-17 00:00:00', 'rosa.png'),
(2, 'Samambaia', 'Folhagem', 60, 'Planta pendente ideal para ambientes internos.', '2025-06-17 00:00:00', 'samambaia.jpg'),
(3, 'Cacto Mandacaru', 'Suculenta', 80, 'Cacto típico do sertão, resistente e decorativo.', '2025-06-17 00:00:00', 'mandacaru.png'),
(4, 'Orquídea Phalaenopsis', 'Flor', 40, 'Flor tropical muito usada em decoração.', '2025-06-17 00:00:00', 'orquidea.jpg'),
(5, 'Lavanda', 'Aromática', 45, 'Planta conhecida por seu perfume relaxante.', '2025-06-17 00:00:00', 'lavanda.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `tipo` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `user`, `password`, `foto`, `tipo`) VALUES
(1, 'Administrador do site', 'admin', '$2y$10$LpFwkYPekC/Ls3lqS0SeF.rKZ6u6kcj.qJweuzBhFmlJv6Mek.hLO', '6924a4b20cd00_admin.png', 'admin'),
(2, 'Zé Lele', 'zelele', '$2y$10$zyOW74b38w0TBUWJUPozFuu8KE6MaOdWaW1x7mYasOK1NpZdfATD2', '6924bd4c335eb_zelele.jpg', 'user'),
(3, 'Mary Zica', 'mazi', '$2y$10$PPOwVl.y6OeuU2ebATtMq.4qoZorPvmhSvbZu2WDXk4px0Bvvjw7u', '6924bd7a4d087_maryzica.jpg', 'user'),
(4, 'Fugiru Nakombi', 'fugina', '623485634753234', '6924bd9dc91dd_combi.jpg', 'user'),
(5, 'Maria S.', 'mary', '$2y$10$hOjcoVX9itPWGkH4kxKpf.TFCVJBDjreQkaglx/lvxpfxldHrmE2i', '6924bc81eb753_usuariomaria.jpg', 'user'),
(17, 'Enzo015', 'enzinho', '$2y$10$thlb.0KsJEZP/ubY6XVqneP1vXs0pSu1Apy6FRiIj2wJyCBK3lpzi', '6924be91e7b9d_enzinho.jpg', 'user'),
(31, 'Maria', 'maria11', '$2y$10$M2xvxVX9MphrE.Vq8M8xK.tIDs2fx8LZ/1tUMzx4rsnBrVgYaxrKW', 'semimagem.png', 'user');
-- admin
--adminPlanta

--maria11
--maria123

CREATE TABLE `times` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `estado` varchar(40) NOT NULL,
  `divisao` varchar(40) NOT NULL,
  `datacad` datetime NOT NULL,
  `foto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `times`
--

INSERT INTO `times` (`id`, `nome`, `estado`, `divisao`, `datacad`, `foto`) VALUES
(1, 'Palmeiras', 'São Paulo - SP', 'Série A', '2026-04-11 15:26:33', '1775929243_palmeiras.webp'),
(2, 'São Paulo', 'São Paulo - SP', 'Série A', '2026-04-11 14:43:43', '1775929423_saopaulo.png'),
(3, 'Fluminense', 'Rio de Janeiro - RJ', 'Série A', '2026-04-11 14:44:45', '1775929485_fluminense.png'),
(4, 'Goiás', 'Goiás - GO', 'Série B', '2026-04-11 14:46:51', '1775929611_goias.jpg'),
(5, 'Avaí', 'Santa Catarina - SC', 'Série B', '2026-04-11 14:49:29', '1775929769_avai.png'),
(6, 'Ituano', 'São Paulo - SP', 'Série C', '2026-04-11 14:50:33', '1775929833_ituano.png'),
(7, 'Maringá', 'Paraná - PR', 'Série C', '2026-04-11 14:52:28', '1775929948_maringa.png'),
(8, 'Manaus', 'Amazonas - AM', 'Série D', '2026-04-11 14:54:37', '1775930077_manaus.jpg'),
(9, 'Nacional', 'São Paulo - SP', 'Série D', '2026-04-11 14:56:29', '1775930189_nacional.png');



--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tabelaplantas`
--
ALTER TABLE `tabelaplantas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tabelaplantas`
--
ALTER TABLE `tabelaplantas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
