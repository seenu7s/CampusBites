<?php
@include 'user_config.php';
session_start();
if(!isset($_SESSION['usermail'])){
    header('location:user_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="user_login2.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <h3>Welcome</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem facere sint saepe incidunt odio, sunt similique ipsam rem ducimus et iure, accusamus qui ex voluptates tenetur repudiandae cumque, at aut.</p>
            <p>your email :<span><?php  echo $_SESSION['usermail'];?></span></p>
            <a href='user_logout.php'class="logout">Logout</a>
        </div>
    </div>
</body>
</html>