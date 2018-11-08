/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : petline

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-11-08 16:36:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `agenda`
-- ----------------------------
DROP TABLE IF EXISTS `agenda`;
CREATE TABLE `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt_passeio` date NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  `descricao` text,
  `ativo` char(1) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `dt_alteracao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_agenda` (`id`),
  KEY `fk_id_usuario` (`id_usuario`),
  CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of agenda
-- ----------------------------
INSERT INTO `agenda` VALUES ('10', '2018-10-20', '08:00:00', '18:00:00', 'Estou disponível', '1', '3', '2018-10-25 13:23:17');
INSERT INTO `agenda` VALUES ('11', '2018-10-21', '08:00:00', '12:00:00', 'Estou disponível', '1', '3', '2018-10-25 13:23:49');
INSERT INTO `agenda` VALUES ('12', '2018-10-22', '12:00:00', '18:00:00', 'Estou disponível', '1', '3', '2018-10-25 13:24:03');
INSERT INTO `agenda` VALUES ('13', '2018-10-23', '15:00:00', '18:00:00', 'Esses são os meus dias disponíveis', '1', '3', '2018-10-25 13:24:16');
INSERT INTO `agenda` VALUES ('14', '2018-10-24', '16:00:00', '20:00:00', 'Disponível', '1', '3', '2018-10-25 13:24:36');
INSERT INTO `agenda` VALUES ('15', '2018-10-25', '17:00:00', '21:00:00', 'disponivel', '1', '3', '2018-10-25 13:24:54');
INSERT INTO `agenda` VALUES ('16', '2018-10-26', '08:00:00', '10:00:00', 'disponivel', '1', '3', '2018-10-25 13:25:15');
INSERT INTO `agenda` VALUES ('17', '2018-10-27', '11:00:00', '12:00:00', '', '1', '3', '2018-10-25 13:25:27');
INSERT INTO `agenda` VALUES ('23', '2018-10-28', '15:00:00', '16:00:00', '', '1', '3', '2018-10-25 14:25:33');
INSERT INTO `agenda` VALUES ('35', '2018-10-29', '18:00:00', '22:00:00', '', '1', '3', '2018-11-02 13:13:29');
INSERT INTO `agenda` VALUES ('36', '2018-10-30', '08:00:00', '18:00:00', 'estou livre', '1', '3', '2018-11-02 13:13:49');
INSERT INTO `agenda` VALUES ('37', '2018-10-31', '12:00:00', '18:00:00', '', '1', '3', '2018-11-02 13:14:02');
INSERT INTO `agenda` VALUES ('38', '2018-11-01', '12:00:00', '18:00:00', '', '1', '3', '2018-11-02 13:14:21');
INSERT INTO `agenda` VALUES ('39', '2018-11-02', '08:00:00', '12:00:00', '', '1', '3', '2018-11-02 13:14:44');

-- ----------------------------
-- Table structure for `conta`
-- ----------------------------
DROP TABLE IF EXISTS `conta`;
CREATE TABLE `conta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agencia` varchar(255) DEFAULT NULL,
  `tipo_conta` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `dt_alteracao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cartao` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_conta` (`id`),
  KEY `fk_id_usuario_4` (`id_usuario`),
  CONSTRAINT `fk_id_usuario_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conta
-- ----------------------------

-- ----------------------------
-- Table structure for `pacote`
-- ----------------------------
DROP TABLE IF EXISTS `pacote`;
CREATE TABLE `pacote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `quantidade_passeio` int(11) NOT NULL,
  `dt_passeio` date NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `dt_alteracao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ativo` char(1) DEFAULT NULL,
  `pet_pego` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pacote` (`id`),
  KEY `fk_id_usuario_2` (`id_usuario`),
  CONSTRAINT `fk_id_usuario_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pacote
-- ----------------------------
INSERT INTO `pacote` VALUES ('2', 'LINE_BASIC', '1', '2018-10-20', '07:18:00', '08:18:00', '2', '2018-11-07 12:59:28', '0', '0');
INSERT INTO `pacote` VALUES ('3', 'LINE_BASIC', '1', '2018-10-21', '05:05:00', '05:05:00', '2', '2018-11-07 13:00:59', '0', '0');
INSERT INTO `pacote` VALUES ('4', 'LINE_BASIC', '1', '2018-10-23', '10:00:00', '11:00:00', '2', '2018-11-07 13:04:19', '1', '1');
INSERT INTO `pacote` VALUES ('5', 'LINE_BASIC', '1', '2018-10-24', '10:00:00', '11:00:00', '2', '2018-11-07 13:34:22', '1', '1');
INSERT INTO `pacote` VALUES ('6', 'LINE_BASIC', '1', '2018-10-25', '10:00:00', '11:00:00', '2', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('7', 'LINE_BASIC', '1', '2018-10-26', '10:00:00', '11:00:00', '2', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('8', 'LINE_BASIC', '1', '2018-10-27', '10:00:00', '11:00:00', '2', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('9', 'LINE_BASIC', '1', '2018-10-28', '11:00:00', '12:00:00', '2', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('12', 'LINE_BASIC', '1', '2018-10-12', '15:09:00', '16:09:00', '8', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('13', 'LINE_BASIC', '1', '2018-10-12', '18:00:00', '20:00:00', '8', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('14', 'LINE_BASIC', '1', '2018-11-05', '05:05:00', '05:05:00', '8', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('15', 'RICH_DOG', '1', '2018-10-20', '10:10:00', '11:10:00', '7', '2018-11-07 12:59:28', '0', '0');
INSERT INTO `pacote` VALUES ('16', 'RICH_DOG', '1', '2018-10-21', '10:00:00', '11:00:00', '7', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('17', 'RICH_DOG', '1', '2018-10-22', '12:00:00', '13:00:00', '7', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('18', 'RICH_DOG', '1', '2018-10-23', '14:00:00', '15:00:00', '7', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('19', 'RICH_DOG', '1', '2018-10-24', '15:00:00', '16:00:00', '7', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('20', 'RICH_DOG', '1', '2018-10-25', '12:00:00', '13:00:00', '7', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('21', 'RICH_DOG', '1', '2018-10-26', '13:00:00', '14:00:00', '7', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('22', 'RICH_DOG', '1', '2018-10-27', '13:10:00', '13:50:00', '7', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('23', 'RICH_DOG', '1', '2018-10-28', '05:10:00', '06:00:00', '7', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('24', 'RICH_DOG', '1', '2018-10-29', '07:00:00', '08:00:00', '7', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('25', 'RICH_DOG', '1', '2018-10-30', '13:00:00', '14:00:00', '7', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('26', 'RICH_DOG', '1', '2018-11-01', '10:00:00', '10:30:00', '7', '2018-11-07 12:59:28', '1', '0');
INSERT INTO `pacote` VALUES ('27', 'LINE_BASIC', '1', '2018-11-06', '09:00:00', '10:00:00', '2', '2018-11-07 12:59:28', '1', '0');

-- ----------------------------
-- Table structure for `passeador`
-- ----------------------------
DROP TABLE IF EXISTS `passeador`;
CREATE TABLE `passeador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `login` varchar(25) DEFAULT NULL,
  `senha` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `cpf` varchar(25) NOT NULL,
  `descricao` text,
  `dt_nascimento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dt_alteracao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` int(11) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `uf` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of passeador
-- ----------------------------

-- ----------------------------
-- Table structure for `pesquisa`
-- ----------------------------
DROP TABLE IF EXISTS `pesquisa`;
CREATE TABLE `pesquisa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_passeador` int(11) DEFAULT NULL,
  `pergunta` varchar(255) DEFAULT NULL,
  `nota` varchar(20) NOT NULL,
  `dt_alteracao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_passeio` (`id_passeador`),
  KEY `idx_pesquisa` (`id`),
  CONSTRAINT `fk_passeio` FOREIGN KEY (`id_passeador`) REFERENCES `passeador` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pesquisa
-- ----------------------------

-- ----------------------------
-- Table structure for `pet`
-- ----------------------------
DROP TABLE IF EXISTS `pet`;
CREATE TABLE `pet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `raca` varchar(255) NOT NULL,
  `peso` varchar(25) NOT NULL,
  `cor` varchar(25) NOT NULL,
  `dt_nascimento` date NOT NULL DEFAULT '0000-00-00',
  `dt_alteracao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `descricao` text,
  `id_usuario` int(11) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pet` (`id`),
  KEY `fk_id_usuario_3` (`id_usuario`),
  CONSTRAINT `fk_id_usuario_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pet
-- ----------------------------
INSERT INTO `pet` VALUES ('1', 'Dick 2', 'Labrador 3', '15', 'Preto e branco', '2018-10-16', '2018-10-16 13:42:02', 'Ele é um cachorro e bonito', '1', '1');
INSERT INTO `pet` VALUES ('2', 'Dick Vigarista', 'Labrador', '50', 'Preto e branco', '2015-10-10', '2018-10-15 14:05:14', 'Ele é um cachorro', '1', '1');
INSERT INTO `pet` VALUES ('4', 'Nina', 'vira-lata', '12', 'preta', '2018-10-15', '2018-10-16 13:36:20', 'É uma cachorro linda', '2', '1');
INSERT INTO `pet` VALUES ('5', 'Nina', 'poodle', '15', 'preta', '2018-10-15', '2018-11-02 16:01:47', 'Cachorra', '2', '0');
INSERT INTO `pet` VALUES ('6', 'Nina', 'vira-lata', '12', 'branco', '0000-00-00', '2018-10-25 19:35:21', 'Nina é linda', '8', '1');
INSERT INTO `pet` VALUES ('8', 'Lindinho', 'Sem Raca Definida', '80', 'Preto', '0000-00-00', '2018-11-02 12:26:16', 'Ele é muito brabo', '1', '1');
INSERT INTO `pet` VALUES ('9', 'Branquinha', 'Sem Raca Definida', '10', 'Branco', '2015-01-01', '2018-11-02 12:56:36', 'Ela é bem mansa', '1', '1');
INSERT INTO `pet` VALUES ('10', 'Peludinho', 'Afegao Hound', '20', 'Amarelo', '2012-12-12', '2018-11-02 16:02:02', 'É lindo', '2', '0');
INSERT INTO `pet` VALUES ('11', 'Mel', 'ShihTzu', '10', 'Preto', '2018-02-01', '2018-11-02 13:12:06', 'É linda', '7', '1');

-- ----------------------------
-- Table structure for `servico`
-- ----------------------------
DROP TABLE IF EXISTS `servico`;
CREATE TABLE `servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_passeador` int(11) NOT NULL,
  `id_pacote` int(11) NOT NULL,
  `id_pet` int(11) NOT NULL,
  `id_agenda` int(11) DEFAULT NULL,
  `dt_alteracao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_cliente` int(11) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  `valor_pacote` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_usuario_5` (`id_passeador`),
  KEY `fk_id_pacote` (`id_pacote`),
  KEY `fk_id_pet` (`id_pet`),
  KEY `fk_id_agenda` (`id_agenda`),
  KEY `fk_id_usuario_6` (`id_cliente`),
  CONSTRAINT `fk_id_agenda` FOREIGN KEY (`id_agenda`) REFERENCES `agenda` (`id`),
  CONSTRAINT `fk_id_pacote` FOREIGN KEY (`id_pacote`) REFERENCES `pacote` (`id`),
  CONSTRAINT `fk_id_pet` FOREIGN KEY (`id_pet`) REFERENCES `pet` (`id`),
  CONSTRAINT `fk_id_usuario_5` FOREIGN KEY (`id_passeador`) REFERENCES `usuario` (`id`),
  CONSTRAINT `fk_id_usuario_6` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of servico
-- ----------------------------
INSERT INTO `servico` VALUES ('1', '3', '2', '4', null, '2018-11-07 12:54:14', '2', '0', '0');
INSERT INTO `servico` VALUES ('2', '3', '2', '5', null, '2018-11-07 12:54:14', '2', '0', '0');
INSERT INTO `servico` VALUES ('3', '3', '2', '4', null, '2018-11-07 12:54:14', '2', '1', '0');
INSERT INTO `servico` VALUES ('4', '3', '2', '4', null, '2018-11-07 12:54:14', '2', '1', '0');
INSERT INTO `servico` VALUES ('5', '3', '2', '4', null, '2018-11-07 12:54:14', '2', '1', '0');
INSERT INTO `servico` VALUES ('6', '3', '2', '10', null, '2018-11-07 12:54:14', '2', '0', '0');
INSERT INTO `servico` VALUES ('7', '3', '15', '11', null, '2018-11-07 12:54:14', '7', '0', '0');
INSERT INTO `servico` VALUES ('8', '3', '15', '11', null, '2018-11-07 12:54:14', '7', '0', '0');
INSERT INTO `servico` VALUES ('11', '3', '15', '11', null, '2018-11-07 12:54:14', '7', '0', '0');

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `login` varchar(25) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `cpf` varchar(25) NOT NULL,
  `uf` char(2) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `dt_nascimento` date NOT NULL,
  `descricao` text,
  `perfil` char(3) NOT NULL,
  `ativo` int(11) DEFAULT NULL,
  `dt_alteracao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `login` (`login`),
  KEY `idx_cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'Administrador', 'Petline', 'admin', '23d42f5f3f66498b2c8ff4c20b8c5ac826e47146', 'administrador@petline.com', '(00) 00000-0', '00000000', '000000000', 'DF', '72745-011', 'Brasília', 'Quadra 45 Conjunto K', 'Vila São José (Brazlândia)', '2018-10-09', '', 'adm', '1', '2018-09-13 20:31:02');
INSERT INTO `usuario` VALUES ('2', 'Cliente', 'Petline', 'cliente', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'cliente@petline.com', '(61) 99356-4879', '19.878.131-6', '635.460.591-23', 'MG', '30510-410', 'Belo Horizonte', 'Rua Azaléia', 'Nova Gameleira', '2018-10-16', '', 'cli', '1', '2018-10-18 11:30:04');
INSERT INTO `usuario` VALUES ('3', 'Passeador', 'Petline', 'passeador', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'passeador@passeador.com', '(61) 93265-9898', '16.589.876', '171.418.723-37', 'RJ', '23575-385', 'Rio de Janeiro', 'Travessa Dom Diniz', 'Santa Cruz', '2018-10-09', '', 'pas', '1', '2018-10-18 11:29:24');
INSERT INTO `usuario` VALUES ('4', 'Rafael', 'Souza', 'rafael', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'rafael@gmail.com', '(65) 49846-5168', '21.498.465-1', '726.491.981-17', 'GO', '72855-239', 'Luziânia', 'Quadra 239', 'Parque Industrial Mingone', '2018-10-04', '', 'cli', '1', '2018-11-05 14:32:51');
INSERT INTO `usuario` VALUES ('5', 'Rafael', 'Rodrigues', 'rafael1', '1f49d78abdcbe13fcf991ec4a4ee60fcdf8b7f4b', 'rafael2@gmail.com', '(44) 44444-4444', '65.198.465-1', '426.187.374-58', 'DF', '72738-000', 'Brasília', 'Quadra 38', 'Vila São José (Brazlândia)', '2018-10-11', 'Onde quer que você esteja, você sempre estará lá!!!!!', 'pas', '1', '2018-09-20 13:59:05');
INSERT INTO `usuario` VALUES ('6', 'Evaldo', 'Junior', 'evaldo', '3e2fc5e632b74c065a9a5efa054acacd7b14475c', 'evaldo@gmail.com', '(61) 32132-1321', '11.111.284-8', '000.000.000-00', 'DF', '72745-011', 'Brasília', 'Quadra 45 Conjunto K', 'Vila São José (Brazlândia)', '2018-10-09', 'Sou passeador e gosto de passear com cães', 'pas', '1', '2018-09-20 19:25:32');
INSERT INTO `usuario` VALUES ('7', 'Anderson', 'Rodrigues', 'anderson1', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'andersonrodrigues209@gmail.com', '(61) 99332-4195', '16.546.848-6', '057.799.111-69', 'DF', '72745-011', 'Brasília', 'Quadra 45 Conjunto K', 'Vila São José (Brazlândia)', '1996-11-17', '', 'cli', '1', '2018-11-06 12:52:08');
INSERT INTO `usuario` VALUES ('8', 'Gislane', 'Santana', 'gislane', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'santana1204@gmail.com', '(61) 99999-9999', '11.111.111-1', '830.002.402-68', '..', '72745-011', '...', '...', '...', '0000-00-00', '', 'cli', '1', '2018-10-25 19:30:51');
INSERT INTO `usuario` VALUES ('9', 'Sarah', 'Guedes', 'sarahlinda', 'e94ddd1dc4bee199d0a5452ef42ff4205dbbc9ea', 'sarah@gmail.com', '(61) 95651-6849', '2151551', '629.353.633-96', 'DF', '72738-000', 'Brasília', 'Quadra 38', 'Vila São José (Brazlândia)', '2018-01-01', 'A Sarah é MUITO feia!', 'pas', '1', '2018-11-01 22:26:51');

-- ----------------------------
-- Function structure for `fcRetornaValorPacote`
-- ----------------------------
DROP FUNCTION IF EXISTS `fcRetornaValorPacote`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `fcRetornaValorPacote`(pIdUsuario INT) RETURNS varchar(9) CHARSET utf8
BEGIN

DECLARE vPacote VARCHAR(255);
DECLARE vValor VARCHAR(255);

SET vPacote = (
	SELECT
		nome
	FROM pacote
	WHERE
		id_usuario = pIdUsuario
	AND ativo = 1
	GROUP BY nome
	);

IF (vPacote IS NOT NULL) THEN
		IF (vPacote = 'LINE_BASIC') THEN SET vValor = 'R$ 339,72';
				ELSE 
						IF (vPacote = 'RICH_DOG') THEN SET vValor = 'R$ 482,76';
				ELSE
						SET vValor = 'R$ 835,89';
		END IF;
		END IF;
ELSE
		SET vValor = 'R$ 0,00';
END IF;
	RETURN vValor;
END
;;
DELIMITER ;
