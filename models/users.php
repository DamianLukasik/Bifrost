<?php

if (!class_exists('Table')) {
    require_once("/table.php");
}

class Users extends Table {//?automatyczne tworzenie plików php?
    function __construct()
    {
        parent::__construct('users');
    }
}

?>