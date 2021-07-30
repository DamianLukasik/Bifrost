<?php

if (!class_exists('Table')) {
    require_once("/table.php");
}

class Auto extends Table {
    function __construct()
    {
        parent::__construct('auto');
    }
}

?>