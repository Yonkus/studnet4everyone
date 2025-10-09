<?php

function isScreenRunning(){
    $screen = trim(shell_exec("screen -ls | grep internet"));
    if (empty($screen)) return false;
    foreach(explode("\n", $screen) as $line){
        $line = trim($line);
        if (preg_match("/\A\d+\.internet\s+/", $line))
            return true;
    }
    return false;
}