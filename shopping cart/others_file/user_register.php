<?php

@include 'user_config.php';
session_start();

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn,$_POST['usermail']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    
    $select = "SELECT * FROM `user_form` WHERE `email` ='$email' && `password` ='$pass'";

    $result = mysqli_query($conn,$select);

    if(mysqli_num_rows($result) > 0){
        $error[]='user already exist';
    }else{
        if($pass != $cpass){
            $error[] = 'password not matched!';
        }else{
            $insert = "INSERT INTO`user_form`(`email`, `password`) VALUES ('$email','$pass')";
            mysqli_query($conn,$insert);
            header('location:user_login.php');
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen - Served delicious Food in Collage!</title>
  
    <!--boot strap-->
    <!--boot strap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="user_login2.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
<style>
    /* Add this style to center the navbar when it's active (e.g., on mobile menu click) */
    .navbar.active {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: fixed; /* Or absolute, adjust as needed */
       
    }

   
</style>
<header class="header">

   <div class="flex">

      <a href="#" class="logo text-decoration-none">CampusBites</a>

      <nav class="navbar">
         <!--<a href="admin.php">add products</a>-->
         <a href="../../food-website-main/index.html"class="text-decoration-none">Home</a>
         <a href="../../food-website-main/about.html"class="text-decoration-none">About</a>
         <a href="user_register.php"class="text-decoration-none">Login</a>
         <a href="../products.php"class="text-decoration-none">view products</a>
         <a href="../cart.php" class="cart text-decoration-none">cart </span> </a>
         <a href="feadbak.php"class="text-decoration-none">Feedback</a>
      </nav>

      

      
      

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>








<!-- Bootstrap JS (required for navbar functionality) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-JZ1R8xU8xD8B7Yg8m2FhE3l0O4i6H8R0A4D0n9V8z5w5N5e5c5g5N5e5c5g5N5e5" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../jsss/script.js"></script>
  <div class="form-container">
    <form action=""method="post">
      <h3>register now</h3>
      <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }
      ?>
      <input type="email"name="usermail"placeholder="enter your email"class="box"required>

      <input type="password"name="password"placeholder="enter your password"class="box"required>

      <input type="password"name="cpassword"placeholder="conform your password"class="box"required>

      <input type="submit"value="register now"name="submit"class="from-btn"> 
      <p class="account">already have an account?<a href="user_login.php">login now</a></p>
    </form>

  </div>
  



</body>
</html>