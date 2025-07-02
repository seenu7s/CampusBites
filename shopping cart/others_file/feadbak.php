<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen - Served delicious Food in Collage!</title>
     
    
     <!-- for icons  -->
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="feadback1.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../food-website-main/style1.css">
   
   
</head>

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
<body >
<header class="header">

   <div class="flex">
   
      <a href="#" class="logo">CampusBites</a>
   
      <nav class="navbar">
         <!--<a href="admin.php">add products</a>-->
         <a href="../../food-website-main/index.html">Home</a>
         <a href="../../food-website-main/about.html">About</a>
         <a href="user_register.php">Login</a>
         <a href="../products.php">view products</a>
         <a href="../cart.php" class="cart">cart </a>
         <a href="feadbak.php">Feedback</a>
      </nav>


     
    
   
      </nav>
   
      <div id="menu-btn" class="fas fa-bars"></div>
   
   </div>
</header>


<br><br><br><br>
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
<br><br><br><br><br>
   <!-- footer starts  -->
   <footer class="site-footer" id="contact">
                <div class="top-footer section">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="footer-info">
                                        <div class="footer-logo">
                                            <a href="index.html">
                                                <img src="logo.png" alt="">
                                            </a>
                                        </div>
                                        <p>Our campus features a bustling food court and canteen offering a wide array of culinary delights, ranging from breakfast to dinner.
                                        </p>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-instagram"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-github-alt"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-youtube"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="footer-flex-box">
                                        <div class="footer-table-info">
                                            <h3 class="h3-title">open hours</h3>
                                            <ul>
                                                <li><i class="uil uil-clock"></i> Mon-Thurs : 9am - 22pm</li>
                                                <li><i class="uil uil-clock"></i> Fri-Sun : 11am - 22pm</li>
                                            </ul>
                                        </div>
                                        <div class="footer-menu food-nav-menu">
                                            <h3 class="h3-title">Links</h3>
                                            <ul class="column-2">
                                                <li>
                                                    <a href="#home" class="footer-active-menu">Home</a>
                                                </li>
                                                <li><a href="#menu">About</a></li>
                                                <li><a href="#gallery">Login</a></li>
                                                <li><a href="#blog">View Products</a></li>
                                                <li><a href="#about">cart</a></li>
                                                <li><a href="#contact">Feedback</a></li>
                                            </ul>
                                        </div>
                                        <div class="footer-menu">
                                            <h3 class="h3-title">Brainware University</h3>
                                            <ul>
                                                <li><a href="#">Terms & Conditions</a></li>
                                                <li><a href="#">Privacy Policy</a></li>
                                                <li><a href="#">Cookie Policy</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div class="copyright-text">
                                    <p>Create &copy; 2024 <span class="name">Batch05.</span>All cradit Reserved.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button class="scrolltop"><i class="uil uil-angle-up"></i></button>
                    </div>
                </div>
            </footer>




  <!-- 
    - #BACK TO TOP
  -->





  <!-- 
    - custom js link
  -->
  
    <script  src="../food-website-main/assets/js/bootstrap.min.js"></script>
    <script  src="../food-website-main/assets/js/font-awesome.min.js"></script>
    <script  src="../food-website-main/assets/js/gsap.min.js"></script>
    <script  src="../food-website-main/assets/js/jquery-3.5.1.min.js"></script>
    <script  src="../food-website-main/assets/js/jquery.fancybox.min.js"></script>
    <script  src="../food-website-main/assets/js/jquery.mixitup.min.js"></script>
    <script  src="../food-website-main/assets/js/parallax.min.js"></script>
    <script  src="../food-website-main/assets/js/popper.min.js"></script>
    <script  src="../food-website-main/assets/js/ScrollToPlugin.min.js"></script>
    <script  src="../food-website-main/assets/js/ScrollTrigger.min.js"></script>
    <script  src="../food-website-main/assets/js/smooth-scroll.js"></script>
    <script  src="../food-website-main/assets/js/swiper-bundle.min.js"></script>
    

  <!-- 
    - ionicon link
  -->
  





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
<script src="../jsss/script.js"></script>
</body>
</html>