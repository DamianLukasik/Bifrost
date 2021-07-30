<?php

class Main extends Model {
    function show($params = array()) {
        return array('StyleFile'=>'style.css','title' => 'Hello World', 'header' => 'Naglowek', 'footer' => 'Stopka', 'menu' => 'Menu', 'content' => 'zawartosc');
    }
}

?>