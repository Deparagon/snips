<?php


function autoload($classname)
{
    $file = dirname(__FILE__).'/classes/'.$classname.'.php';

    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('autoload');
