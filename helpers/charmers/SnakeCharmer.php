<?php
class SnakeCharmer {
    private $files;
    private $results;
    private $command;
    private $format;
    private $path = 'helpers/charmers/snakes/';
    function checkPythonFormat(&$file)
    {
        $pos = strpos($file,".py");
        if ($pos === false) {
            $file .='.py';
        }
    }
    function __construct($files)
    {
        if (is_string($files)) {
            $this->checkPythonFormat($files);
            $this->files = array($this->path.$files);
        } else {
            foreach ($files as $file) {
                $this->checkPythonFormat($file);
                array_push($this->files, $this->path.$file);
            }
        }
        $this->results = array();
        $this->params = array();
        $this->format = 'python %s %s';
    }
    function run($params='')
    {
        foreach ($this->files as $file) {
            $this->command = escapeshellcmd(sprintf($this->format, $file, $params));
            $output = shell_exec($this->command);
            array_push($this->results, $output);
        }
    }
    function validatePrint(&$print)
    {
        if (is_string($print)) {
            switch($print) {
                case "1":
                    $print=true;
                    break;
                case "0":
                    $print=false;
                    break;
                default:
                    $print=false;
                    break;
            }
        }
        if (is_int($print)) {
            switch($print) {
                case 1:
                    $print=true;
                    break;
                case 0:
                    $print=false;
                    break;
                default:
                    $print=false;
                    break;
            }
        }
    }
    function showResult($print=false)
    {
        $this->validatePrint($print);
        if (!empty($this->results) && $print) {
            foreach ($this->results as $result) {
                echo $result;
            }
        } elseif (!empty($this->results) && !$print) {
            return $this->results;
        }
    }
}
?>