<?php
use Hackafe\DB\Mysqli;

class Hackafe_Models_Foo {

    private $data = array();

    public function __construct() {
        //$db = Mysqli::singleton(); // или Hackafe\DB\Mysqli::singleton()
        $result = $db->query("SELECT 'global space class' as field_name");

        if($result) {
            while ($row = $result->fetch_assoc()) {
                $this->data[] = $row;
            }

            $result->free();

        } else {

            print "err: " . $db->error;
        }
        return;
    }

    public function getData() {
        return $this->data;
    }
}