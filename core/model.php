<?php

abstract class Model {
    protected $fileOperator = null;
    function __construct() {
        require_once("/../helpers/FilesOperator.php");
        $this->fileOperator = new FilesOperator();
    }
}

?>