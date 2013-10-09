<?php
namespace Hackafe\Models;

use \Hackafe\DB\Mysqli;

class Bar {

    private $data = array();

    public function __construct() {
        $db = Mysqli::singleton(); // или \Hackafe\DB\Mysqli::singleton()
        $result = $db->query("SELECT 'namespaced class' as field_name");

        if($result) {
            while ($row = $result->fetch_assoc()) {
                $this->data[] = $row;
            }

            $result->free();

        }
        return;
    }

    public function getData() {
        return $this->data;
    }
}