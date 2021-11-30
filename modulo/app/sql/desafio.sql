/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100420
 Source Host           : localhost:3306
 Source Schema         : aequilibrio_pesquisa

 Target Server Type    : MySQL
 Target Server Version : 100420
 File Encoding         : 65001

 Date: 23/08/2021 12:26:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_entrevista_resposta
-- ----------------------------
DROP TABLE IF EXISTS `tb_entrevista_resposta`;
CREATE TABLE `tb_entrevista_resposta`  (
  `id_entrevista_resposta` int(11) NOT NULL AUTO_INCREMENT,
  `id_pergunta` int(11) NULL DEFAULT NULL,
  `resposta` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `id_entrevistado` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_entrevista_resposta`) USING BTREE,
  INDEX `tb_entrevista_resposta_ibfk_1`(`id_pergunta`) USING BTREE,
  INDEX `id_entrevistado`(`id_entrevistado`) USING BTREE,
  CONSTRAINT `tb_entrevista_resposta_ibfk_1` FOREIGN KEY (`id_pergunta`) REFERENCES `tb_pergunta` (`id_pergunta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_entrevista_resposta_ibfk_2` FOREIGN KEY (`id_entrevistado`) REFERENCES `tb_entrevistado` (`id_entrevistrado`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_entrevista_resposta
-- ----------------------------
INSERT INTO `tb_entrevista_resposta` VALUES (31, 307, 'Marcos ramos de almeida', 4);
INSERT INTO `tb_entrevista_resposta` VALUES (32, 308, '32', 4);
INSERT INTO `tb_entrevista_resposta` VALUES (33, 309, 'rua nova denise', 4);
INSERT INTO `tb_entrevista_resposta` VALUES (34, 309, 'rua nova denise, 27', 4);
INSERT INTO `tb_entrevista_resposta` VALUES (35, 310, 'masculino', 4);
INSERT INTO `tb_entrevista_resposta` VALUES (36, 311, 'adidas', 4);
INSERT INTO `tb_entrevista_resposta` VALUES (37, 311, 'nike', 4);

-- ----------------------------
-- Table structure for tb_entrevistado
-- ----------------------------
DROP TABLE IF EXISTS `tb_entrevistado`;
CREATE TABLE `tb_entrevistado`  (
  `id_entrevistrado` int(11) NOT NULL AUTO_INCREMENT,
  `data_registro` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_entrevistrado`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_entrevistado
-- ----------------------------
INSERT INTO `tb_entrevistado` VALUES (4, '2021-08-22 19:26:48');

-- ----------------------------
-- Table structure for tb_modulo
-- ----------------------------
DROP TABLE IF EXISTS `tb_modulo`;
CREATE TABLE `tb_modulo`  (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `id_situacao` int(11) NULL DEFAULT NULL,
  `modulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `flg_submodulo` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_modulo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_modulo
-- ----------------------------
INSERT INTO `tb_modulo` VALUES (9, 1, 'Usuários', 'usuario', 'fa fa-user', 1);
INSERT INTO `tb_modulo` VALUES (10, 1, 'Pesquisa', 'pesquisa', 'fa fa-folder-open', 1);
INSERT INTO `tb_modulo` VALUES (11, 1, 'Ultimas entrevistas', 'entrevistado/entrevistados', 'fa fa-users', 2);
INSERT INTO `tb_modulo` VALUES (12, 1, 'Entrevista', 'entrevista/entrevistas', 'fa fa-file-text', 2);

-- ----------------------------
-- Table structure for tb_pergunta
-- ----------------------------
DROP TABLE IF EXISTS `tb_pergunta`;
CREATE TABLE `tb_pergunta`  (
  `id_pergunta` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesquisa` int(11) NULL DEFAULT NULL,
  `titulo_pergunta` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `imagem_pergunta` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `tipo_resposta` int(11) NULL DEFAULT NULL,
  `id_situacao` int(11) NULL DEFAULT NULL,
  `data_registro` datetime(0) NULL DEFAULT NULL,
  `data_alteracao` datetime(0) NULL DEFAULT NULL,
  `ordem` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pergunta`) USING BTREE,
  INDEX `tb_pergunta_ibfk_1`(`id_pesquisa`) USING BTREE,
  INDEX `tb_pergunta_ibfk_2`(`id_situacao`) USING BTREE,
  CONSTRAINT `tb_pergunta_ibfk_1` FOREIGN KEY (`id_pesquisa`) REFERENCES `tb_pesquisa` (`id_pesquisa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_pergunta_ibfk_2` FOREIGN KEY (`id_situacao`) REFERENCES `tb_situacao` (`id_situacao`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 312 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pergunta
-- ----------------------------
INSERT INTO `tb_pergunta` VALUES (307, 85, 'Nome completo', NULL, 1, 1, '2021-08-22 15:27:49', NULL, 10);
INSERT INTO `tb_pergunta` VALUES (308, 85, 'idade', NULL, 1, 1, '2021-08-22 15:27:49', NULL, 9);
INSERT INTO `tb_pergunta` VALUES (309, 85, 'endereco', NULL, 1, 1, '2021-08-22 15:27:49', NULL, 8);
INSERT INTO `tb_pergunta` VALUES (310, 85, 'sexo', NULL, 3, 1, '2021-08-22 15:27:49', NULL, 7);
INSERT INTO `tb_pergunta` VALUES (311, 85, 'escolha 2 marcas de produtos', NULL, 4, 1, '2021-08-22 15:27:49', NULL, 6);

-- ----------------------------
-- Table structure for tb_pergunta_opcao
-- ----------------------------
DROP TABLE IF EXISTS `tb_pergunta_opcao`;
CREATE TABLE `tb_pergunta_opcao`  (
  `id_pergunta_opcao` int(11) NOT NULL AUTO_INCREMENT,
  `id_pergunta` int(11) NULL DEFAULT NULL,
  `pergunta_opcao` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `id_situacao` int(11) NULL DEFAULT NULL,
  `data_registro` datetime(0) NULL DEFAULT NULL,
  `data_alteracao` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pergunta_opcao`) USING BTREE,
  INDEX `tb_pergunta_opcao_ibfk_2`(`id_situacao`) USING BTREE,
  INDEX `tb_pergunta_opcao_ibfk_3`(`id_pergunta`) USING BTREE,
  CONSTRAINT `tb_pergunta_opcao_ibfk_2` FOREIGN KEY (`id_situacao`) REFERENCES `tb_situacao` (`id_situacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_pergunta_opcao_ibfk_3` FOREIGN KEY (`id_pergunta`) REFERENCES `tb_pergunta` (`id_pergunta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 358 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pergunta_opcao
-- ----------------------------
INSERT INTO `tb_pergunta_opcao` VALUES (352, 310, 'masculino', 1, '2021-08-22 15:27:49', NULL);
INSERT INTO `tb_pergunta_opcao` VALUES (353, 310, 'feminino', 1, '2021-08-22 15:27:49', NULL);
INSERT INTO `tb_pergunta_opcao` VALUES (354, 310, 'nao responder', 1, '2021-08-22 15:27:49', NULL);
INSERT INTO `tb_pergunta_opcao` VALUES (355, 311, 'adidas', 1, '2021-08-22 15:27:49', NULL);
INSERT INTO `tb_pergunta_opcao` VALUES (356, 311, 'nike', 1, '2021-08-22 15:27:49', NULL);
INSERT INTO `tb_pergunta_opcao` VALUES (357, 311, 'topper', 1, '2021-08-22 15:27:49', NULL);

-- ----------------------------
-- Table structure for tb_pesquisa
-- ----------------------------
DROP TABLE IF EXISTS `tb_pesquisa`;
CREATE TABLE `tb_pesquisa`  (
  `id_pesquisa` int(11) NOT NULL AUTO_INCREMENT,
  `pesquisa` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `id_situacao` int(11) NULL DEFAULT NULL,
  `data_registro` datetime(0) NULL DEFAULT NULL,
  `data_alteracao` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pesquisa`) USING BTREE,
  INDEX `tb_pesquisa_ibfk_1`(`id_situacao`) USING BTREE,
  CONSTRAINT `tb_pesquisa_ibfk_1` FOREIGN KEY (`id_situacao`) REFERENCES `tb_situacao` (`id_situacao`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 86 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pesquisa
-- ----------------------------
INSERT INTO `tb_pesquisa` VALUES (85, 'dias dos pais', 1, '2021-08-22 14:56:33', '2021-08-22 15:27:49');

-- ----------------------------
-- Table structure for tb_situacao
-- ----------------------------
DROP TABLE IF EXISTS `tb_situacao`;
CREATE TABLE `tb_situacao`  (
  `id_situacao` int(11) NOT NULL AUTO_INCREMENT,
  `situacao` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_situacao`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
  `id_situacao_senha` int(11) NOT NULL AUTO_INCREMENT,
  `situacao_senha` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_situacao_senha`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

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
  `id_submodulo` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NULL DEFAULT NULL,
  `id_situacao` int(11) NULL DEFAULT NULL,
  `submodulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `link_submodulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icone_submodulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_submodulo`) USING BTREE,
  INDEX `id_modulo`(`id_modulo`) USING BTREE,
  INDEX `id_situacao`(`id_situacao`) USING BTREE,
  INDEX `submodulo`(`submodulo`) USING BTREE,
  CONSTRAINT `tb_submodulo_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `tb_modulo` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_submodulo_ibfk_2` FOREIGN KEY (`id_situacao`) REFERENCES `tb_situacao` (`id_situacao`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_submodulo
-- ----------------------------
INSERT INTO `tb_submodulo` VALUES (1, 9, 1, 'Usuários', 'usuarios', 'fa fa-user');
INSERT INTO `tb_submodulo` VALUES (2, 9, 1, 'Add Usuário', 'adicionar-usuario', 'fa fa-plus');
INSERT INTO `tb_submodulo` VALUES (3, 10, 1, 'Pesquisa', 'pesquisas', 'fa fa-folder-open');
INSERT INTO `tb_submodulo` VALUES (4, 10, 1, 'Add Pesquisa', 'adicionar-pesquisa', 'fa fa-plus');

-- ----------------------------
-- Table structure for tb_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE `tb_usuario`  (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_situacao` int(11) NULL DEFAULT NULL,
  `nome_completo_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cpf_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_situacao_senha` int(11) NULL DEFAULT NULL,
  `data_registro` datetime(0) NULL DEFAULT NULL,
  `data_alteracao` datetime(0) NULL DEFAULT NULL,
  `tipo_usuario` int(11) NULL DEFAULT NULL,
  `imagem` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  INDEX `id_situacao`(`id_situacao`) USING BTREE,
  INDEX `tb_usuario_ibfk_2`(`id_situacao_senha`) USING BTREE,
  CONSTRAINT `tb_usuario_ibfk_1` FOREIGN KEY (`id_situacao`) REFERENCES `tb_situacao` (`id_situacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_usuario_ibfk_2` FOREIGN KEY (`id_situacao_senha`) REFERENCES `tb_situacao_senha` (`id_situacao_senha`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_usuario
-- ----------------------------
INSERT INTO `tb_usuario` VALUES (1, 1, 'Marcos Ramos De Almeida', '02233676130', 'markoslpm@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, '2021-07-12 10:59:55', '2021-07-22 08:42:57', 1, 'dfb91d3962f08b12d8834a12bf28c30e.jpg');
INSERT INTO `tb_usuario` VALUES (2, 1, 'Marcos Ramos', '02233676131', 'markoslpm123@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, '2021-07-12 12:41:01', NULL, 2, 'dfb91d3962f08b12d8834a12bf28c30e.jpg');
INSERT INTO `tb_usuario` VALUES (3, 1, 'Testando Da Silva', '00000000000', 'testando@gmail.com', '645a8aca5a5b84527c57ee2f153f1946', 2, '2021-07-22 08:03:52', '2021-07-22 08:21:36', 1, 'c81f5c2b4410710a9ca856ba98a94cd6.jpg');

-- ----------------------------
-- Table structure for tb_usuario_modulo
-- ----------------------------
DROP TABLE IF EXISTS `tb_usuario_modulo`;
CREATE TABLE `tb_usuario_modulo`  (
  `id_usuario_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NULL DEFAULT NULL,
  `id_modulo` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario_modulo`) USING BTREE,
  INDEX `tb_usuario_modulo_ibfk_1`(`id_usuario`) USING BTREE,
  INDEX `tb_usuario_modulo_ibfk_2`(`id_modulo`) USING BTREE,
  CONSTRAINT `tb_usuario_modulo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_usuario_modulo_ibfk_2` FOREIGN KEY (`id_modulo`) REFERENCES `tb_modulo` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_usuario_modulo
-- ----------------------------
INSERT INTO `tb_usuario_modulo` VALUES (5, 2, 11);
INSERT INTO `tb_usuario_modulo` VALUES (6, 2, 12);
INSERT INTO `tb_usuario_modulo` VALUES (19, 3, 9);
INSERT INTO `tb_usuario_modulo` VALUES (20, 3, 10);
INSERT INTO `tb_usuario_modulo` VALUES (21, 3, 11);
INSERT INTO `tb_usuario_modulo` VALUES (22, 3, 12);
INSERT INTO `tb_usuario_modulo` VALUES (31, 1, 9);
INSERT INTO `tb_usuario_modulo` VALUES (32, 1, 10);
INSERT INTO `tb_usuario_modulo` VALUES (33, 1, 11);
INSERT INTO `tb_usuario_modulo` VALUES (34, 1, 12);

-- ----------------------------
-- Table structure for tb_usuario_pesquisa
-- ----------------------------
DROP TABLE IF EXISTS `tb_usuario_pesquisa`;
CREATE TABLE `tb_usuario_pesquisa`  (
  `id_usuario_pesquisa` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NULL DEFAULT NULL,
  `id_pesquisa` int(11) NULL DEFAULT NULL,
  `data_registro` datetime(0) NULL DEFAULT NULL,
  `data_alteracao` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario_pesquisa`) USING BTREE,
  INDEX `tb_usuario_pesquisa_ibfk_1`(`id_usuario`) USING BTREE,
  INDEX `tb_usuario_pesquisa_ibfk_2`(`id_pesquisa`) USING BTREE,
  CONSTRAINT `tb_usuario_pesquisa_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_usuario_pesquisa_ibfk_2` FOREIGN KEY (`id_pesquisa`) REFERENCES `tb_pesquisa` (`id_pesquisa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_usuario_pesquisa
-- ----------------------------
INSERT INTO `tb_usuario_pesquisa` VALUES (4, 1, 85, '2021-08-22 15:22:06', NULL);

SET FOREIGN_KEY_CHECKS = 1;
