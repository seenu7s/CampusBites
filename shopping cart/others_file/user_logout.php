<?php
@include 'user_config.php';
session_start();
session_unset();
session_destroy();
header('location:user_login.php');
?>