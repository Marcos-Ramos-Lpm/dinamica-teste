/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : desafioteste

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 30/11/2021 13:17:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_historico_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tb_historico_usuario`;
CREATE TABLE `tb_historico_usuario`  (
  `id_historico_usuario` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `historico_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `data_registro` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_historico_usuario`) USING BTREE,
  INDEX `id_usuario`(`id_usuario`) USING BTREE,
  CONSTRAINT `tb_historico_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_historico_usuario
-- ----------------------------
INSERT INTO `tb_historico_usuario` VALUES (1, 1, 'O usuario , entrou online', '2021-11-30 11:01:29');
INSERT INTO `tb_historico_usuario` VALUES (2, 1, 'O usuario Marcos Ramos De Almeida, entrou online', '2021-11-30 11:01:45');
INSERT INTO `tb_historico_usuario` VALUES (3, 1, 'O usuario Marcos Ramos De Almeida, entrou online', '2021-11-30 11:09:45');
INSERT INTO `tb_historico_usuario` VALUES (4, 1, 'O usuario Marcos Ramos De Almeida, entrou online', '2021-11-30 12:01:47');

-- ----------------------------
-- Table structure for tb_modulo
-- ----------------------------
DROP TABLE IF EXISTS `tb_modulo`;
CREATE TABLE `tb_modulo`  (
  `id_modulo` int NOT NULL AUTO_INCREMENT,
  `id_situacao` int NULL DEFAULT NULL,
  `modulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `flg_submodulo` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_modulo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_modulo
-- ----------------------------
INSERT INTO `tb_modulo` VALUES (9, 1, 'Usuários', 'usuario', 'fa fa-user', 1);

-- ----------------------------
-- Table structure for tb_situacao
-- ----------------------------
DROP TABLE IF EXISTS `tb_situacao`;
CREATE TABLE `tb_situacao`  (
  `id_situacao` int NOT NULL AUTO_INCREMENT,
  `situacao` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_situacao`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_situacao
-- ----------------------------
INSERT INTO `tb_situacao` VALUES (1, 'Ativo');
INSERT INTO `tb_situacao` VALUES (2, 'Inativo');

-- ----------------------------
-- Table structure for tb_situacao_senha
-- ----------------------------
DROP TABLE IF EXISTS `tb_situacao_senha`;
CREATE TABLE `tb_situacao_senha`  (
  `id_situacao_senha` int NOT NULL AUTO_INCREMENT,
  `situacao_senha` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_situacao_senha`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_situacao_senha
-- ----------------------------
INSERT INTO `tb_situacao_senha` VALUES (1, 'Ativa');
INSERT INTO `tb_situacao_senha` VALUES (2, 'Temporaria');
INSERT INTO `tb_situacao_senha` VALUES (3, 'Bloqueada');

-- ----------------------------
-- Table structure for tb_submodulo
-- ----------------------------
DROP TABLE IF EXISTS `tb_submodulo`;
CREATE TABLE `tb_submodulo`  (
  `id_submodulo` int NOT NULL AUTO_INCREMENT,
  `id_modulo` int NULL DEFAULT NULL,
  `id_situacao` int NULL DEFAULT NULL,
  `submodulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `link_submodulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icone_submodulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_submodulo`) USING BTREE,
  INDEX `id_modulo`(`id_modulo`) USING BTREE,
  INDEX `id_situacao`(`id_situacao`) USING BTREE,
  INDEX `submodulo`(`submodulo`) USING BTREE,
  CONSTRAINT `tb_submodulo_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `tb_modulo` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_submodulo_ibfk_2` FOREIGN KEY (`id_situacao`) REFERENCES `tb_situacao` (`id_situacao`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_submodulo
-- ----------------------------
INSERT INTO `tb_submodulo` VALUES (1, 9, 1, 'Usuários', 'usuarios', 'fa fa-user');
INSERT INTO `tb_submodulo` VALUES (2, 9, 1, 'Add Usuário', 'adicionar-usuario', 'fa fa-plus');
INSERT INTO `tb_submodulo` VALUES (6, 9, 1, 'Histórico', 'historico', 'fa fa-cog');

-- ----------------------------
-- Table structure for tb_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE `tb_usuario`  (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `id_situacao` int NULL DEFAULT NULL,
  `nome_completo_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cpf_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_situacao_senha` int NULL DEFAULT NULL,
  `data_registro` datetime(0) NULL DEFAULT NULL,
  `data_alteracao` datetime(0) NULL DEFAULT NULL,
  `imagem` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  INDEX `id_situacao`(`id_situacao`) USING BTREE,
  INDEX `tb_usuario_ibfk_2`(`id_situacao_senha`) USING BTREE,
  CONSTRAINT `tb_usuario_ibfk_1` FOREIGN KEY (`id_situacao`) REFERENCES `tb_situacao` (`id_situacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_usuario_ibfk_2` FOREIGN KEY (`id_situacao_senha`) REFERENCES `tb_situacao_senha` (`id_situacao_senha`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_usuario
-- ----------------------------
INSERT INTO `tb_usuario` VALUES (1, 1, 'Marcos Ramos De Almeida', '02233676130', 'markoslpm@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, '2021-07-12 10:59:55', '2021-11-30 10:19:55', 'dfb91d3962f08b12d8834a12bf28c30e.jpg');
INSERT INTO `tb_usuario` VALUES (2, 1, 'Marcos Ramos', '02233676131', 'markoslpm123@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, '2021-07-12 12:41:01', NULL, 'dfb91d3962f08b12d8834a12bf28c30e.jpg');

-- ----------------------------
-- Table structure for tb_usuario_modulo
-- ----------------------------
DROP TABLE IF EXISTS `tb_usuario_modulo`;
CREATE TABLE `tb_usuario_modulo`  (
  `id_usuario_modulo` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NULL DEFAULT NULL,
  `id_modulo` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario_modulo`) USING BTREE,
  INDEX `tb_usuario_modulo_ibfk_1`(`id_usuario`) USING BTREE,
  INDEX `tb_usuario_modulo_ibfk_2`(`id_modulo`) USING BTREE,
  CONSTRAINT `tb_usuario_modulo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_usuario_modulo_ibfk_2` FOREIGN KEY (`id_modulo`) REFERENCES `tb_modulo` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_usuario_modulo
-- ----------------------------
INSERT INTO `tb_usuario_modulo` VALUES (36, 1, 9);

SET FOREIGN_KEY_CHECKS = 1;
