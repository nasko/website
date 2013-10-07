<?php
namespace Hackafe\DB;

class Mysqli extends \mysqli
{
    public static $_instance;
    
    private function __construct() {
        global $config;

		\extract($config['db']);

        parent::__construct($host, $user, $passwd, $dbname);

        if (mysqli_connect_error()) {
            throw new Exception('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
    }
    
    public static function singleton() {
        if(!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }
}

?>
