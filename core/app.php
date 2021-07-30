<?php

class App {
    protected $controller = "home";
    protected $method = "index";
    protected $params = array();
    public function __construct() {
        require_once("/controller.php");
        $url = '';
        if (!empty($_GET)) {
            $url = $this -> parseUrl();
            if (isset($url)) {
                if (file_exists("/../controllers/". $url[0] . '.php')) {
                    $this->controller = $url[0];
                    unset($url[0]);
                }
            }
        }
        require_once ("/../controllers/".$this->controller.".php");
        $this -> controller = new $this -> controller;
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $this -> loadParams($url);
        call_user_func_array(array($this -> controller, $this -> method), $this -> params);
    }

    public function parseUrl() {
        if(isset($_GET['url'])){
            return $url = explode("/", filter_var(rtrim($_GET["url"], "/"), FILTER_SANITIZE_URL));
        }
    }

    public function loadParams($url = array()) {
        $this -> params = $url ? array_values($url) : array();
        if (isset($_GET)) {
            $this -> params = array(http_build_query($_GET));
        }
    }
}

?>