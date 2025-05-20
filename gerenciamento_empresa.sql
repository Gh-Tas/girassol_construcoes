-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para girassol_construcoes
DROP DATABASE IF EXISTS `girassol_construcoes`;
CREATE DATABASE IF NOT EXISTS `girassol_construcoes` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `girassol_construcoes`;

-- Copiando estrutura para tabela girassol_construcoes.categoria
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela girassol_construcoes.categoria: ~2 rows (aproximadamente)
INSERT INTO `categoria` (`id`, `nome_categoria`) VALUES
	(1, 'Materiais'),
	(2, 'Ferramentas'),
	(3, 'Acabamento');

-- Copiando estrutura para tabela girassol_construcoes.produtos
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_produto` int NOT NULL AUTO_INCREMENT,
  `nome_produto` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL DEFAULT '0.00',
  `descricao` text NOT NULL,
  `id_categoria` int NOT NULL DEFAULT '0',
  `quantidade` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_produto`),
  KEY `FK_produtos_categoria` (`id_categoria`) USING BTREE,
  CONSTRAINT `FK_produtos_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela girassol_construcoes.produtos: ~3 rows (aproximadamente)
INSERT INTO `produtos` (`id_produto`, `nome_produto`, `preco`, `descricao`, `id_categoria`, `quantidade`) VALUES
	(1, 'Cimento', 26.00, 'Cimento para construção civil', 1, 4),
	(2, 'Areia', 15.00, 'Areia fina para contrução', 1, 50),
	(3, 'Martelo', 10.00, 'Martelo de borracha', 2, 6);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
