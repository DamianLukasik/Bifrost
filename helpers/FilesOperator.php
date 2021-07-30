<?php
class FilesOperator {
    protected $path_to_skanes = "/";
    protected $format = ".txt";
    protected $filename = '';
    function __construct(&$filename='')
    {
        $this->filename = $filename;
    }
    function setFormatFile($format_file='') {
        $this->format = $format_file;
    }
    function IsfileExist() {
        return file_exists($this->path_to_skanes.$this->filename.$this->format);
    }
    function generateFilename($length = 10) {
        $this->filename = $this->filename.'_'.substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    function createFile($content,$generate=false) {
        if ($generate) {
            $this->generateFilename();
        }
        $fp = fopen($this->path_to_skanes.$this->filename.$this->format,"wb");
        fwrite($fp,$content);
        fclose($fp);
    }
    function removefile() {
        unlink($this->path_to_skanes.$this->filename.$this->format);
    }
    function getTableStruct($name = '') {
        if (empty($name)) {
            return array();
        }
        $ini_array = parse_ini_file("/../conf.ini",true);
        return $ini_array[strtoupper($name)];
    }
}
?>