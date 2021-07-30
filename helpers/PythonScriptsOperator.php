<?php
class PythonScriptsOperator extends FilesOperator {
    private $removeFile = false;
    function __construct($filename='',$dataForTemplate=array(),$templateName='')
    {
        $this->path_to_skanes = "helpers/charmers/snakes/";
        $this->format = ".py";
        $this->filename = $filename;
        if (!empty($templateName) && !empty($dataForTemplate)) {
            $this->preparePythonScript($dataForTemplate,$templateName);
        }
    }
    private function createTemporaryFile(&$data,&$templateName) {
        if (!$this->IsfileExist()) {
            $content = $this->createContentbyTemplate($templateName,$data);
            $this->createScript(true,$content);
            $this->removeFile=true;
        }
    }
    private function createContentbyTemplate(&$templateName,&$data) {
        $content = '';
        switch ($templateName) {
            case 'QueryToDataBase':
                $content = "#-*- coding: utf-8 -*-\n";
                $content.= "columns = \"".$data['columnsDB']."\"\n";
                $content.= "table = \"".$data['tableDB']."\"\n";
                $content.= "orderby = \"".$data['orderbyDB']."\"\n";
                $content.= "import Table\n";
                $content.= "Table.query(columns,table,orderby)\n";
                break;
            default:
                break;
        }
        return $content;
    }
    function createScript($tmp=false,&$content) {
        $this->createFile($content,$tmp);
    }
    function preparePythonScript(&$data,$kindPythonScript) {
        $this->createTemporaryFile($data,$kindPythonScript);
    }
    function runScript($commands='') {
        require_once("/../helpers/charmers/SnakeCharmer.php");
        $sc = new SnakeCharmer($this->filename);
        $sc->run($commands);
        if ($this->removeFile) {
            $this->removeFile();
        }
        return $sc->showResult();
    }
}
?>