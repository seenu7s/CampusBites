<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen - Served delicious Food in Collage!</title>
  
    <!-- 
      - favicon
    -->
    <link rel="shortcut icon" href="./favicon.png" type="image/svg+xml">
  
    <!-- 
      - custom css link
    -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="feadback1.css">
  
    <!-- 
      - google font link
    -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Rubik:wght@400;500;600;700&family=Shadows+Into+Light&display=swap"
      rel="stylesheet">
  
    <!-- 
      - preload images
    -->
    <link rel="preload" as="image" href="hero-banner.png" media="min-width(768px)">
    <link rel="preload" as="image" href="hero-banner-bg.png" media="min-width(768px)">
    <link rel="preload" as="image" href="hero-bg.jpg">
</head>
<body id="top">
    <!-- 
    - #HEADER
  -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="Shoping_index.php">Canteen</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <!--<a class="nav-link active" aria-current="page" href="Shoping_index.php">Home</a>-->
        </li>    
      </ul>
      
      <div class="main-navigation">                 
          <nav class="header-menu">
              <ul class="menu food-nav-menu">
                  <li><a href="food-website-main/index.html">Home</a></li>
                  <li><a href="food-website-main/about.html">About</a></li>
                  <li><a class="nav-link active" aria-current="page" href="Shoping_index.php">Menu</a></li>
                  <li><a href="Shoping_cart.php"class="btn btn-success">Add To cart</a></li>
                  <li><a href="feadbak.php">Feedback</a></li>
                  <li><a href="user_register.php">Login</a></li>
                    <div>
                      <?php
                       $count=0;
                        if(isset($_SESSION['card']))
                        {
                          $count=count($_SESSION['card']);
                        }
                      ?>
                      <a href="Shoping_cart.php"class="btn btn-success">Order Now (<?php  echo $count;?>)</a>
                    </div>
              </ul>
          </nav>
      </div>    
          <!--<div>
           <?php
            /*$count=0;
             if(isset($_SESSION['card']))
             {
               $count=count($_SESSION['card']);
             }*/
           ?>
           <a href="Shoping_cart.php"class="btn btn-success">Order Now (<?php  /*echo $count;*/?>)</a>
         </div>-->
    </div>
  </div>
</nav>





  



  <!--
    --#FROM
  -->
   
  
    
    <form method="post"class="form-contener">
      <table>
        <tr>
          <td>Name :</td>
        <td><input type="text" name="name" id=""></td>
        </tr>

        <tr>
          <td>Email :</td>
        <td><input type="email" name="email" id=""></td>
        </tr>
        
        <tr>
          <td>Opinion :</td>
            <td>
              <select name="opinion" aria-label="Total person" class="input-field">
                <option value="1star">1star</option>
                <option value="2star">2star</option>
                <option value="3star">3star</option>
                <option value="4star">4star</option>
                <option value="5star">5star</option>
              </select> 
            </td>  
        </tr>
        

        <tr>
          <td>Message :</td>
        <td><textarea name="message" id=""rows="2" cols="2"></textarea></td>
        </tr>

        <tr>
          <td></td>
        <td><input type="submit" name="saveBtn" id="" value="save Feedback"></td>
        </tr>
        
      </table>
    </form>

    



    <!-- 
    - #FOOTER
    -->

  <footer class="footer">

    <div class="footer-top" style="background-image: url('footer-illustration.png')">
      <div class="container">

        <div class="footer-brand">

          <a href="#" class="logo">PET<span class="span">PUJA's</span><span class="span">.</span></a>

          <p class="footer-text">
            Financial experts support or help you to to find out which way you can raise your funds more.
          </p>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-pinterest"></ion-icon>
              </a>
            </li>

          </ul>

        </div>
       <div class="stup">
        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Contact Info</p>
          </li>

          <li>
            <p class="footer-list-item">+91 7602284691</p>
          </li>

          <li>
            <p class="footer-list-item">created by batch 005</p>
          </li>

          <li>
            <address class="footer-list-item"> 398,Ramkrishnapur,Near by Brainware University , 
              BARASAT 700124, Barasat, West Bengal 700124</address>
          </li>

        </ul>
        </div>
        <div class="stup">
        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Opening Hours</p>
          </li>

          <li>
            <p class="footer-list-item">Monday-Saturday:11:00-03:00</p>
          </li>

          <li>
            <p class="footer-list-item">Tuesday 4PM:Till Evining</p>
          </li>

          <li>
            <p class="footer-list-item">Saturday: 10:00-:4:00</p>
          </li>

        </ul>
        </div>
        

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <p class="copyright-text">
          &copy; 2024 <a href="#" class="copyright-link">created by batch 005</a> All Rights Reserved.
        </p>
      </div>
    </div>

  </footer>





  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
    <ion-icon name="chevron-up"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="feadback.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>





<!-- 
  
PHP
 


--->
<?php
include("feadback_connect.php");
?>
  <?php
    
    if(isset($_POST["saveBtn"])){
      $name =$_POST["name"];
      $email =$_POST["email"];
      $opinion =$_POST["opinion"];
      $message =$_POST["message"];

      $conn = new mysqli("localhost","root","","feedback");
      $query ="INSERT INTO feedbacktable  VALUES ('$name', '$email', '$opinion', '$message')";
      if($conn->query($query)){
          echo "<script>alert('Feedback is saved successfully!');</script>";
      }else{
        echo "<script>alert('Error: Could not save your feedback. Please try again.');</script>";
      }
      $conn->close();
    }
  ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-JZ1R8xU8xD8B7Yg8m2FhE3l0O4i6H8R0A4D0n9V8z5w5N5e5c5g5N5e5c5g5N5e5" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>