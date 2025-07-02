<?php

@include 'user_config.php';
session_start();

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn,$_POST['usermail']);
    $pass = md5($_POST['password']);
    
    
    $select = "SELECT * FROM `user_form` WHERE `email` ='$email' && `password` ='$pass'";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['usermail'] = $email;
        header('location:user_header.php');
    }else{
       $error[] = 'incorrect email or password';
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="user_login2.css">
    
</head>
<body id="top">


<nav class="navbar navbar-expand-lg navbar-dark bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="Shoping_index.php">Canteen</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="main-navigation">                 
          <nav class="header-menu">
              <ul class="menu food-nav-menu">
                  <li><a class="nav-link active"href="food-website-main/index.html">Home</a></li>
                  <li><a class="nav-link active" href="food-website-main/about.html">About</a></li>
                  <li><a class="nav-link active" aria-current="page" href="Shoping_index.php">Menu</a></li>
                  <li><a href="Shoping_cart.php" class="btn btn-success">Add To Cart</a></li>
                  <li><a class="nav-link active"href="feadbak.php">Feedback</a></li>
                  <li><a class="nav-link active"href="user_register.php">Login</a></li>
                  <?php
                       $count = 0;
                        if (isset($_SESSION['card'])) {
                          $count = count($_SESSION['card']);
                        }
                      ?>
                      <a href="Shoping_cart.php" class="btn btn-success">Order Now (<?php echo $count; ?>)</a>
                  
              </ul>
          </nav>
      </div>    
    </div>
  </div>
</nav>

<!-- Bootstrap JS (required for navbar functionality) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-JZ1R8xU8xD8B7Yg8m2FhE3l0O4i6H8R0A4D0n9V8z5w5N5e5c5g5N5e5c5g5N5e5" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>




   
  <div class="form-container">
    <form action=""method="post">
      <h3>LOgin Now</h3>
      <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }
      ?>
      <input type="email"name="usermail"placeholder="enter your email"class="box"required>
      <input type="password"name="password"placeholder="enter your password"class="box"required>
      <input type="submit"value="login now"name="submit"class="from-btn"> 
      <p class="account">don't have an account?<a href="user_register.php">register</a></p>
    </form>

  </div>
  

 
</body>
</html>