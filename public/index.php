<?php

use Hackafe\DB\Mysqli,
	Hackafe\DB\Exception;

defined('DS') OR
    define('DS', DIRECTORY_SEPARATOR);

$config = parse_ini_file(__DIR__ . DS . '..' . DS . 'config' . DS . 'config.ini', true);
require_once __DIR__ . DS . '..' . DS . 'vendor' 	. DS . 'SplClassLoader.php'; 

$classLoader = new \SplClassLoader('Hackafe', realpath(__DIR__ . DS . '..' . DS . 'lib'));
$classLoader->register();


try {
	$db = Mysqli::singleton();
} catch (Exception $e) {
    die($e->getMessage());
}

$result = $db->query("SELECT 'bar' as foo");

if($result) {
	while ($row = $result->fetch_assoc()) {
		printf('<pre>%s</pre>', print_r($row, true));
	}

	$result->free();

}
$db->close();
