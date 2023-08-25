

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sistema_areas
-- ----------------------------
DROP TABLE IF EXISTS `sistema_areas`;
CREATE TABLE `sistema_areas`  (
  `idarea` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ncarea` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descarea` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `activo` smallint(6) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idarea`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sistema_areas
-- ----------------------------
INSERT INTO `sistema_areas` VALUES (1, 'SISTEMAS', 'Sistemas', 1);

-- ----------------------------
-- Table structure for sistema_familias
-- ----------------------------
DROP TABLE IF EXISTS `sistema_familias`;
CREATE TABLE `sistema_familias`  (
  `idfamilia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idfamilia`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sistema_familias
-- ----------------------------
INSERT INTO `sistema_familias` VALUES (1, 'Administrador total', 'Administrador total');
INSERT INTO `sistema_familias` VALUES (2, 'Cliente', 'Cliente');
INSERT INTO `sistema_familias` VALUES (3, 'Administrador de la Empresa', 'Administrador de la Empresa');
INSERT INTO `sistema_familias` VALUES (4, 'Administrativo', 'Administrador Parcial');
INSERT INTO `sistema_familias` VALUES (5, 'Usuario', 'Usuario');
INSERT INTO `sistema_familias` VALUES (9, 'Administrador', 'administrador total');
INSERT INTO `sistema_familias` VALUES (10, 'admin', 'sdasd');

-- ----------------------------
-- Table structure for sistema_menu_area
-- ----------------------------
DROP TABLE IF EXISTS `sistema_menu_area`;
CREATE TABLE `sistema_menu_area`  (
  `fk_idmenu` int(11) UNSIGNED NOT NULL,
  `fk_idarea` int(11) UNSIGNED NOT NULL,
  INDEX `fk_idmenu`(`fk_idmenu`) USING BTREE,
  INDEX `fk_idarea`(`fk_idarea`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sistema_menu_area
-- ----------------------------
INSERT INTO `sistema_menu_area` VALUES (10, 1);
INSERT INTO `sistema_menu_area` VALUES (8, 1);
INSERT INTO `sistema_menu_area` VALUES (17, 1);
INSERT INTO `sistema_menu_area` VALUES (85, 1);
INSERT INTO `sistema_menu_area` VALUES (9, 1);
INSERT INTO `sistema_menu_area` VALUES (137, 1);
INSERT INTO `sistema_menu_area` VALUES (140, 1);
INSERT INTO `sistema_menu_area` VALUES (147, 1);
INSERT INTO `sistema_menu_area` VALUES (157, 1);
INSERT INTO `sistema_menu_area` VALUES (7, 1);
INSERT INTO `sistema_menu_area` VALUES (158, 1);
INSERT INTO `sistema_menu_area` VALUES (168, 1);
INSERT INTO `sistema_menu_area` VALUES (169, 1);
INSERT INTO `sistema_menu_area` VALUES (177, 1);
INSERT INTO `sistema_menu_area` VALUES (200, 1);
INSERT INTO `sistema_menu_area` VALUES (198, 1);
INSERT INTO `sistema_menu_area` VALUES (201, 1);
INSERT INTO `sistema_menu_area` VALUES (202, 1);
INSERT INTO `sistema_menu_area` VALUES (203, 1);
INSERT INTO `sistema_menu_area` VALUES (204, 1);
INSERT INTO `sistema_menu_area` VALUES (206, 1);
INSERT INTO `sistema_menu_area` VALUES (208, 1);
INSERT INTO `sistema_menu_area` VALUES (209, 1);

-- ----------------------------
-- Table structure for sistema_menues
-- ----------------------------
DROP TABLE IF EXISTS `sistema_menues`;
CREATE TABLE `sistema_menues`  (
  `idmenu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT '',
  `orden` int(11) NULL DEFAULT 0,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `id_padre` int(11) NULL DEFAULT 0,
  `fk_idpatente` int(11) NULL DEFAULT NULL,
  `css` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT '0',
  `activo` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`idmenu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 210 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sistema_menues
-- ----------------------------
INSERT INTO `sistema_menues` VALUES (7, '', 100, 'Sistema', 0, NULL, 'fa fa-lock fa-fw', 1);
INSERT INTO `sistema_menues` VALUES (8, '/admin/grupos', 3, 'Áreas de trabajo', 7, NULL, '', 1);
INSERT INTO `sistema_menues` VALUES (9, '/admin/usuarios', 1, 'Usuarios', 7, NULL, 'fas fa-users', 1);
INSERT INTO `sistema_menues` VALUES (10, '/admin/permisos', 2, 'Permisos', 7, NULL, '', 1);
INSERT INTO `sistema_menues` VALUES (85, '/admin/sistema/menu', 1, 'Menú', 7, NULL, '', 1);
INSERT INTO `sistema_menues` VALUES (137, '/admin/patentes', 2, 'Patentes', 7, NULL, '', 1);
INSERT INTO `sistema_menues` VALUES (140, '/admin/cliente/nuevo', 2, 'Nuevo cliente', 168, NULL, '', 1);
INSERT INTO `sistema_menues` VALUES (158, '/admin', -1, 'Inicio', 0, NULL, 'fas fa-home', 1);
INSERT INTO `sistema_menues` VALUES (168, NULL, 1, 'Clientes', 0, NULL, 'fas fa-user', 1);
INSERT INTO `sistema_menues` VALUES (169, '/admin/clientes', 0, 'Listado de clientes', 168, NULL, '', 1);
INSERT INTO `sistema_menues` VALUES (198, '/admin/productos', 1, 'Listado de Productos', 200, NULL, 'fas fa-hamburger', 1);
INSERT INTO `sistema_menues` VALUES (200, '', 2, 'Productos', 0, NULL, 'fas fa-hamburger', 1);
INSERT INTO `sistema_menues` VALUES (201, '/admin/producto/nuevo', 2, 'Nuevo producto', 200, NULL, 'fas fa-hamburger', 1);
INSERT INTO `sistema_menues` VALUES (202, NULL, 3, 'Pedidos', 0, NULL, 'fas fa-shopping-cart', 1);
INSERT INTO `sistema_menues` VALUES (203, '/admin/pedidos', 1, 'Listado de pedidos', 202, NULL, NULL, 1);
INSERT INTO `sistema_menues` VALUES (204, NULL, 4, 'Postulaciones', 0, NULL, 'fas fa-user-plus', 1);
INSERT INTO `sistema_menues` VALUES (206, '/admin/postulaciones', 1, 'Listado de postulaciones', 204, NULL, NULL, 1);
INSERT INTO `sistema_menues` VALUES (208, NULL, 6, 'Sucursales', NULL, NULL, 'fas fa-store', 1);
INSERT INTO `sistema_menues` VALUES (209, '/admin/sucursales', 1, 'Listado de sucursales', 208, NULL, NULL, 1);

-- ----------------------------
-- Table structure for sistema_patente_familia
-- ----------------------------
DROP TABLE IF EXISTS `sistema_patente_familia`;
CREATE TABLE `sistema_patente_familia`  (
  `fk_idpatente` int(11) UNSIGNED NOT NULL,
  `fk_idfamilia` int(11) UNSIGNED NOT NULL,
  INDEX `fk_idpatente`(`fk_idpatente`) USING BTREE,
  INDEX `fk_idfamilia`(`fk_idfamilia`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sistema_patente_familia
-- ----------------------------
INSERT INTO `sistema_patente_familia` VALUES (10, 5);
INSERT INTO `sistema_patente_familia` VALUES (12, 5);
INSERT INTO `sistema_patente_familia` VALUES (10, 3);
INSERT INTO `sistema_patente_familia` VALUES (12, 3);
INSERT INTO `sistema_patente_familia` VALUES (128, 7);
INSERT INTO `sistema_patente_familia` VALUES (129, 7);
INSERT INTO `sistema_patente_familia` VALUES (130, 7);
INSERT INTO `sistema_patente_familia` VALUES (131, 7);
INSERT INTO `sistema_patente_familia` VALUES (10, 4);
INSERT INTO `sistema_patente_familia` VALUES (11, 4);
INSERT INTO `sistema_patente_familia` VALUES (12, 4);
INSERT INTO `sistema_patente_familia` VALUES (20, 4);
INSERT INTO `sistema_patente_familia` VALUES (1, 9);
INSERT INTO `sistema_patente_familia` VALUES (2, 9);
INSERT INTO `sistema_patente_familia` VALUES (3, 9);
INSERT INTO `sistema_patente_familia` VALUES (4, 9);
INSERT INTO `sistema_patente_familia` VALUES (5, 9);
INSERT INTO `sistema_patente_familia` VALUES (6, 9);
INSERT INTO `sistema_patente_familia` VALUES (7, 9);
INSERT INTO `sistema_patente_familia` VALUES (8, 9);
INSERT INTO `sistema_patente_familia` VALUES (9, 9);
INSERT INTO `sistema_patente_familia` VALUES (10, 9);
INSERT INTO `sistema_patente_familia` VALUES (11, 9);
INSERT INTO `sistema_patente_familia` VALUES (12, 9);
INSERT INTO `sistema_patente_familia` VALUES (13, 9);
INSERT INTO `sistema_patente_familia` VALUES (14, 9);
INSERT INTO `sistema_patente_familia` VALUES (15, 9);
INSERT INTO `sistema_patente_familia` VALUES (16, 9);
INSERT INTO `sistema_patente_familia` VALUES (17, 9);
INSERT INTO `sistema_patente_familia` VALUES (18, 9);
INSERT INTO `sistema_patente_familia` VALUES (19, 9);
INSERT INTO `sistema_patente_familia` VALUES (20, 9);
INSERT INTO `sistema_patente_familia` VALUES (176, 9);
INSERT INTO `sistema_patente_familia` VALUES (177, 9);
INSERT INTO `sistema_patente_familia` VALUES (178, 9);
INSERT INTO `sistema_patente_familia` VALUES (179, 9);
INSERT INTO `sistema_patente_familia` VALUES (209, 9);
INSERT INTO `sistema_patente_familia` VALUES (18, 10);
INSERT INTO `sistema_patente_familia` VALUES (19, 10);
INSERT INTO `sistema_patente_familia` VALUES (176, 10);
INSERT INTO `sistema_patente_familia` VALUES (177, 10);
INSERT INTO `sistema_patente_familia` VALUES (178, 10);
INSERT INTO `sistema_patente_familia` VALUES (179, 10);
INSERT INTO `sistema_patente_familia` VALUES (209, 10);
INSERT INTO `sistema_patente_familia` VALUES (1, 1);
INSERT INTO `sistema_patente_familia` VALUES (2, 1);
INSERT INTO `sistema_patente_familia` VALUES (3, 1);
INSERT INTO `sistema_patente_familia` VALUES (4, 1);
INSERT INTO `sistema_patente_familia` VALUES (5, 1);
INSERT INTO `sistema_patente_familia` VALUES (6, 1);
INSERT INTO `sistema_patente_familia` VALUES (7, 1);
INSERT INTO `sistema_patente_familia` VALUES (8, 1);
INSERT INTO `sistema_patente_familia` VALUES (9, 1);
INSERT INTO `sistema_patente_familia` VALUES (10, 1);
INSERT INTO `sistema_patente_familia` VALUES (11, 1);
INSERT INTO `sistema_patente_familia` VALUES (12, 1);
INSERT INTO `sistema_patente_familia` VALUES (13, 1);
INSERT INTO `sistema_patente_familia` VALUES (15, 1);
INSERT INTO `sistema_patente_familia` VALUES (16, 1);
INSERT INTO `sistema_patente_familia` VALUES (17, 1);
INSERT INTO `sistema_patente_familia` VALUES (18, 1);
INSERT INTO `sistema_patente_familia` VALUES (19, 1);
INSERT INTO `sistema_patente_familia` VALUES (20, 1);
INSERT INTO `sistema_patente_familia` VALUES (70, 1);
INSERT INTO `sistema_patente_familia` VALUES (71, 1);
INSERT INTO `sistema_patente_familia` VALUES (72, 1);
INSERT INTO `sistema_patente_familia` VALUES (73, 1);
INSERT INTO `sistema_patente_familia` VALUES (91, 1);
INSERT INTO `sistema_patente_familia` VALUES (92, 1);
INSERT INTO `sistema_patente_familia` VALUES (93, 1);
INSERT INTO `sistema_patente_familia` VALUES (94, 1);
INSERT INTO `sistema_patente_familia` VALUES (99, 1);
INSERT INTO `sistema_patente_familia` VALUES (100, 1);
INSERT INTO `sistema_patente_familia` VALUES (101, 1);
INSERT INTO `sistema_patente_familia` VALUES (102, 1);
INSERT INTO `sistema_patente_familia` VALUES (143, 1);
INSERT INTO `sistema_patente_familia` VALUES (144, 1);
INSERT INTO `sistema_patente_familia` VALUES (145, 1);
INSERT INTO `sistema_patente_familia` VALUES (148, 1);
INSERT INTO `sistema_patente_familia` VALUES (153, 1);
INSERT INTO `sistema_patente_familia` VALUES (154, 1);
INSERT INTO `sistema_patente_familia` VALUES (155, 1);
INSERT INTO `sistema_patente_familia` VALUES (158, 1);
INSERT INTO `sistema_patente_familia` VALUES (176, 1);
INSERT INTO `sistema_patente_familia` VALUES (177, 1);
INSERT INTO `sistema_patente_familia` VALUES (178, 1);
INSERT INTO `sistema_patente_familia` VALUES (179, 1);
INSERT INTO `sistema_patente_familia` VALUES (181, 1);
INSERT INTO `sistema_patente_familia` VALUES (185, 1);
INSERT INTO `sistema_patente_familia` VALUES (209, 1);
INSERT INTO `sistema_patente_familia` VALUES (210, 1);
INSERT INTO `sistema_patente_familia` VALUES (211, 1);
INSERT INTO `sistema_patente_familia` VALUES (214, 1);
INSERT INTO `sistema_patente_familia` VALUES (215, 1);
INSERT INTO `sistema_patente_familia` VALUES (216, 1);
INSERT INTO `sistema_patente_familia` VALUES (221, 1);
INSERT INTO `sistema_patente_familia` VALUES (222, 1);
INSERT INTO `sistema_patente_familia` VALUES (223, 1);
INSERT INTO `sistema_patente_familia` VALUES (224, 1);
INSERT INTO `sistema_patente_familia` VALUES (225, 1);

-- ----------------------------
-- Table structure for sistema_patentes
-- ----------------------------
DROP TABLE IF EXISTS `sistema_patentes`;
CREATE TABLE `sistema_patentes`  (
  `idpatente` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `submodulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT '',
  `modulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT '',
  `log_operacion` smallint(6) NOT NULL DEFAULT 0,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idpatente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 227 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sistema_patentes
-- ----------------------------
INSERT INTO `sistema_patentes` VALUES (1, 'CONSULTA', 'Permisos', 'PERMISOSCONSULTA', 'Sistema', 1, 'Consulta de permisos');
INSERT INTO `sistema_patentes` VALUES (2, 'ALTA', 'Permisos', 'PERMISOSALTA', 'Sistema', 1, 'Alta de familia');
INSERT INTO `sistema_patentes` VALUES (3, 'EDITAR', 'Permisos', 'PERMISOSMODIFICACION', 'Sistema', 1, 'Modificación de familia de permisos');
INSERT INTO `sistema_patentes` VALUES (4, 'BAJA', 'Permisos', 'PERMISOSBAJA', 'Sistema', 1, 'Baja de familia de permisos');
INSERT INTO `sistema_patentes` VALUES (5, 'BAJA', 'Grupo de usuarios', 'GRUPOBAJA', 'Sistema', 1, 'Baja de grupo de usuarios');
INSERT INTO `sistema_patentes` VALUES (6, 'CONSULTA', 'Grupo de usuarios', 'GRUPOCONSULTA', 'Sistema', 1, 'Consulta de grupo de usuarios');
INSERT INTO `sistema_patentes` VALUES (7, 'EDITAR', 'Grupo de usuarios', 'GRUPOMODIFICACION', 'Sistema', 1, 'Modificación de grupos de usuarios');
INSERT INTO `sistema_patentes` VALUES (8, 'ALTA', 'Grupo de usuarios', 'GRUPOALTA', 'Sistema', 1, 'Alta de grupos de usuarios');
INSERT INTO `sistema_patentes` VALUES (9, 'EDITAR', 'Usuario', 'USUARIOASIGNARGRUPO', 'Sistema', 1, 'Agrega grupos a un usuario');
INSERT INTO `sistema_patentes` VALUES (10, 'ALTA', 'Usuario', 'USUARIOALTA', 'Sistema', 1, 'Nuevo usuario');
INSERT INTO `sistema_patentes` VALUES (11, 'BAJA', 'Usuario', 'USUARIOELIMINAR', 'Sistema', 1, 'Eliminar usuario');
INSERT INTO `sistema_patentes` VALUES (12, 'EDITAR', 'Usuario', 'USUARIOMODIFICAR', 'Sistema', 1, 'Modificar usuario');
INSERT INTO `sistema_patentes` VALUES (13, 'EDITAR', 'Usuario', 'USUARIOAGREGARPERMISO', 'Sistema', 1, 'Agrega permisos dentro de la pantalla del usuario');
INSERT INTO `sistema_patentes` VALUES (14, 'BAJA', 'Usuario', 'USUARIOELIMINARPERMISO', 'Sistema', 1, 'Eliminar un permiso del usuario');
INSERT INTO `sistema_patentes` VALUES (15, 'CONSULTA', 'Usuario', 'USUARIOGRUPOGRILLA', 'Sistema', 1, 'Muestra la grilla de grupos de un usuario');
INSERT INTO `sistema_patentes` VALUES (16, 'EDITAR', 'Usuario', 'USUARIOGRUPOAGREGAR', 'Sistema', 1, 'Agrega un grupo para el usuario');
INSERT INTO `sistema_patentes` VALUES (17, 'BAJA', 'Usuario', 'USUARIOGRUPOELIMINAR', 'Sistema', 1, 'Elimina un grupo del usuario');
INSERT INTO `sistema_patentes` VALUES (18, 'EDITAR', 'Permisos', 'PERMISOSAGREGARPATENTE', 'Sistema', 1, 'Agrega patente a un permiso');
INSERT INTO `sistema_patentes` VALUES (19, 'BAJA', 'Permisos', 'PERMISOSELIMINARPATENTE', 'Sistema', 1, 'Elimina patente a un permiso');
INSERT INTO `sistema_patentes` VALUES (20, 'CONSULTA', 'Usuaurio', 'USUARIOCONSULTA', 'Sistema', 1, 'Consulta la lista de usuarios');
INSERT INTO `sistema_patentes` VALUES (30, 'EDITAR', 'Persona', 'PERSONAMODIFICACION', 'Panel de control ', 1, 'Modificar  una persona');
INSERT INTO `sistema_patentes` VALUES (31, 'ALTA', 'Persona', 'PERSONAALTA', 'Panel de control', 1, 'Agrega una nueva persona');
INSERT INTO `sistema_patentes` VALUES (32, 'CONSULTA', 'Persona', 'PERSONACONSULTA', 'Panel de control', 1, 'Listado de Personas');
INSERT INTO `sistema_patentes` VALUES (70, 'CONSULTA', 'Menu', 'MENUCONSULTA', 'Sistema', 1, 'Listado del menu del sistema');
INSERT INTO `sistema_patentes` VALUES (71, 'ALTA', 'Menu', 'MENUALTA', 'Sistema', 1, 'Agrega un nuevo elemento de menu');
INSERT INTO `sistema_patentes` VALUES (72, 'EDITAR', 'Menu', 'MENUMODIFICACION', 'Sistema', 1, 'Modifica un elemento de menu');
INSERT INTO `sistema_patentes` VALUES (73, 'BAJA', 'Menu', 'MENUELIMINAR', 'SIstema', 1, 'Elimina un elemento de menu');
INSERT INTO `sistema_patentes` VALUES (74, 'CONSULTA', 'Sistema', 'SIMULARALUMNO', 'Sistema', 1, 'Permite al administrador simular el login como alu');
INSERT INTO `sistema_patentes` VALUES (77, 'EDITAR', 'Tipo de cliente', 'TIPOCLIENTEMODIFICACIONES', 'Cliente', 1, 'Modificaciones tipo cliente');
INSERT INTO `sistema_patentes` VALUES (78, 'CONSULTA', 'Tipo de cliente', 'TIPOCLIENTECONSULTA', 'Cliente', 1, 'Consulta tipo de cliente');
INSERT INTO `sistema_patentes` VALUES (79, 'ALTA', 'Tipo de cliente', 'TIPOCLIENTEALTA', 'Cliente', 1, 'Altas de tipos de clientes');
INSERT INTO `sistema_patentes` VALUES (82, 'BAJA', 'Tipo de cliente', 'BAJATIPODECLIENTE', 'Cliente', 1, 'Bajas de tipos de clientes');
INSERT INTO `sistema_patentes` VALUES (91, 'ALTA', 'Nuevo cliente', 'CLIENTEALTA', 'Clientes', 0, 'Alta de nuevos clientes');
INSERT INTO `sistema_patentes` VALUES (92, 'EDITAR', 'Nuevo cliente', 'CLIENTEEDITAR', 'Clientes', 0, 'Editar clientes');
INSERT INTO `sistema_patentes` VALUES (93, 'BAJA', 'Nuevo cliente', 'CLIENTEELIMINAR', 'Clientes', 0, 'Eliminar clientes');
INSERT INTO `sistema_patentes` VALUES (94, 'CONSULTA', 'Listado de Clientes', 'CLIENTECONSULTA', 'Clientes', 0, 'Consulta de listado de clientes');
INSERT INTO `sistema_patentes` VALUES (99, 'ALTA', 'Productos', 'PRODUCTOSALTA', 'Productos', 1, 'Alta de productos');
INSERT INTO `sistema_patentes` VALUES (100, 'BAJA', 'Productos', 'PRODUCTOELIMINAR', 'Productos', 1, 'Baja de productos');
INSERT INTO `sistema_patentes` VALUES (101, 'EDITAR', 'Productos', 'PRODUCTOEDITAR', 'Productos', 1, 'Editar productos');
INSERT INTO `sistema_patentes` VALUES (102, 'CONSULTA', 'Productos', 'PRODUCTOCONSULTA', 'Productos', 1, 'Consulta de productos');
INSERT INTO `sistema_patentes` VALUES (143, 'CONSULTA', 'sucursales', 'SUCURSALCONSULTA', 'sucursales', 0, 'Consulta de sucursales');
INSERT INTO `sistema_patentes` VALUES (144, 'ALTA', 'sucursales', 'SUCURSALALTA', 'sucursales', 0, 'Alta de sucursales');
INSERT INTO `sistema_patentes` VALUES (145, 'BAJA', 'sucursales ', 'SUCURSALBAJA', 'sucursales', 0, 'baja de sucursales');
INSERT INTO `sistema_patentes` VALUES (148, 'EDITAR', 'sucursales', 'SUCURSALEDITAR', 'sucursales', 1, 'Modificacion de sucursal');
INSERT INTO `sistema_patentes` VALUES (153, 'CONSULTA', 'Inscripcion', 'INSCRIPCIONCONSULTA', 'Inscripcion', 1, 'Consulta de inscripciones');
INSERT INTO `sistema_patentes` VALUES (154, 'ALTA', 'Inscripcion', 'INSCRIPCIONALTA', 'Inscripcion', 1, 'Alta de inscripciones');
INSERT INTO `sistema_patentes` VALUES (155, 'EDITAR', 'Inscripcion', 'INSCRIPCIONMODIFICACION', 'Inscripcion', 1, 'Modificacion de inscripciones');
INSERT INTO `sistema_patentes` VALUES (158, 'BAJA', 'Permisos', 'INSCRIPCIONBAJA', 'Sistema', 1, 'Baja de inscripciones');
INSERT INTO `sistema_patentes` VALUES (176, 'ALTA', 'Patentes', 'PATENTESALTA', 'Patentes', 0, 'Registra nuevas patentes');
INSERT INTO `sistema_patentes` VALUES (177, 'BAJA', 'Patentes', 'PATENTESBAJA', 'Patentes', 0, 'Da de baja patentes');
INSERT INTO `sistema_patentes` VALUES (178, 'EDITAR', 'Patentes', 'PATENTESMODIFICACION', 'Patentes', 0, 'Modifica patentes existentes');
INSERT INTO `sistema_patentes` VALUES (179, 'CONSULTA', 'Patentes', 'PATENTESCONSULTA', 'Patentes', 0, 'Consulta patentes');
INSERT INTO `sistema_patentes` VALUES (181, 'CONSULTA', 'Pedido', 'PEDIDOCONSULTA', 'Pedido', 1, 'Permite listar los pedidos');
INSERT INTO `sistema_patentes` VALUES (184, 'Eliminar', 'Listar categorias', 'CATEGORIAELIMINAR', 'Categorias', 0, 'Elimina una categoria');
INSERT INTO `sistema_patentes` VALUES (185, 'CONSULTA', 'Listar consultas', 'CONSULTACONSULTA', 'Consultas', 1, 'Consultar las consultas');
INSERT INTO `sistema_patentes` VALUES (186, 'ALTA', 'Nueva consulta', 'CONSULTAALTA', 'Consultas', 1, 'Alta de categorias');
INSERT INTO `sistema_patentes` VALUES (187, 'BAJA', 'Listar consultas', 'CONSULTAELIMINAR', 'Consultas', 1, 'Elimina una consulta');
INSERT INTO `sistema_patentes` VALUES (188, 'EDITAR', 'Listar consultas', 'CONSULTAMODIFICACION', 'Consultas', 1, 'Modifica una consulta');
INSERT INTO `sistema_patentes` VALUES (209, 'ALTA', 'Patentes', 'PATENTEALTA', 'Patentes', 0, 'Permite ingresar una nueva patente');
INSERT INTO `sistema_patentes` VALUES (214, 'ALTA', 'Pedido', 'PEDIDOALTA', 'Pedido', 1, 'permite ingresar un nuevo pedido');
INSERT INTO `sistema_patentes` VALUES (215, 'EDITAR', 'Pedido', 'PEDIDOEDITAR', 'Pedido', 1, 'permite editar un pedido existente');
INSERT INTO `sistema_patentes` VALUES (216, 'BAJA', 'Pedido', 'PEDIDOBAJA', 'Pedido', 1, 'permite eliminar un pedido');
INSERT INTO `sistema_patentes` VALUES (221, 'ALTA', 'Postulacion', 'POSTULANTEALTA', 'Postulacion', 1, 'permite agregar un nuevo postulante');
INSERT INTO `sistema_patentes` VALUES (222, 'CONSULTA', 'Postulacion', 'POSTULANTECONSULTA', 'Postulacion', 1, 'permite modificar un nuevo postulante');
INSERT INTO `sistema_patentes` VALUES (223, 'EDITAR', 'Postulacion', 'POSTULANTEEDITAR', 'Postulacion', 1, 'permite modificar un nuevo postulante');
INSERT INTO `sistema_patentes` VALUES (224, 'BAJA', 'Postulacion', 'POSTULANTEBAJA', 'Postulacion', 1, 'permite dar de baja un postulante');
INSERT INTO `sistema_patentes` VALUES (225, 'CONSULTA', 'Pedido', 'PEDIDOVER', 'Pedido', 1, 'Permite ver por pedido');

-- ----------------------------
-- Table structure for sistema_usuario_familia
-- ----------------------------
DROP TABLE IF EXISTS `sistema_usuario_familia`;
CREATE TABLE `sistema_usuario_familia`  (
  `fk_idusuario` int(11) UNSIGNED NOT NULL,
  `fk_idfamilia` int(11) UNSIGNED NOT NULL,
  `fk_idarea` int(11) UNSIGNED NOT NULL,
  INDEX `fk_idusuario`(`fk_idusuario`) USING BTREE,
  INDEX `fk_idfamilia`(`fk_idfamilia`) USING BTREE,
  INDEX `fk_idarea`(`fk_idarea`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sistema_usuario_familia
-- ----------------------------
INSERT INTO `sistema_usuario_familia` VALUES (1, 1, 1);

-- ----------------------------
-- Table structure for sistema_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `sistema_usuarios`;
CREATE TABLE `sistema_usuarios`  (
  `idusuario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `mail` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `clave` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ultimo_ingreso` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `token` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'current_timestamp()',
  `root` smallint(6) NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `cantidad_bloqueo` int(11) NULL DEFAULT NULL,
  `areapredeterminada` smallint(6) NULL DEFAULT NULL,
  `activo` smallint(6) NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`) USING BTREE,
  UNIQUE INDEX `usuario`(`usuario`) USING BTREE,
  UNIQUE INDEX `email`(`mail`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sistema_usuarios
-- ----------------------------
INSERT INTO `sistema_usuarios` VALUES (1, 'admin', 'Administrador', '', 'admin@correo.com', '$2y$10$FeFXjlupKImULPF.aVRNueCALrpj55n.fotONLQ1QY3YvlYTelRP2', '2021-10-28 18:51:43', 'current_timestamp()', 1, '2021-09-17 16:05:57', 0, 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
