USE db_odontologia;

DROP TABLE IF EXISTS `consulta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `consulta` WRITE;
/*!40000 ALTER TABLE `consulta` DISABLE KEYS */;
/*!40000 ALTER TABLE `consulta` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (26,'Jean Lucas Thierbach Panicio','1998-11-17','997294578','m','c','5211847','0948764584','Rua Lucianna Sammut Rosenthal, 137','Portão','81050-656','Curitiba','jose@gmail.com'),(27,'teste','2002-02-02','22222','f','s','22222','22222','rua teste 2','teste 2','222222','teste 2 ','222@hotmail.com'),(28,'teste 3','3333-03-03','333333','f','s','333333','3333333','rya 3333','3333','333333','333333','333@outlook.coom'),(34,'exemplo','1111-01-01','exemplo','m','s','exemplo','exemplo','exemplo','exemplo','exemplo','exemplo','exemplo'),(35,'testando','1111-01-01','testando','m','d','testando','testando','testando','testando','testando','testando','testando'),(36,'testando2','2222-02-02','testando2','f','c','testando2','testando2','testando2','testando2','testando2','testando2','testando2'),(37,'alo1','2222-02-02','alo1','f','s','alo1','alo1','alo1','alo1','alo1','alo1','alo1'),(38,'teste4','2222-02-02','teste4','f','s','teste4','teste4','teste4','teste4','teste4','teste4','teste4');
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `paciente_higiene_oral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `paciente_higiene_oral` WRITE;
/*!40000 ALTER TABLE `paciente_higiene_oral` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente_higiene_oral` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `paciente_historia_medica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `paciente_historia_medica` WRITE;
/*!40000 ALTER TABLE `paciente_historia_medica` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente_historia_medica` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `paciente_prontuario_odontologico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `paciente_prontuario_odontologico` WRITE;
/*!40000 ALTER TABLE `paciente_prontuario_odontologico` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente_prontuario_odontologico` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `prontuario_higiene_oral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prontuario_higiene_oral` (
  `idHigieneOral` int(11) NOT NULL AUTO_INCREMENT,
  `bochecho` enum('sim','nao') NOT NULL,
  `creme_dental` enum('nao costuma usar','uma vez por semana','uma vez por dia','mais de uma vez por dia','duas ou mais vezes por dia') NOT NULL,
  `palito` enum('sim','nao') NOT NULL,
  `higiene_lingua` enum('uma vez por dia','mais de uma vez por dia','duas vezes ou mais vezes por dia') NOT NULL,
  `fio_dental` enum('nao costumo usar','uma vez por semana','uma vez por dia','mais de uma vez por dia','duas ou mais vezes por dia') NOT NULL,
  `observacaoH0` varchar(500) NOT NULL,
  PRIMARY KEY (`idHigieneOral`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `prontuario_higiene_oral` WRITE;
/*!40000 ALTER TABLE `prontuario_higiene_oral` DISABLE KEYS */;
INSERT INTO `prontuario_higiene_oral` VALUES (3,'sim','nao costuma usar','sim','uma vez por dia','uma vez por dia','teste');
/*!40000 ALTER TABLE `prontuario_higiene_oral` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `prontuario_historia_medica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prontuario_historia_medica` (
  `idHistoriaMedica` int(11) NOT NULL AUTO_INCREMENT,
  `queixaPrincipal` varchar(500) NOT NULL,
  `historia_doenca_atual` varchar(500) NOT NULL,
  `historia_progressa` varchar(500) NOT NULL,
  `historia_familiar` varchar(500) NOT NULL,
  `historia_pessoal_social` varchar(500) NOT NULL,
  `observacaoHM` varchar(500) NOT NULL,
  PRIMARY KEY (`idHistoriaMedica`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `prontuario_historia_medica` WRITE;
/*!40000 ALTER TABLE `prontuario_historia_medica` DISABLE KEYS */;
INSERT INTO `prontuario_historia_medica` VALUES (2,'exemplo','exemplo','exemplo','exemplo','exemplo','exemplo'),(3,'alo','alo','alo','alo','alo','alo\r\n');
/*!40000 ALTER TABLE `prontuario_historia_medica` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `prontuario_odontologico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `prontuario_odontologico` WRITE;
/*!40000 ALTER TABLE `prontuario_odontologico` DISABLE KEYS */;
INSERT INTO `prontuario_odontologico` VALUES (1,'nao','nao','12','nao','sim','sim','nao','sim','Nenhuma.');
/*!40000 ALTER TABLE `prontuario_odontologico` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (7,'teste123','profissional','teste','2001-01-01','00000','m','s','00000','00000','teste','00000','teste','teste','teste@gmail.com','teste123'),(8,'senha123','profissional','Jean Lucas Thierbach Panicio','1998-11-17','997294578','m','c','00000','0948764584','Portão','81050-656','Curitiba','Rua Lucianna Sammut Rosenthal','jose@gmail.com','senha123'),(9,'teste123','coordenador','testando','1998-11-17','000000','f','d','0000000','0000000','teste','57498756','Curitiba','Rua engenheiro naldony niepce','teste@gmail.com','teste123'),(10,'teste123','coordenador','teste1','1111-01-01','1111111','m','s','1111111','1111111','teste','1111111111111','teste','teste','teste1@gmail.com','teste123'),(11,'teste3','coordenador','joao','0001-02-02','000000000','m','s','00000000','00000000','teste 3','000000000','teste 3','Rua teste 2','00000000','teste3');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
