<?php
if (!isset($_SESSION)) {
    session_start();
}

abstract class Controller {
    public function __construct() {
        require_once("/model.php");
    }
    public function model($model) {
        require_once "/../models/" . $model . ".php";//? co jeśli model nie istnieje?
        //?ładuje helpers/modelCreator? od tworzenia i niszczenia modeli? z FilesOperator?
        return new $model();//?przekierowanie na errorpage z komunikatem?
    }
    public function view($view, $data=array()) {
        require_once ("/../views/" . $view . ".php");
    }
    protected function explodeParams($params = "") {
        if (empty($params)) {
            return array();
        }
        $result = array();
        $params_ = explode('&',$params);
        foreach ($params_ as $item) {
            $item_ = explode('=',$item);
            $result[$item_[0]] = $item_[1];
        }
        return $result;
    }
}

?>