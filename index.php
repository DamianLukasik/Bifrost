<?php

$areTerminal = false;
if (isset($argv)) {
    //terminal
    if( $argv !=false ) {
        $commands =array('-p'=>false,'-l'=>false);
        $paramslist = array('-p'=>true,'-l'=>'-l=20');//default values of parameters -p=print -l=params for python scripts
        include "helpers/TerminalSignalsReader.php";
        $tsr = new TerminalSignalsReader($paramslist,$argv);
        $commands = array_merge($commands,$tsr->getParams());
        require_once("helpers/charmers/SnakeCharmer.php");
        $terminal = new SnakeCharmer('users');
        $terminal->run($commands['-l']);
        $items = $terminal->showResult($commands['-p']);
        if (is_array($items)) {
            foreach($items as $item){
                echo $item;
            }
        }
    }
} else {
    //website
    require_once("core/app.php");
    $app = new App();
}

?>