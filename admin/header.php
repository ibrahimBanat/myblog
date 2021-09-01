<link href="../assets/style.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css-min.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<ul class="ulclass">
    <?php echo $_SESSION['loggedin']?>
    <li><a href="../admin.php">Dashboard</a></li>
    <li><a href="blog-users.php">Users</a></li>
    <li><a href="../" target="_blank">Visit BLog</a></li>
    <li><a href="login.php">login</a></li>
    <li><a href="../logout.php">Logout</a></li>
</ul>
