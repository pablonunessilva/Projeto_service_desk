-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 31-Mar-2019 às 16:58
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdesk2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamados`
--

CREATE TABLE `chamados` (
  `idchamado` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `setorcall` varchar(25) NOT NULL,
  `solicitacao` varchar(30) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `id_problema` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `data_resolvido` datetime NOT NULL,
  `id_prioridade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `chamados`
--

INSERT INTO `chamados` (`idchamado`, `idusuario`, `data`, `setorcall`, `solicitacao`, `descricao`, `id_problema`, `status`, `data_resolvido`, `id_prioridade`) VALUES
(61, 17, '2019-03-30 17:16:25', 'administrativo', 'master', 'nao sai tinta, esta fazendo muito barulho', 1, 'Pendente', '0000-00-00 00:00:00', 3),
(62, 17, '2019-03-30 23:36:30', 'administrativo', 'master', 'Minha internet nÃ£o abre nenhuma pagina jÃ¡ reiniciei o modem, mas nada faz ela voltar ', 3, 'Pendente', '0000-00-00 00:00:00', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `confirma`
--

CREATE TABLE `confirma` (
  `idchamado2` int(11) NOT NULL,
  `idconfirma` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prioridade`
--

CREATE TABLE `prioridade` (
  `id` int(11) NOT NULL,
  `prioridade_desc` varchar(30) CHARACTER SET utf8 NOT NULL,
  `sla` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Estrutura da tabela `respostas`
--

use helpdesk2;
CREATE table `respostas`(
	  `id` int auto_increment not null,
    `resposta` varchar(1000) not null,
    `idusuario` int not null,
    `data` varchar(10),
    `hora` varchar(8),
    PRIMARY KEY (id),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `prioridade`
--

INSERT INTO `prioridade` (`id`, `prioridade_desc`, `sla`) VALUES
(1, 'Critico', 12),
(2, 'Urgente', 24),
(3, 'Intermediário', 72),
(4, 'Básico', 96);

-- --------------------------------------------------------

--
-- Estrutura da tabela `respostas`
--

CREATE table `respostas`(
	  `id` int auto_increment not null,
    `resposta` varchar(1000) not null,
    `idusuario` int not null,
    `idchamado` int not null,
    `data` varchar(10),
    `hora` varchar(8),
    PRIMARY KEY (id),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------


--
-- Estrutura da tabela `tbl_problema`
--

CREATE TABLE `tbl_problema` (
  `id_problema` int(11) NOT NULL,
  `desc_problema` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_problema`
--

INSERT INTO `tbl_problema` (`id_problema`, `desc_problema`) VALUES
(1, 'Internet lenta'),
(2, 'Abrir site especifico'),
(3, 'Não abre site nenhum'),
(4, 'Mudança de enreço'),
(5, 'Mudança do local do roteado'),
(6, 'Outros');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `setor` varchar(40) NOT NULL,
  `datacadastro` datetime NOT NULL,
  `dados_status` varchar(10) NOT NULL,
  `data_exclusao` datetime NOT NULL,
  `primeira_vez` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `email`, `login`, `senha`, `setor`, `datacadastro`, `dados_status`, `data_exclusao`, `primeira_vez`) VALUES
(17, 'master', '', 'master', '202cb962ac59075b964b07152d234b70', 'administrativo', '2017-07-17 01:46:06', 'ativo', '0000-00-00 00:00:00', 0),
(18, 'Severino', 'severino@hotmail.com', 'severino', '202cb962ac59075b964b07152d234b70', 'RH', '2019-03-30 17:27:06', 'ativo', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chamados`
--
ALTER TABLE `chamados`
  ADD PRIMARY KEY (`idchamado`),
  ADD KEY `fk_usuario` (`idusuario`),
  ADD KEY `fk_prioridade` (`id_prioridade`),
  ADD KEY `fk_problema` (`id_problema`);

--
-- Indexes for table `confirma`
--
ALTER TABLE `confirma`
  ADD PRIMARY KEY (`idconfirma`);

--
-- Indexes for table `prioridade`
--
ALTER TABLE `prioridade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_problema`
--
ALTER TABLE `tbl_problema`
  ADD PRIMARY KEY (`id_problema`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chamados`
--
ALTER TABLE `chamados`
  MODIFY `idchamado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `confirma`
--
ALTER TABLE `confirma`
  MODIFY `idconfirma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `prioridade`
--
ALTER TABLE `prioridade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_problema`
--
ALTER TABLE `tbl_problema`
  MODIFY `id_problema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `chamados`
--
ALTER TABLE `chamados`
  ADD CONSTRAINT `fk_prioridade` FOREIGN KEY (`id_prioridade`) REFERENCES `prioridade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_problema` FOREIGN KEY (`id_problema`) REFERENCES `tbl_problema` (`id_problema`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
