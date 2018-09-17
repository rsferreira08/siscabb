<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

// get document root
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'].'/siscabb');

// set this the base url of the project.
define('BASE_URL', 'http://localhost/siscabb');

// define Database Variables
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_siscabb');
define('DB_USER', 'root');
define('DB_PASS', '');

// define password crypt settings
define('PASS_SALT', 'Kd+Ga9e{:{w=d_Hw');

// Gera uma key para a seção
if (!isset($_SESSION))
    session_start();
if (!isset($_SESSION["csrf_token"])) {
	//srand((double) microtime() * 1000000); //for sake of MCRYPT_RAND
    $_SESSION["csrf_token"] = bin2hex(mcrypt_create_iv(22));
}

// Autoload Classes
function autoloader ($class_name) {

	if ($class_name == 'Db') {
		include(constant('DOCUMENT_ROOT').'/classes/database/PDO.class.php');
	} else {
    	include(constant('DOCUMENT_ROOT').'/classes/'.strtolower($class_name).'.php');
    }
}
spl_autoload_register("autoloader");

?>