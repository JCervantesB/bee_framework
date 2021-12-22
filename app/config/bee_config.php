<?php
// Este archivo contiene las Configuraciones Core de Cada Proyecto que utilice Bee Framework

// Saber si estamos trabajando de forma local o remota
define('IS_LOCAL'       , in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']));

// Define el uso horario (TimeZone) del sistema: https://www.php.net/manual/en/timezones.php
date_default_timezone_set('America/Mazatlan');

// Lenguaje
define('LANG'           , 'es');

//Ruta base del proyecto
define('BASEPATH'       , IS_LOCAL ? '/' : '__URL_EN_PRODUCCION__');

// Sal del Sistema, añade una capa de seguridad extra a las contraseñas, concatenando la contraseña con un string establecido por el sistema antes de hashearlo.
define('AUTH_SALT'      , 'BeeFramework<3');

// Puerto y URL del Sistema
define('PORT'           , '80');
define('URL'            , IS_LOCAL ? 'http://127.0.0.1:' . PORT . '/' : '__URL_EN_PRODUCCION__');

// Las rutas de directorios y archivos = '\'
define('DS'             , DIRECTORY_SEPARATOR);
define('ROOT'           , getcwd() . DS);
// Ruta absoluta (disco duro) del directorio app del proyecto
define('APP'            , ROOT.'app'.DS);
define('CLASSES'        , APP.'classes'.DS);
define('CONFIG'         , APP.'config'.DS);
define('CONTROLLERS'    , APP.'controllers'.DS);
define('MODELS'         , APP.'models'.DS);
define('FUNCTIONS'      , APP.'functions'.DS);

define('TEMPLATES'      , ROOT.'templates'.DS);
define('INCLUDES'       , TEMPLATES.'includes'.DS);
define('MODULES'        , TEMPLATES.'modules'.DS);
define('VIEWS'          , TEMPLATES.'views'.DS);

// Rutas de recursos y assets absolutos
define('IMAGES_PATH', ROOT.'assets'.DS.'images'.DS);


// URLs absolutas para carga de archivos o assets
define('ASSETS'         , URL.'assets/');
define('CSS'            , ASSETS.'css/'); // Ejemplo de uso src="... echo CSS; styles.css"
define('FAVICON'        , ASSETS.'favicon/');
define('FONTS'          , ASSETS.'fonts/');
define('IMAGES'         , ASSETS.'images/'); // Ejemplo de uso echo IMAGES; bee_logo.png";
define('JS'             , ASSETS.'js/');
define('PLUGINS'        , ASSETS.'plugins/');
define('UPLOADS'        , ASSETS.'uploads/'); //TODO: Revisar si no da problemas al subir archivos

// Credenciales para la Base de Datos
// Set para conexión local o de desarrollo
define('LDB_ENGINE'    , 'mysql');
define('LDB_HOST'      , 'localhost');
define('LDB_NAME'      , 'bee_db');
define('LDB_USER'      , 'root');
define('LDB_PASS'      , 'root');
define('LDB_CHARSET'   , 'utf8');

// Set para conexión en producción o servidor real
define('DB_ENGINE'    , 'mysql');
define('DB_HOST'      , 'localhost');
define('DB_NAME'      , '___REMOTE DB___');
define('DB_USER'      , '___REMOTE DB___');
define('DB_PASS'      , '___REMOTE DB___');
define('DB_CHARSET'   , '___REMOTE CHARTSET___');

// El controlador por defecto / El método por defecto / y el controlador de errores por defecto
define('DEFAULT_CONTROLLER'        , 'home');
define('DEFAULT_ERROR_CONTROLLER'  , 'error');
define('DEFAULT_METHOD'            , 'index');
