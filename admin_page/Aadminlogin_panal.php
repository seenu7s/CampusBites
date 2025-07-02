

<?php
   session_start();
   if(!isset($_SESSION['AdminLoginId']))
   {
    header("location: admin_login.php");
   }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        *{
            background:;
        }
        body{
            margin:0;
            
        }
        .hader{
            font-family:poppins;
            display: flex;
            justify-content:space-between;
            align-items:center;
            padding:0px 60px;
            background #4cae4c;
        }
        button{
            background: yellow;
            font-size:16px;
            font-weight:550px;
            padding:8px 12px;
            border:2px solid black;
            border-radius:5px;
        }
        .navbar {
          display: flex;
          background-color: #333;
          padding: 10px;
          justify-content: center;
        }
        .navbar a {
          color: white;
          text-decoration: none;
          padding: 10px 20px;
          margin: 0 5px;
          text-align: center;
          border-radius: 5px;
          transition: background-color 0.3s;
        }
        .navbar a:hover {
          background-color: #575757;
        }
        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
        }
        h3{
            text-align: center;
            font-size:50px;
        }
        p{
            text-align: center;
        }
        .container1{
          display: flex;
          justify-content: center;
          align-items: center;
          height: 40vh; /* Adjust as needed */
        }
        
        img {
          max-width: 100%;
          height: auto;
        }
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
            }
            .navbar {
                flex-direction: column;
                display: none;
                text-align: center;
            }
            .navbar.active {
                display: flex;
            }
            .menu-toggle {
                display: block;
                background: none;
                border: none;
                color: black;
            }
          
        }
    </style>
</head>
<body>
    <div class="hader">
        <h1><?php echo $_SESSION['AdminLoginId'] ?>  </h1>
        <form method="POST">
            <button name="Logout">LOG OUT</button>
        </form> 
        <button id="menu-btn" class="menu-toggle">☰</button>
    </div>
    <div class="navbar"></a>
        <a href="shopping cart/adtocartfatch.php">Order</a>
        <a href="shopping cart/admin.php">Item Add and remove</a>
        <a href="feedback_and_login/feadback_admin.php">Feedback</a>
        <a href="feedback_and_login/user_login_featch.php">Login</a>
        <a href="../admin_page/web_rider">Scanner</a>
        
    </div>
    
<?php
      if(isset($_POST['Logout']))
      {
        session_destroy();
        header("Location: admin_login.php");
      }
    ?>

<div class="container">
        <div class="content">
            <h3>WELCOME TO ADMIN PANEL</h3>
            <p>Brainware University in Kolkata has a canteen and food court that serves a variety of food to students, faculty, and staff.</p>
            <p>Create &copy; 2024 <span class="name">Batch05.</span>All cradit Reserved.</p>
            
            <div class="container1">
                <img src="../food-website-main/assets/images/WhatsApp.png" alt="">
            </div>
            
        </div>
    </div>



    <script>
        let menuBtn = document.querySelector('#menu-btn');
        let navbar = document.querySelector('.navbar');
        menuBtn.onclick = () => {
            navbar.classList.toggle('active');
        };
        window.onscroll = () => {
            navbar.classList.remove('active');
        };
    </script>
</body>
</html>