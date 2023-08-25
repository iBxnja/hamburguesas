<?php

if (!defined('ID_NULO')) define("ID_NULO", "0");
if (!defined('STRING_EMPTY')) define("STRING_EMPTY", "");
if (!defined('EXIT_SUCCESS')) define("EXIT_SUCCESS", "0");
if (!defined('EXIT_FAILURE')) define("EXIT_FAILURE", "1");
if (!defined('ACTIVO')) define("ACTIVO", "1");
if (!defined('CERO')) define("CERO", 0);
if (!defined('UNO')) define("UNO", 1);

if (!defined('OKINSERT')) define("OKINSERT", "Registro guardado.");
if (!defined('ERRORINSERT')) define("ERRORINSERT", "No se pudo guardar el registro.");
if (!defined('MSG_WARNING')) define("MSG_WARNING", "warning");
if (!defined('MSG_SUCCESS')) define("MSG_SUCCESS", "success");
if (!defined('MSG_ERROR')) define("MSG_ERROR", "danger");
if (!defined('MSG_INFO')) define("MSG_INFO", "info");
if (!defined('MSG_NOEXIST')) define("MSG_NOEXIST", "El registro no existe.");
if (!defined('ERR_RANGO_DE_FECHA')) define("ERR_RANGO_DE_FECHA", "El rango de fecha y hora es incorrecto.");
if (!defined('ERR_OPERACION')) define("ERR_OPERACION", "Error en la operaci&oacute;n.");

//Modulo permisos
if (!defined('PERMISOFALTANOMBRE')) define("PERMISOFALTANOMBRE", "Debe ingresar un nombre");

//Modulo grupo
if (!defined('GRUPOFALTANOMBRE')) define("GRUPOFALTANOMBRE", "Debe ingresar un nombre");

if (!defined('FALTANOMBRE')) define("FALTANOMBRE", "Debe ingresar un nombre");
if (!defined('CAMPOOBLIGATORIO')) define("CAMPOOBLIGATORIO", "Complete todos los campos obligatorios");

//Modulo usuarios
if (!defined('USUARIOFALTACAMPOS')) define("USUARIOFALTACAMPOS", "Complete todos los campos obligatorios");
if (!defined('USURIONOEXISTEENLDAP')) define("USURIONOEXISTEENLDAP", "Usuario o contrase&ntilde;a incorrecto");
if (!defined('USUARIOBLOQUEADO')) define("USUARIOBLOQUEADO", "Usuario bloqueado. Comun&iacute;quese con el administrador");
if (!defined('USUARIOINCORRECTO')) define("USUARIOINCORRECTO", "El usuario no est&aacute; autorizado a usar el sistema. Comun&iacute;quese con el administrador");

//Web Carrito
if (!defined('OKPEDIDO')) define("OKPEDIDO", "¡Pedido enviado!");

?>