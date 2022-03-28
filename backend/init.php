<?php
session_start();
spl_autoload_register(function($class){
    require 'classes/'.$class.'.php';
});

//Load env file
(new DotEnv(dirname(__DIR__.'../') . DIRECTORY_SEPARATOR . '.env'))->load();

$userObj = new Users;
$dashObj = new Dashboard;

