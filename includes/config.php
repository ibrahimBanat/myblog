<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ob_start();
session_start();
require_once('classes/class.user.php');
//database details
define('DBHOST','localhost');
define('DBUSER','ibrahim');
define('DBPASS','1234');
define('DBNAME','blog');

$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//set timezone- Asia Kolkata
date_default_timezone_set('Asia/Kolkata');

//load classes as needed
function autoload($class) {

    $class = strtolower($class);

    //if call from within assets adjust the path
    $classpath = 'classes/class.'.$class . '.php';
    if ( file_exists($classpath)) {
        require_once $classpath;
    }

    //if call from within admin adjust the path
    $classpath = '../classes/class.'.$class . '.php';
    if ( file_exists($classpath)) {
        require_once $classpath;
    }

    //if call from within admin adjust the path
    $classpath = '../../classes/class.'.$class . '.php';
    if ( file_exists($classpath)) {
        require_once $classpath;
    }
}
$user = new User($db);


