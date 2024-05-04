/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_games

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 04/05/2024 23:23:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for developer
-- ----------------------------
DROP TABLE IF EXISTS `developer`;
CREATE TABLE `developer`  (
  `developer_id` int NOT NULL AUTO_INCREMENT,
  `developer_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`developer_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of developer
-- ----------------------------
INSERT INTO `developer` VALUES (1, 'DICE');
INSERT INTO `developer` VALUES (2, 'Respawn');
INSERT INTO `developer` VALUES (3, 'ATLUS');
INSERT INTO `developer` VALUES (4, 'Rockstar');
INSERT INTO `developer` VALUES (5, 'Arrowhead');
INSERT INTO `developer` VALUES (6, 'Peropero');
INSERT INTO `developer` VALUES (9, 'Agate');
INSERT INTO `developer` VALUES (10, 'Ozysoft');

-- ----------------------------
-- Table structure for games
-- ----------------------------
DROP TABLE IF EXISTS `games`;
CREATE TABLE `games`  (
  `games_id` int NOT NULL AUTO_INCREMENT,
  `games_foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `games_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `games_genre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `games_tanggal_rilis` date NOT NULL,
  `games_rating` int NOT NULL,
  `games_harga` int NOT NULL,
  `developer_id` int NOT NULL,
  `publisher_id` int NOT NULL,
  PRIMARY KEY (`games_id`) USING BTREE,
  INDEX `developer`(`developer_id` ASC) USING BTREE,
  INDEX `publisher`(`publisher_id` ASC) USING BTREE,
  CONSTRAINT `developer` FOREIGN KEY (`developer_id`) REFERENCES `developer` (`developer_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `publisher` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`publisher_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of games
-- ----------------------------
INSERT INTO `games` VALUES (1, 'bf.jpg', 'BattleField 2042', 'FPS', '2024-05-07', 76, 700000, 1, 1);
INSERT INTO `games` VALUES (2, 'hell.jpeg', 'Helldivers II', 'TPS', '2024-04-29', 89, 500000, 5, 2);
INSERT INTO `games` VALUES (3, 'jedi.jpeg', 'Star Wars', 'Action', '2024-05-09', 92, 825000, 2, 1);
INSERT INTO `games` VALUES (4, 'persona.jpg', 'Persona 5', 'Turn Based', '2024-05-14', 83, 570000, 3, 3);
INSERT INTO `games` VALUES (5, 'gta.jpeg', 'GTA V', 'Open World', '2024-05-08', 96, 675000, 4, 4);
INSERT INTO `games` VALUES (6, 'muse.jpg', 'Muse Dash', 'Rythm', '2024-05-15', 81, 125000, 6, 6);

-- ----------------------------
-- Table structure for publisher
-- ----------------------------
DROP TABLE IF EXISTS `publisher`;
CREATE TABLE `publisher`  (
  `publisher_id` int NOT NULL AUTO_INCREMENT,
  `publisher_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`publisher_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of publisher
-- ----------------------------
INSERT INTO `publisher` VALUES (1, 'Electronic Arts');
INSERT INTO `publisher` VALUES (2, 'Playstation');
INSERT INTO `publisher` VALUES (3, 'SEGA');
INSERT INTO `publisher` VALUES (4, 'Take Two');
INSERT INTO `publisher` VALUES (6, 'Hasuhasu');
INSERT INTO `publisher` VALUES (7, 'Blizzard');

SET FOREIGN_KEY_CHECKS = 1;
