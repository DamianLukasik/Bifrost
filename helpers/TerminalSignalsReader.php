<?php
class TerminalSignalsReader {
    private $params = array();
    private $paramslist = array();
    function __construct($paramslist=array(),$argv=array())
    {
        $this->setParamsList($paramslist);
        $this->loadArgv($argv);
    }
    function setParamsList($paramslist) {
        foreach ($paramslist as $paramslist_key => $paramslist_val ) {
            if (is_int($paramslist_key)) {
                $paramslist[$paramslist_val] = null;
                unset($paramslist[$paramslist_key]);
            }
        }
        $this->paramslist = $paramslist;
    }
    function checkParams($e) {
        if (!in_array($e[0], array_keys($this->paramslist))) {
            return false;
        }
        if(count($e) > 2) {
            $tmp = $e[0];
            unset($e[0]);
            $e=array($tmp,implode("=",$e));
        }
        if(count($e) == 2) {
            $this->params[$e[0]] = $e[1];
        }else{
            $this->params[$e[0]] = 0;
            if (isset($this->paramslist[$e[0]])) {
                $this->params[$e[0]] = $this->paramslist[$e[0]];
            }
        }
    }
    function loadArgv($argv=array()) {
        foreach ($argv as $arg) {
            if (strpos($arg, '.php') === false) {
                $e = explode("=",$arg);
                if(!$this->checkParams($e)) {
                    continue;
                }
            }
        }
    }
    function areEmptyParams()
    {
        if (empty($this->params)){
            return true;
        }
        return false;
    }
    function getParams() {
        if(!$this->areEmptyParams()){
            return $this->params;
        }
        return null;
    }
}
?>