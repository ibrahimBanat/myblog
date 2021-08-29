<?php

require_once('../includes/confing.php');


// check whether user is logged or not

if($user->is_logged_in()) {header('location: index.php');}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="asssets/style.css"/>
</head>
<body>
    <div id="login">
        <?php
            //login form for submit
            if(isset($_POST['submit'])) {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);

                if($user->login($username, $password)){
                    //if logged in redirects to index.php
                    header('Location: index.php');
                    exit;
                } else {
                    $message = '<p class="invalid">Invalid username or Password</p>';

                }

            }
            if(isset($message)) {echo $message;};
        ?>
        <form action="" method="post" class="form">
            <label>Username</label>
            <input type="text" name="username" value="" required/>
            <br/>
            <label>Password</label>
            <input type="password" name="password" value="" required/>
            <br/>
            <lable></lable><input type="submit" name="submit" value="SignIn"/>

        </form>
    </div>
</body>
