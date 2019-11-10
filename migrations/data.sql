DROP SCHEMA IF EXISTS db_odontologia;
CREATE SCHEMA IF NOT EXISTS db_odontologia;
USE db_odontologia;

/* Patient */
DROP TABLE IF EXISTS `paciente`;
CREATE TABLE `paciente` (
  `idPaciente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data_nasc` date DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `sexo` enum('m', 'f') DEFAULT NULL,
  `estado_civil` enum('c', 's', 'd') DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `cpf` varchar(20) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idPaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

/* Medical records */
DROP TABLE IF EXISTS `prontuario_higiene_oral`;
CREATE TABLE `prontuario_higiene_oral` (
  `idProntuarioHigieneOral` int(11) NOT NULL AUTO_INCREMENT,
  `bochecho` enum('sim', 'nao') NOT NULL,
  `creme_dental` enum('nao costuma usar', 'uma vez por semana', 'uma vez por dia', 'mais de uma vez por dia', 'duas ou mais vezes por dia') NOT NULL,
  `palito` enum('sim', 'nao') NOT NULL,
  `higiene_lingua` enum('uma vez por dia', 'mais de uma vez por dia', 'duas vezes ou mais vezes por dia') NOT NULL,
  `fio_dental` enum('nao costumo usar', 'uma vez por semana', 'uma vez por dia', 'mais de uma vez por dia', 'duas ou mais vezes por dia') NOT NULL,
  `observacao` TEXT NOT NULL,
  PRIMARY KEY (`idProntuarioHigieneOral`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `prontuario_historia_medica`;
CREATE TABLE `prontuario_historia_medica` (
  `idProntuarioHistoriaMedica` int(11) NOT NULL AUTO_INCREMENT,
  `queixa_principal` TEXT NOT NULL,
  `historia_doenca_atual` TEXT NOT NULL,
  `historia_progressa` TEXT NOT NULL,
  `historia_familiar` TEXT NOT NULL,
  `historia_pessoal_social` TEXT NOT NULL,
  `observacao` TEXT NOT NULL,
  PRIMARY KEY (`idProntuarioHistoriaMedica`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `prontuario_odontologico`;
CREATE TABLE `prontuario_odontologico` (
  `idProntuarioOdontologico` int(11) NOT NULL AUTO_INCREMENT,
  `dificuldade_engolir_alimentos` enum('sim', 'nao') NOT NULL,
  `protese_dentadura` enum('sim', 'nao') NOT NULL,
  `quanto_tempo_perdeu_dentes` varchar(50) NOT NULL,
  `adaptado_protese` enum('sim', 'nao') NOT NULL,
  `dentes_sensiveis` enum('sim', 'nao') NOT NULL,
  `gengiva_sangra` enum('sim', 'nao') NOT NULL,
  `mau_halito` enum('sim', 'nao') NOT NULL,
  `toma_cafe_refrigerante` enum('sim', 'nao') NOT NULL,
  `observacao` TEXT NOT NULL,
  PRIMARY KEY (`idProntuarioOdontologico`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

/* User */
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `senha` varchar(30) NOT NULL,
  `tipoUsuario` enum('profissional', 'coordenador') NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nasc` date NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `sexo` enum('m', 'f') NOT NULL,
  `estado_civil` enum('c', 's', 'd') NOT NULL,
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

/* Appointment */
DROP TABLE IF EXISTS `consulta`;
CREATE TABLE `consulta` (
  `idConsulta` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idUsuario` int(11) NOT NULL,
  `fk_idPaciente` int(11) NOT NULL,
  `observacao` TEXT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `created_at` DATETIME DEFAULT current_timestamp,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`idConsulta`),
  FOREIGN KEY (`fk_idUsuario`) REFERENCES `usuario` (`idUsuario`),
  FOREIGN KEY (`fk_idPaciente`) REFERENCES `paciente` (`idPaciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Relationship pacient with medical records */
DROP TABLE IF EXISTS `paciente_prontuario_higiene_oral`;
CREATE TABLE `paciente_prontuario_higiene_oral` (
  `idPacienteHigieneOral` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idUsuario` int(11) NOT NULL,
  `fk_idPaciente` int(11) NOT NULL,
  `fk_idConsulta` int(11) NULL,
  `fk_idProntuarioHigieneOral` int(11) NOT NULL,
  PRIMARY KEY (`idPacienteHigieneOral`),
  FOREIGN KEY (`fk_idUsuario`) REFERENCES `usuario` (`idUsuario`),
  FOREIGN KEY (`fk_idPaciente`) REFERENCES `paciente` (`idPaciente`),
  FOREIGN KEY (`fk_idProntuarioHigieneOral`) REFERENCES `prontuario_higiene_oral` (`idProntuarioHigieneOral`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `paciente_prontuario_historia_medica`;
CREATE TABLE `paciente_prontuario_historia_medica` (
  `idPacienteHistoriaMedica` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idUsuario` int(11) NOT NULL,
  `fk_idPaciente` int(11) NOT NULL,
  `fk_idConsulta` int(11) NULL,
  `fk_idProntuarioHistoriaMedica` int(11) NOT NULL,
  PRIMARY KEY (`idPacienteHistoriaMedica`),
  FOREIGN KEY (`fk_idUsuario`) REFERENCES `usuario` (`idUsuario`),
  FOREIGN KEY (`fk_idPaciente`) REFERENCES `paciente` (`idPaciente`),
  FOREIGN KEY (`fk_idProntuarioHistoriaMedica`) REFERENCES `prontuario_historia_medica` (`idProntuarioHistoriaMedica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `paciente_prontuario_odontologico`;
CREATE TABLE `paciente_prontuario_odontologico` (
  `idPacienteProntuarioOdontologico` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idUsuario` int(11) NOT NULL,
  `fk_idPaciente` int(11) NOT NULL,
  `fk_idConsulta` int(11) NULL,
  `fk_idProntuarioOdontologico` int(11) NOT NULL,
  PRIMARY KEY (`idPacienteProntuarioOdontologico`),
  FOREIGN KEY (`fk_idUsuario`) REFERENCES `usuario` (`idUsuario`),
  FOREIGN KEY (`fk_idPaciente`) REFERENCES `paciente` (`idPaciente`),
  FOREIGN KEY (`fk_idProntuarioOdontologico`) REFERENCES `prontuario_odontologico` (`idProntuarioOdontologico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
