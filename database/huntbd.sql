-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Jul-2020 às 23:16
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `huntbd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `armaevento`
--

CREATE TABLE `armaevento` (
  `codTipo` int(11) NOT NULL,
  `codArma` int(11) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `armaevento`
--

INSERT INTO `armaevento` (`codTipo`, `codArma`, `ativo`) VALUES
(1, 1, b'1'),
(1, 2, b'1'),
(1, 3, b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carteira`
--

CREATE TABLE `carteira` (
  `codCarteira` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `carteira`
--

INSERT INTO `carteira` (`codCarteira`, `saldo`, `ativo`) VALUES
(1, 8660, b'1'),
(2, 600, b'1'),
(3, 550, b'1'),
(5, 0, b'1'),
(6, 5, b'1'),
(7, 0, b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE `evento` (
  `codEvento` int(11) NOT NULL,
  `codTipo` int(11) NOT NULL,
  `codAnimal` int(11) NOT NULL,
  `codLocalizacao` int(11) NOT NULL,
  `ata` varchar(200) NOT NULL,
  `preco` int(11) NOT NULL,
  `vaga` int(11) NOT NULL,
  `vagaatual` int(11) NOT NULL,
  `data` date NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `evento`
--

INSERT INTO `evento` (`codEvento`, `codTipo`, `codAnimal`, `codLocalizacao`, `ata`, `preco`, `vaga`, `vagaatual`, `data`, `descricao`, `ativo`) VALUES
(1, 1, 3, 1, '', 100, 10, 10, '2020-08-01', 'Caça ao Pombo na Herdade do Ricardo', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventoutilizador`
--

CREATE TABLE `eventoutilizador` (
  `codEvento` int(11) NOT NULL,
  `codUtilizador` int(11) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

CREATE TABLE `imagem` (
  `codImagem` int(11) NOT NULL,
  `codEvento` int(11) NOT NULL,
  `codUtilizador` int(11) NOT NULL,
  `imagem` varchar(200) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacao`
--

CREATE TABLE `localizacao` (
  `codLocalizacao` int(11) NOT NULL,
  `morada` varchar(50) NOT NULL,
  `mancha` varchar(10) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `localizacao`
--

INSERT INTO `localizacao` (`codLocalizacao`, `morada`, `mancha`, `ativo`) VALUES
(1, 'Herdade do Ricardo', 'A', b'1'),
(2, 'Herdade Cartuxa', 'B', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `portaevento`
--

CREATE TABLE `portaevento` (
  `codColocacao` int(11) NOT NULL,
  `codEvento` int(11) NOT NULL,
  `codUtilizador` int(11) NOT NULL,
  `porta` int(11) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `quota`
--

CREATE TABLE `quota` (
  `codQuota` int(11) NOT NULL,
  `codUtilizador` int(11) NOT NULL,
  `tipoQuota` int(11) NOT NULL,
  `dataVencimento` date NOT NULL,
  `estado` bit(1) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `quota`
--

INSERT INTO `quota` (`codQuota`, `codUtilizador`, `tipoQuota`, `dataVencimento`, `estado`, `ativo`) VALUES
(1, 1, 1, '2020-06-22', b'1', b'1'),
(2, 1, 1, '2020-07-11', b'1', b'1'),
(3, 2, 1, '2020-07-31', b'0', b'1'),
(4, 3, 1, '2020-08-31', b'0', b'1'),
(5, 1, 1, '2020-08-31', b'0', b'1'),
(6, 6, 1, '2020-08-31', b'0', b'1'),
(7, 5, 1, '2020-08-31', b'0', b'1'),
(8, 7, 1, '2020-08-31', b'0', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tesouraria`
--

CREATE TABLE `tesouraria` (
  `codConta` int(11) NOT NULL,
  `descricao` varchar(20) NOT NULL,
  `saldo` int(11) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tesouraria`
--

INSERT INTO `tesouraria` (`codConta`, `descricao`, `saldo`, `ativo`) VALUES
(1, 'Conta de Eventos', 5350, b'1'),
(2, 'Conta de Quotas', 100, b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoanimal`
--

CREATE TABLE `tipoanimal` (
  `codAnimal` int(11) NOT NULL,
  `especie` varchar(50) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipoanimal`
--

INSERT INTO `tipoanimal` (`codAnimal`, `especie`, `ativo`) VALUES
(1, 'Veado', b'1'),
(2, 'Javali', b'1'),
(3, 'Pombo', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoarma`
--

CREATE TABLE `tipoarma` (
  `codArma` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `especificacaoTiro` varchar(50) NOT NULL,
  `silenciador` bit(1) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipoarma`
--

INSERT INTO `tipoarma` (`codArma`, `descricao`, `especificacaoTiro`, `silenciador`, `ativo`) VALUES
(1, 'Arco', 'ns', b'0', b'1'),
(2, 'Carabina', 'semi-auto', b'0', b'1'),
(3, 'Carabina mk2', 'semi-auto', b'1', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoevento`
--

CREATE TABLE `tipoevento` (
  `codTipo` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipoevento`
--

INSERT INTO `tipoevento` (`codTipo`, `descricao`, `ativo`) VALUES
(1, 'Caça ao Pombo', b'1'),
(2, 'Caça ao Javali', b'1'),
(3, 'Caça ao Coelho', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoperfil`
--

CREATE TABLE `tipoperfil` (
  `codTipo` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipoperfil`
--

INSERT INTO `tipoperfil` (`codTipo`, `descricao`, `ativo`) VALUES
(1, 'Administrador', b'1'),
(2, 'Presidente', b'1'),
(3, 'Vice-Presidente', b'1'),
(4, 'Secretario', b'1'),
(5, 'Socio', b'1'),
(6, 'Por Validar', b'1'),
(7, 'Desativado', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoquota`
--

CREATE TABLE `tipoquota` (
  `codTipo` int(11) NOT NULL,
  `descricao` varchar(20) NOT NULL,
  `valor` int(11) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipoquota`
--

INSERT INTO `tipoquota` (`codTipo`, `descricao`, `valor`, `ativo`) VALUES
(1, 'iniciado', 100, b'1'),
(2, 'veterano', 85, b'1'),
(3, 'velha guarda', 40, b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacao`
--

CREATE TABLE `transacao` (
  `codTransacao` int(11) NOT NULL,
  `codConta` int(11) NOT NULL,
  `codCarteira` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `data` date NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `transacao`
--

INSERT INTO `transacao` (`codTransacao`, `codConta`, `codCarteira`, `valor`, `data`, `ativo`) VALUES
(1, 1, 1, 100, '2020-07-12', 1),
(2, 1, 1, 50, '2020-07-12', 1),
(3, 1, 1, 100, '2020-07-12', 1),
(4, 1, 1, 150, '2020-07-12', 1),
(5, 1, 1, 100, '2020-07-12', 1),
(6, 1, 1, 50, '2020-07-12', 1),
(7, 1, 1, 100, '2020-07-12', 1),
(8, 1, 1, 150, '2020-07-12', 1),
(9, 1, 1, 50, '2020-07-12', 1),
(10, 2, 1, 100, '2020-07-12', 1),
(11, 1, 3, 150, '2020-07-13', 1),
(12, 1, 3, 150, '2020-07-13', 1),
(13, 1, 3, 150, '2020-07-13', 1),
(14, 1, 3, 50, '2020-07-13', 1),
(15, 1, 3, 50, '2020-07-13', 1),
(16, 1, 3, 100, '2020-07-13', 1),
(17, 1, 3, 50, '2020-07-13', 1),
(18, 1, 3, 100, '2020-07-13', 1),
(19, 1, 1, 150, '2020-07-15', 1),
(20, 1, 1, 150, '2020-07-15', 1),
(21, 1, 1, 50, '2020-07-15', 1),
(22, 1, 2, 50, '2020-07-15', 1),
(23, 1, 2, 50, '2020-07-15', 1),
(24, 1, 2, 50, '2020-07-15', 1),
(25, 1, 2, 50, '2020-07-15', 1),
(26, 1, 2, 50, '2020-07-15', 1),
(27, 1, 2, 50, '2020-07-15', 1),
(28, 1, 2, 50, '2020-07-15', 1),
(29, 1, 2, 50, '2020-07-15', 1),
(30, 1, 2, 50, '2020-07-15', 1),
(31, 1, 2, 50, '2020-07-15', 1),
(32, 1, 2, 50, '2020-07-15', 1),
(33, 1, 2, 100, '2020-07-15', 1),
(34, 1, 2, 100, '2020-07-15', 1),
(35, 1, 2, 100, '2020-07-15', 1),
(36, 1, 2, 100, '2020-07-15', 1),
(37, 1, 2, 100, '2020-07-15', 1),
(38, 1, 1, 100, '2020-07-15', 1),
(39, 1, 1, 100, '2020-07-15', 1),
(40, 1, 2, 100, '2020-07-15', 1),
(41, 1, 2, 100, '2020-07-15', 1),
(42, 1, 2, 100, '2020-07-15', 1),
(43, 1, 1, 150, '2020-07-18', 1),
(44, 1, 1, 150, '2020-07-18', 1),
(45, 1, 1, 100, '2020-07-18', 1),
(46, 1, 1, 50, '2020-07-18', 1),
(47, 1, 1, 150, '2020-07-18', 1),
(48, 1, 1, 50, '2020-07-18', 1),
(49, 1, 1, 150, '2020-07-18', 1),
(50, 1, 1, 50, '2020-07-18', 1),
(51, 1, 1, 150, '2020-07-18', 1),
(52, 1, 1, 50, '2020-07-18', 1),
(53, 1, 1, 150, '2020-07-18', 1),
(54, 1, 1, 50, '2020-07-18', 1),
(55, 1, 1, 150, '2020-07-18', 1),
(56, 1, 1, 50, '2020-07-18', 1),
(57, 1, 1, 100, '2020-07-18', 1),
(59, 1, 1, 150, '2020-07-23', 1),
(60, 1, 1, 100, '2020-07-30', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadopresidente`
--

CREATE TABLE `utilizadopresidente` (
  `codUtilizador` int(11) NOT NULL,
  `codPresidente` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `utilizadopresidente`
--

INSERT INTO `utilizadopresidente` (`codUtilizador`, `codPresidente`, `dataInicio`, `dataFim`, `ativo`) VALUES
(3, 6, '2020-07-30', '0000-00-00', 1),
(5, 5, '2020-07-19', '0000-00-00', 1),
(5, 7, '2020-07-30', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `codUtilizador` int(11) NOT NULL,
  `codPerfil` int(11) NOT NULL,
  `codCarteira` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `apelido` varchar(30) NOT NULL,
  `morada` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nif` int(9) NOT NULL,
  `dataNascimento` date NOT NULL,
  `telemovel` int(11) NOT NULL,
  `numPorteArma` int(11) NOT NULL,
  `numApoliceSeguro` int(11) NOT NULL,
  `numLicencaCaca` int(11) NOT NULL,
  `limitacao` varchar(50) NOT NULL,
  `restricaoAlimentar` varchar(50) NOT NULL,
  `nomeUser` varchar(20) NOT NULL,
  `password` varchar(300) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`codUtilizador`, `codPerfil`, `codCarteira`, `nome`, `apelido`, `morada`, `email`, `nif`, `dataNascimento`, `telemovel`, `numPorteArma`, `numApoliceSeguro`, `numLicencaCaca`, `limitacao`, `restricaoAlimentar`, `nomeUser`, `password`, `ativo`) VALUES
(1, 5, 1, 'Ricardo', 'Trindade', 'Rua 2', 'rt@gmail.com', 500000001, '1990-01-04', 910000004, 600000001, 700000001, 800000001, 'sem limitações', 'sem restrições', 'socio', '1b1844daa452df42c6f9123857ca686c', b'1'),
(2, 4, 2, 'Antonio', 'Trindade', 'Rua V', 'at@gmail.com', 10000001, '2020-06-01', 2147483647, 500000009, 600000009, 700000009, 'sem limitações', 'sem restrições', 'secretario', '09ca0d5095609fe35bb7c9c7246e3cae', b'1'),
(3, 3, 3, 'Miguel', 'Trindade', 'Rua a', 'mt@gmail.com', 100000000, '1990-01-01', 910000000, 100000000, 100000000, 100000000, 'sem limitações', 'sem restrições', 'vice', '03f753c08ba5ff2bd7d2ee230b4683b1', b'1'),
(5, 2, 5, 'José', 'Trindade', 'Rua 1', 'jt@gmail.com', 981049587, '1990-02-02', 910000001, 403987502, 199948570, 19283751, 'sem limitações', 'sem restrições', 'presidente', '1c4708df8cb006d2a007b3920a7b92a5', b'1'),
(6, 1, 6, 'Artur', 'Trindade', 'Rua V', 'at@gmail.com', 918888309, '2020-07-01', 930002928, 106650000, 100958372, 109563990, 'sem limitações', 'sem restrições', 'admin', '21232f297a57a5a743894a0e4a801fc3', b'1'),
(7, 5, 7, 'Duarte', 'Trindade', 'Rua 1', 'rt@gmail.com', 200000000, '1990-01-01', 910000000, 2147483647, 400000000, 500000000, 'sem limitações', 'sem restrições', 'socio2', '6e9a4baa29210957845bcfbcee05595d', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `video`
--

CREATE TABLE `video` (
  `codVideo` int(11) NOT NULL,
  `codEvento` int(11) NOT NULL,
  `codUtilizador` int(11) NOT NULL,
  `video` varchar(200) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `armaevento`
--
ALTER TABLE `armaevento`
  ADD PRIMARY KEY (`codTipo`,`codArma`),
  ADD KEY `codArma` (`codArma`);

--
-- Índices para tabela `carteira`
--
ALTER TABLE `carteira`
  ADD PRIMARY KEY (`codCarteira`);

--
-- Índices para tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`codEvento`,`codAnimal`),
  ADD KEY `codTipo` (`codTipo`),
  ADD KEY `codAnimal` (`codAnimal`),
  ADD KEY `codLocalizacao` (`codLocalizacao`);

--
-- Índices para tabela `eventoutilizador`
--
ALTER TABLE `eventoutilizador`
  ADD PRIMARY KEY (`codEvento`,`codUtilizador`),
  ADD KEY `codUtilizador` (`codUtilizador`);

--
-- Índices para tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`codImagem`,`codEvento`),
  ADD KEY `codEvento` (`codEvento`);

--
-- Índices para tabela `localizacao`
--
ALTER TABLE `localizacao`
  ADD PRIMARY KEY (`codLocalizacao`);

--
-- Índices para tabela `portaevento`
--
ALTER TABLE `portaevento`
  ADD PRIMARY KEY (`codColocacao`),
  ADD KEY `codEvento` (`codEvento`),
  ADD KEY `codUtilizador` (`codUtilizador`);

--
-- Índices para tabela `quota`
--
ALTER TABLE `quota`
  ADD PRIMARY KEY (`codQuota`),
  ADD KEY `codUtilizador` (`codUtilizador`),
  ADD KEY `tipoQuota` (`tipoQuota`);

--
-- Índices para tabela `tesouraria`
--
ALTER TABLE `tesouraria`
  ADD PRIMARY KEY (`codConta`);

--
-- Índices para tabela `tipoanimal`
--
ALTER TABLE `tipoanimal`
  ADD PRIMARY KEY (`codAnimal`);

--
-- Índices para tabela `tipoarma`
--
ALTER TABLE `tipoarma`
  ADD PRIMARY KEY (`codArma`);

--
-- Índices para tabela `tipoevento`
--
ALTER TABLE `tipoevento`
  ADD PRIMARY KEY (`codTipo`);

--
-- Índices para tabela `tipoperfil`
--
ALTER TABLE `tipoperfil`
  ADD PRIMARY KEY (`codTipo`);

--
-- Índices para tabela `tipoquota`
--
ALTER TABLE `tipoquota`
  ADD PRIMARY KEY (`codTipo`);

--
-- Índices para tabela `transacao`
--
ALTER TABLE `transacao`
  ADD PRIMARY KEY (`codTransacao`),
  ADD KEY `codCarteira` (`codCarteira`),
  ADD KEY `codConta` (`codConta`);

--
-- Índices para tabela `utilizadopresidente`
--
ALTER TABLE `utilizadopresidente`
  ADD PRIMARY KEY (`codUtilizador`,`codPresidente`),
  ADD KEY `codPresidente` (`codPresidente`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`codUtilizador`),
  ADD KEY `codPerfil` (`codPerfil`),
  ADD KEY `codCarteira` (`codCarteira`);

--
-- Índices para tabela `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`codVideo`,`codEvento`),
  ADD KEY `codEvento` (`codEvento`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `armaevento`
--
ALTER TABLE `armaevento`
  ADD CONSTRAINT `armaevento_ibfk_1` FOREIGN KEY (`codTipo`) REFERENCES `tipoevento` (`codTipo`),
  ADD CONSTRAINT `armaevento_ibfk_2` FOREIGN KEY (`codArma`) REFERENCES `tipoarma` (`codArma`);

--
-- Limitadores para a tabela `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`codTipo`) REFERENCES `tipoevento` (`codTipo`),
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`codAnimal`) REFERENCES `tipoanimal` (`codAnimal`),
  ADD CONSTRAINT `evento_ibfk_3` FOREIGN KEY (`codLocalizacao`) REFERENCES `localizacao` (`codLocalizacao`);

--
-- Limitadores para a tabela `eventoutilizador`
--
ALTER TABLE `eventoutilizador`
  ADD CONSTRAINT `eventoutilizador_ibfk_1` FOREIGN KEY (`codUtilizador`) REFERENCES `utilizador` (`codUtilizador`),
  ADD CONSTRAINT `eventoutilizador_ibfk_2` FOREIGN KEY (`codUtilizador`) REFERENCES `utilizador` (`codUtilizador`);

--
-- Limitadores para a tabela `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `imagem_ibfk_1` FOREIGN KEY (`codEvento`) REFERENCES `evento` (`codEvento`);

--
-- Limitadores para a tabela `portaevento`
--
ALTER TABLE `portaevento`
  ADD CONSTRAINT `portaevento_ibfk_1` FOREIGN KEY (`codEvento`) REFERENCES `evento` (`codEvento`),
  ADD CONSTRAINT `portaevento_ibfk_2` FOREIGN KEY (`codUtilizador`) REFERENCES `utilizador` (`codUtilizador`);

--
-- Limitadores para a tabela `quota`
--
ALTER TABLE `quota`
  ADD CONSTRAINT `quota_ibfk_1` FOREIGN KEY (`codUtilizador`) REFERENCES `utilizador` (`codUtilizador`),
  ADD CONSTRAINT `quota_ibfk_2` FOREIGN KEY (`tipoQuota`) REFERENCES `tipoquota` (`codTipo`);

--
-- Limitadores para a tabela `transacao`
--
ALTER TABLE `transacao`
  ADD CONSTRAINT `transacao_ibfk_1` FOREIGN KEY (`codCarteira`) REFERENCES `carteira` (`codCarteira`),
  ADD CONSTRAINT `transacao_ibfk_2` FOREIGN KEY (`codConta`) REFERENCES `tesouraria` (`codConta`);

--
-- Limitadores para a tabela `utilizadopresidente`
--
ALTER TABLE `utilizadopresidente`
  ADD CONSTRAINT `utilizadopresidente_ibfk_1` FOREIGN KEY (`codPresidente`) REFERENCES `utilizador` (`codUtilizador`);

--
-- Limitadores para a tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD CONSTRAINT `utilizador_ibfk_1` FOREIGN KEY (`codPerfil`) REFERENCES `tipoperfil` (`codTipo`),
  ADD CONSTRAINT `utilizador_ibfk_2` FOREIGN KEY (`codCarteira`) REFERENCES `carteira` (`codCarteira`);

--
-- Limitadores para a tabela `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`codEvento`) REFERENCES `evento` (`codEvento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
