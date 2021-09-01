<?php

//include config php file

require_once('./includes/config.php');
require_once('./classes/class.user.php');

//log out user


$user->logout();
header('Location: index.php');