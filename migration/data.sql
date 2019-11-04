CREATE SCHEMA IF NOT EXISTS db_odontologia;
USE db_odontologia;

DROP TABLE IF EXISTS `paciente`;
CREATE TABLE `paciente` (
  `idPaciente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data_nasc` date DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `sexo` enum('m','f') DEFAULT NULL,
  `estado_civil` enum('c','s','d') DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `cpf` varchar(20) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idPaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `prontuario_higiene_oral`;
CREATE TABLE `prontuario_higiene_oral` (
  `idHigieneOral` int(11) NOT NULL AUTO_INCREMENT,
  `bochecho` enum('sim','nao') NOT NULL,
  `creme_dental` enum('nao costuma usar','uma vez por semana','uma vez por dia','mais de uma vez por dia','duas ou mais vezes por dia') NOT NULL,
  `palito` enum('sim','nao') NOT NULL,
  `higiene_lingua` enum('uma vez por dia','mais de uma vez por dia','duas vezes ou mais vezes por dia') NOT NULL,
  `fio_dental` enum('nao costumo usar','uma vez por semana','uma vez por dia','mais de uma vez por dia','duas ou mais vezes por dia') NOT NULL,
  `observacaoH0` varchar(500) NOT NULL,
  PRIMARY KEY (`idHigieneOral`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `prontuario_historia_medica`;
CREATE TABLE `prontuario_historia_medica` (
  `idHistoriaMedica` int(11) NOT NULL AUTO_INCREMENT,
  `queixaPrincipal` varchar(500) NOT NULL,
  `historia_doenca_atual` varchar(500) NOT NULL,
  `historia_progressa` varchar(500) NOT NULL,
  `historia_familiar` varchar(500) NOT NULL,
  `historia_pessoal_social` varchar(500) NOT NULL,
  `observacaoHM` varchar(500) NOT NULL,
  PRIMARY KEY (`idHistoriaMedica`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `prontuario_odontologico`;
CREATE TABLE `prontuario_odontologico` (
  `idProntuarioOdontologico` int(11) NOT NULL AUTO_INCREMENT,
  `dificuldade_engolir_alimentos` enum('sim','nao') NOT NULL,
  `protese_dentadura` enum('sim','nao') NOT NULL,
  `quanto_tempo_perdeu_dentes` varchar(50) NOT NULL,
  `adaptado_protese` enum('sim','nao') NOT NULL,
  `dentes_sensiveis` enum('sim','nao') NOT NULL,
  `gengiva_sangra` enum('sim','nao') NOT NULL,
  `mau_halito` enum('sim','nao') NOT NULL,
  `toma_cafe_refrigerante` enum('sim','nao') NOT NULL,
  `observacaoPO` varchar(500) NOT NULL,
  PRIMARY KEY (`idProntuarioOdontologico`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `senha` varchar(30) NOT NULL,
  `tipoUsuario` enum('profissional','coordenador') NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nasc` date NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `sexo` enum('m','f') NOT NULL,
  `estado_civil` enum('c','s','d') NOT NULL,
  `rg` varchar(20) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `enderecoResidencial` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `confirmar_senha` varchar(30) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `consulta`;
CREATE TABLE `consulta` (
  `idConsulta` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idUsuario` int(11) NOT NULL,
  `fk_idPaciente` int(11) NOT NULL,
  PRIMARY KEY (`idConsulta`),
  KEY `fk_idUsuario` (`fk_idUsuario`),
  KEY `fk_idPaciente` (`fk_idPaciente`),
  CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`fk_idUsuario`) REFERENCES `usuario` (`idUsuario`),
  CONSTRAINT `consulta_ibfk_2` FOREIGN KEY (`fk_idPaciente`) REFERENCES `paciente` (`idPaciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `paciente_higiene_oral`;
CREATE TABLE `paciente_higiene_oral` (
  `idPacienteHigieneOral` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idUsuario` int(11) NOT NULL,
  `fk_idPaciente` int(11) NOT NULL,
  `fk_idConsulta` int(11) NOT NULL,
  `fk_idHigieneOral` int(11) NOT NULL,
  PRIMARY KEY (`idPacienteHigieneOral`),
  KEY `fk_idUsuario` (`fk_idUsuario`),
  KEY `fk_idPaciente` (`fk_idPaciente`),
  KEY `fk_idConsulta` (`fk_idConsulta`),
  KEY `fk_idHigieneOral` (`fk_idHigieneOral`),
  CONSTRAINT `paciente_higiene_oral_ibfk_1` FOREIGN KEY (`fk_idUsuario`) REFERENCES `usuario` (`idUsuario`),
  CONSTRAINT `paciente_higiene_oral_ibfk_2` FOREIGN KEY (`fk_idPaciente`) REFERENCES `paciente` (`idPaciente`),
  CONSTRAINT `paciente_higiene_oral_ibfk_3` FOREIGN KEY (`fk_idConsulta`) REFERENCES `consulta` (`idConsulta`),
  CONSTRAINT `paciente_higiene_oral_ibfk_4` FOREIGN KEY (`fk_idHigieneOral`) REFERENCES `prontuario_higiene_oral` (`idHigieneOral`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `paciente_historia_medica`;
CREATE TABLE `paciente_historia_medica` (
  `idPacienteHistoriaMedica` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idUsuario` int(11) NOT NULL,
  `fk_idPaciente` int(11) NOT NULL,
  `fk_idConsulta` int(11) NOT NULL,
  `fk_idHistoriaMedica` int(11) NOT NULL,
  PRIMARY KEY (`idPacienteHistoriaMedica`),
  KEY `fk_idUsuario` (`fk_idUsuario`),
  KEY `fk_idPaciente` (`fk_idPaciente`),
  KEY `fk_idConsulta` (`fk_idConsulta`),
  KEY `fk_idHistoriaMedica` (`fk_idHistoriaMedica`),
  CONSTRAINT `paciente_historia_medica_ibfk_1` FOREIGN KEY (`fk_idUsuario`) REFERENCES `usuario` (`idUsuario`),
  CONSTRAINT `paciente_historia_medica_ibfk_2` FOREIGN KEY (`fk_idPaciente`) REFERENCES `paciente` (`idPaciente`),
  CONSTRAINT `paciente_historia_medica_ibfk_3` FOREIGN KEY (`fk_idConsulta`) REFERENCES `consulta` (`idConsulta`),
  CONSTRAINT `paciente_historia_medica_ibfk_4` FOREIGN KEY (`fk_idHistoriaMedica`) REFERENCES `prontuario_historia_medica` (`idHistoriaMedica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `paciente_prontuario_odontologico`;
CREATE TABLE `paciente_prontuario_odontologico` (
  `idPacienteProntuarioOdontologico` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idUsuario` int(11) NOT NULL,
  `fk_idPaciente` int(11) NOT NULL,
  `fk_idConsulta` int(11) NOT NULL,
  `fk_idProntuarioOdontologico` int(11) NOT NULL,
  PRIMARY KEY (`idPacienteProntuarioOdontologico`),
  KEY `fk_idUsuario` (`fk_idUsuario`),
  KEY `fk_idPaciente` (`fk_idPaciente`),
  KEY `fk_idConsulta` (`fk_idConsulta`),
  KEY `fk_idProntuarioOdontologico` (`fk_idProntuarioOdontologico`),
  CONSTRAINT `paciente_prontuario_odontologico_ibfk_1` FOREIGN KEY (`fk_idUsuario`) REFERENCES `usuario` (`idUsuario`),
  CONSTRAINT `paciente_prontuario_odontologico_ibfk_2` FOREIGN KEY (`fk_idPaciente`) REFERENCES `paciente` (`idPaciente`),
  CONSTRAINT `paciente_prontuario_odontologico_ibfk_3` FOREIGN KEY (`fk_idConsulta`) REFERENCES `consulta` (`idConsulta`),
  CONSTRAINT `paciente_prontuario_odontologico_ibfk_4` FOREIGN KEY (`fk_idProntuarioOdontologico`) REFERENCES `prontuario_odontologico` (`idProntuarioOdontologico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
