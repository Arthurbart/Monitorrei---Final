-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/07/2025 às 13:46
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `monitorrei`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avisos`
--

CREATE TABLE `avisos` (
  `id` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `data_aviso` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `monitoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avisos`
--

INSERT INTO `avisos` (`id`, `conteudo`, `data_aviso`, `usuario_id`, `monitoria_id`) VALUES
(12, 'Pessoal, quinta feira (05/06) não irei conseguir estar aparecendo, semana q vem segue normal', '2025-06-03', 1, 46),
(13, 'gentee, tenho disponiveis alguns cabos pra voces derem uma olhada, terei toda a semana eles aqui na monitoria', '2025-06-03', 3, 47),
(14, 'galera, a partir de hj a monitoria ta aberta, podem vir', '2025-06-03', 17, 50);

-- --------------------------------------------------------

--
-- Estrutura para tabela `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `tipo` text NOT NULL,
  `doc` longblob DEFAULT NULL,
  `descricao` text NOT NULL,
  `data_postagem` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `monitoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `documentos`
--

INSERT INTO `documentos` (`id`, `titulo`, `tipo`, `doc`, `descricao`, `data_postagem`, `usuario_id`, `monitoria_id`) VALUES
(7, '', 'Conteúdo', 0x315f34365f464c45582d424f582e706466, 'Doc de flex-box pra quem precisar pra prova', '2025-06-03', 1, 46),
(10, '', 'Atividade', 0x315f34375f4564756361c3a7c3a36f2046c3ad736963612e706466, 'exercicios de cabeamento estruturado pra prova do segundo ano terça', '2025-07-21', 3, 47),
(11, '', 'Atividade', 0x385f34365f49505634202d20536567756e646f20496e666f2e706466, 'vdvdvdf', '2025-07-21', 1, 46);

-- --------------------------------------------------------

--
-- Estrutura para tabela `monitorias`
--

CREATE TABLE `monitorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `horario` varchar(50) NOT NULL,
  `sala` varchar(50) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `curso` varchar(50) NOT NULL DEFAULT 'Todos os cursos',
  `status` varchar(10) NOT NULL DEFAULT 'ativo',
  `dias` varchar(50) NOT NULL DEFAULT 'Segundas, terças e quintas',
  `img_banner` text NOT NULL DEFAULT 'imgs/banner/default.jpg',
  `img_card` text NOT NULL DEFAULT 'imgs/card/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `monitorias`
--

INSERT INTO `monitorias` (`id`, `nome`, `horario`, `sala`, `usuario_id`, `curso`, `status`, `dias`, `img_banner`, `img_card`) VALUES
(44, 'Química', '13:00', 'Sala G4', 13, 'Todos os Cursos', 'ativo', 'Terças e Quintas', 'imgs/banner/Química_banner.png', 'imgs/card/Química_card.png'),
(46, 'Programação', '13:00', 'Lab 04', 1, 'Informática', 'ativo', 'Segundas, Terças e Quintas', 'imgs/banner/Programação_banner.png', 'imgs/card/Programação_card.png'),
(47, 'Redes de Computadores', '13:00', 'Lab 03', 3, 'Informática', 'ativo', 'Terças e Quintas', 'imgs/banner/Redes_de_Computadores_banner.png', 'imgs/card/Redes de Computadores_card.png'),
(49, 'Biologia', '13:00', 'Sala G2', 14, 'Todos os Cursos', 'ativo', 'Segundas', 'imgs/banner/Biologia_banner.png', 'imgs/card/Biologia_card.png'),
(50, 'Matemática', '13:00', 'Lab 06', 17, 'Todos os Cursos', 'ativo', 'Segundas, Terças e Quintas', 'imgs/banner/Matemática_banner.png', 'imgs/card/Matemática_card.png'),
(51, 'Leites', '13:00', 'Lab de Leites', 12, 'Alimentos', 'ativo', 'Terças e Quintas', 'imgs/banner/Leites_banner.png', 'imgs/card/Leites_card.png'),
(52, 'Língua Inglesa', '13:00', 'Lab 02', 4, 'Todos os Cursos', 'ativo', 'Segundas', 'imgs/banner/Língua_Inglesa_banner.png', 'imgs/card/Língua Inglesa_card.png'),
(53, 'Física', '13:00', 'Laboratório de Física - Prédio i', 15, 'Todos os Cursos', 'ativo', 'Segundas, Terças e Quintas', 'imgs/banner/Física_banner.png', 'imgs/card/Física_card.png'),
(54, 'Direito', '13:00', 'Sala G1', 16, 'Administração', 'ativo', 'Segundas, Terças e Quintas', 'imgs/banner/Direito_banner.png', 'imgs/card/Direito_card.png'),
(55, 'Zootecnia', '13:00', 'A Combinar', 6, 'Agropecuária', 'ativo', 'Segundas, Terças e Quintas', 'imgs/banner/Zootecnia_banner.png', 'imgs/card/Zootecnia_card.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos_conteudo`
--

CREATE TABLE `pedidos_conteudo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `monitoria_id` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `data_pedido` date NOT NULL DEFAULT curdate(),
  `status` varchar(50) NOT NULL DEFAULT 'Pendente',
  `id_pai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos_conteudo`
--

INSERT INTO `pedidos_conteudo` (`id`, `usuario_id`, `monitoria_id`, `conteudo`, `data_pedido`, `status`, `id_pai`) VALUES
(51, 1, 44, 'Estou com muita dúvida em substâncias inorgânicas, podia me ajudar?? tenho prova amanhã', '2025-06-03', 'Em Aguardo', NULL),
(52, 1, 54, 'Você poderia falar sobre o artigo 5 na monitoria de quinta?', '2025-06-03', 'Em Aguardo', NULL),
(53, 1, 52, 'What is your name?', '2025-06-03', 'Em Aguardo', NULL),
(54, 1, 50, 'Não entendo nada de algoritmos cara, me help pls', '2025-06-03', 'aceito', NULL),
(55, 1, 50, 'não tenho pressa, apenas me diga quando devo ir a sua monitoria\r\n', '2025-06-03', 'null', 54),
(56, 3, 44, 'Se você puder passar algo sobre as funções hidrogenadas da quimica organica eu agradeceria mtt', '2025-06-03', 'Em Aguardo', NULL),
(57, 3, 46, 'Poderia me ajudar c umas duvidas em php?', '2025-06-03', 'negado', NULL),
(58, 3, 49, 'Essa quinta irei la, estou com duvidas em botanica, pode me ajudar?', '2025-06-03', 'Em Aguardo', NULL),
(59, 3, 50, 'Preciso de muuuuita ajuda em matrizes, tenho a proxima segunda livre', '2025-06-03', 'aceito', NULL),
(60, 17, 50, 'pode vir mano, terça feira tá livre pra ti', '2025-06-03', 'null', 54),
(62, 1, 46, 'não', '2025-06-23', 'null', 57),
(63, 3, 46, 'ok\r\n', '2025-06-23', 'null', 57),
(64, 1, 46, 'kkkkkkkkk capaiz', '2025-07-07', 'null', 57),
(71, 1, 51, 'você também trabalha com a matéria de Carnes?', '2025-07-21', 'Em Aguardo', NULL),
(72, 3, 46, 'brigadaum', '2025-07-21', 'null', 57),
(73, 3, 52, 'voce possui o livro didatico?', '2025-07-21', 'Em Aguardo', NULL),
(74, 3, 46, 'tudo bem?', '2025-07-21', 'Em Aguardo', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `presencas`
--

CREATE TABLE `presencas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `monitoria_id` int(11) NOT NULL,
  `data_presenca` date NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `presencas`
--

INSERT INTO `presencas` (`id`, `usuario_id`, `monitoria_id`, `data_presenca`, `feedback`) VALUES
(13, 13, 46, '2025-06-03', 'Cooperou bastante'),
(14, 17, 46, '2025-06-03', 'Conversou bastante, xiiiii'),
(15, 4, 46, '2025-06-03', 'Aprendeu muito'),
(16, 14, 46, '2025-06-05', 'Agregou muito'),
(19, 6, 47, '2025-05-22', 'Aluno muito interessado tinha algumas dificuldades que foram saneadas'),
(20, 13, 47, '2025-05-22', 'Muitas duvidas, vira na proxima monitoria para terminar com suas duvidas\r\n'),
(21, 6, 46, '2025-07-22', 'ok');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `curso` varchar(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `matricula` int(11) NOT NULL,
  `cargo` varchar(10) NOT NULL DEFAULT 'aluno',
  `foto` varchar(255) NOT NULL DEFAULT 'imgs/usuario/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `senha`, `curso`, `nome`, `matricula`, `cargo`, `foto`) VALUES
(1, 'Bernardo00', 'informatica', 'Arthur Bernardo Barth', 2023319513, 'admin', 'imgs/usuario/default.jpg'),
(3, 'juver', 'informatica', 'Felipe Juver', 2023123123, 'aluno', 'imgs/usuario/2023123123_FTperfil'),
(4, 'ferri', 'Alimentos', 'Bernardo Ferri', 2023319700, 'docente', 'imgs/usuario/2023319700_FTperfil'),
(5, 'helena', 'Alimentos', 'Helena Tamiozzo', 2022315206, 'aluno', 'imgs/usuario/default.jpg'),
(6, 'joca', 'agropecuaria', 'Joaquim Kunz', 2024312099, 'aluno', 'imgs/usuario/default.jpg'),
(7, '', 'agropecuaria', 'Bruno Rodrigues', 2024305700, 'aluno', 'imgs/usuario/default.jpg'),
(8, '', 'agropecuaria', 'Kauan Ferreira', 2024312992, 'aluno', 'imgs/usuario/default.jpg'),
(9, '', 'agropecuaria', 'David Brayan', 2024326227, 'aluno', 'imgs/usuario/default.jpg'),
(10, '', 'agropecuaria', 'Bento Finn', 2024313990, 'aluno', 'imgs/usuario/default.jpg'),
(11, '', 'agropecuaria', 'Andre Welter', 2024305586, 'aluno', 'imgs/usuario/default.jpg'),
(12, 'rineita', 'informatica', 'Renata Petry', 2022314488, 'aluno', 'imgs/usuario/2022314488_FTperfil'),
(13, 'dudinha', 'informatica', 'Maria Eduarda', 2022314441, 'aluno', 'imgs/usuario/default.jpg'),
(14, 'luiza', 'Informática', 'Luiza Rodrigues', 2023321100, 'aluno', 'imgs/usuario/2023321100_FTperfil'),
(15, 'bruna', 'Informática', 'Bruna Sell', 2023320013, 'aluno', 'imgs/usuario/2023320013_FTperfil'),
(16, 'julia', 'Informática', 'Julia Bataiolli', 2023320416, 'aluno', 'imgs/usuario/2023320416_FTperfil'),
(17, 'cabecinha', 'Informática', 'Lucas Arnet', 2023321208, 'aluno', 'imgs/usuario/2023321208_FTperfil');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `monitoria_id` (`monitoria_id`);

--
-- Índices de tabela `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `monitoria_id` (`monitoria_id`);

--
-- Índices de tabela `monitorias`
--
ALTER TABLE `monitorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monitor_id` (`usuario_id`);

--
-- Índices de tabela `pedidos_conteudo`
--
ALTER TABLE `pedidos_conteudo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`usuario_id`),
  ADD KEY `monitoria_id` (`monitoria_id`);

--
-- Índices de tabela `presencas`
--
ALTER TABLE `presencas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`usuario_id`),
  ADD KEY `monitoria_id` (`monitoria_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `monitorias`
--
ALTER TABLE `monitorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `pedidos_conteudo`
--
ALTER TABLE `pedidos_conteudo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de tabela `presencas`
--
ALTER TABLE `presencas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avisos`
--
ALTER TABLE `avisos`
  ADD CONSTRAINT `avisos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avisos_ibfk_2` FOREIGN KEY (`monitoria_id`) REFERENCES `monitorias` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documentos_ibfk_2` FOREIGN KEY (`monitoria_id`) REFERENCES `monitorias` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `monitorias`
--
ALTER TABLE `monitorias`
  ADD CONSTRAINT `monitorias_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pedidos_conteudo`
--
ALTER TABLE `pedidos_conteudo`
  ADD CONSTRAINT `pedidos_conteudo_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedidos_conteudo_ibfk_2` FOREIGN KEY (`monitoria_id`) REFERENCES `monitorias` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `presencas`
--
ALTER TABLE `presencas`
  ADD CONSTRAINT `presencas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `presencas_ibfk_2` FOREIGN KEY (`monitoria_id`) REFERENCES `monitorias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
