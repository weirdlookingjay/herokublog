<?php
session_start();
spl_autoload_register(function($class){
    require 'classes/'.$class.'.php';
});

//Load enf file
//(new DotEnv(dirname(__DIR__.'../') . DIRECTORY_SEPARATOR . '.env'))->load();

echo dirname(__DIR__.'../') . DIRECTORY_SEPARATOR . '.env';