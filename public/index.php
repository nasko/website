<?php

use Hackafe\DB\Mysqli,
    Hackafe\DB\Exception;

defined('DS') OR
    define('DS', DIRECTORY_SEPARATOR);

$config = parse_ini_file(__DIR__ . DS . '..' . DS . 'config' . DS . 'config.ini', true);
require_once __DIR__ . DS . '..' . DS . 'vendor'    . DS . 'SplClassLoader.php'; 

// autoloader за неймспейснати класове
$classLoader = new \SplClassLoader('Hackafe', realpath(__DIR__ . DS . '..' . DS . 'lib'));
$classLoader->register();

// autoloader за глобални класове
$classLoader = new \SplClassLoader(null, realpath(__DIR__ . DS . '..' . DS . 'lib'));
$classLoader->register();

// използване на Mysqli singleton от index.php:
try {
    $db = Mysqli::singleton();
} catch (Exception $e) {
    die($e->getMessage());
}

$result = $db->query("SELECT 'global code' as field_name");

if($result) {
    while ($row = $result->fetch_assoc()) {
        printf('<pre>%s</pre>', print_r($row, true));
    }

    $result->free();

}

// използване на Mysqli singleton в контекст на обект от глобално пространство:
$foo = new Hackafe_Models_Foo();
printf('<pre>%s</pre>', print_r($foo->getData(), true));

// използване на Mysqli singleton в контекст на обект от конкретно пространство:
$foo = new Hackafe\Models\Bar();
printf('<pre>%s</pre>', print_r($foo->getData(), true));

$db->close();
