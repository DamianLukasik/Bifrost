<?php

abstract class Table extends Model {
    private $delimiter = '|';
    protected $title = '';
    protected $limit = 10;
    protected $color = '';
    protected $data = array();
    protected $columns = array();
    protected $table = '';

    protected $tableDB = '';
    protected $columnsDB = '';
    protected $orderbyDB = '';

    function __construct($name='')
    {
        parent::__construct();
        if (!empty($name)) {
            $fields = $this->fileOperator->getTableStruct($name);
            $this->setFields($fields);
        }
    }

    function setFields(&$fields) {
        if (isset($fields['columns'])) {
            $str_columnsDB = array();
            $this->columns[] = 'id';
            foreach ($fields['columns'] as $key_col => $val_col) {
                $this->columns[] = $val_col;
                $str_columnsDB[] = $key_col;
            }
            $this->columnsDB = implode(', ',$str_columnsDB);
        }
        $fields_name = array('title','table','tableDB','orderbyDB');
        foreach ($fields_name as $val_fields_name) {
            if (isset($fields[$val_fields_name])) {
                $this->$val_fields_name = $fields[$val_fields_name];
            }
        }
    }

    function show($params = array()) {
        $this->init($params);
        $this->createTable($this->table);
        $result = array('content' => $this->data);
        return $result;
    }

    function init(&$params) {
        $this->data['parent'] = 'table';
        $fields = array('color','limit','columns','table','title');
        foreach ($fields as $field) {
            if (isset($params[$field])) {
                $this->$field = $params[$field];
            }
        }
        $this->data['title'] = $this->title;
    }

    function createTable($script='table') {
        $items = $this->getItems($script);
        if (is_array($items)) {
            foreach ($items as $item) {
                $lines = explode("\n",$item);
                $rows = array();
                $this->data['header'] = array($this->color=>$this->columns);
                foreach ($lines as $line) {
                    $calls = explode($this->delimiter,$line);
                    if (count($calls)<2) {
                        continue;
                    }
                    foreach ($calls as $key_call => $call) {
                        $calls[$this->data['header'][$this->color][$key_call]]=trim($call);
                        unset($calls[$key_call]);
                    }
                    $rows[] = $calls;
                }
                $this->data['rows'] = $rows;
            }
            $this->data['color'] = $this->color;
        }
    }

    function getItems($file='table') {
        require_once("/../helpers/PythonScriptsOperator.php");
        $toAppend = array('columnsDB'=>$this->columnsDB,'tableDB'=>$this->tableDB,'orderbyDB'=>$this->orderbyDB);
        $this->fileOperator = new PythonScriptsOperator($file,$toAppend,'QueryToDataBase');
        $commands = '-l='.$this->limit;
        return $this->fileOperator->runScript($commands);
    }
}

?>