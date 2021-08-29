<?php
ob_start();
session_start();

//Database Details

define('DBHOST', 'localhost');
define('DBUSER', 'ibrahim');
define('DBPASS', '1234');
define('DBNAME', 'blog');


$db = new PDO("mysql:host=".DBHOST."dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Set the time zone
date_default_timezone_set('africa/cairo');


//Auto load classes

function __autoload($class){
    $class = strtolower($class);

    //if call from within assets adjust the path

    $classPath = 'classes/class.'.$class . '.php';
    if(file_exists($classPath)) {
        require_once $classPath;
    }
    //if the call within the assets adjust the path

    $classPath = '../classes/class.'. $class . '.php';
    if (file_exists($classPath)) {
        require_once $classPath;
    }
    //if the call from within admin adjust the path

    $classPath = '../../classes/class'. $class . '.php';

    if(file_exists($classPath)) {
        require_once $classPath;
    }


}

$user = new User($db);