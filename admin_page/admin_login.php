
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" 
          integrity="sha384-vp86vTRFvjPbKPT5nY8cTTF+suKyoibJri3skH2e71KRRKUcI38Rymf6YDLt4i2s" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
    <div class="login-form">
        <h2>ADMIN LOGIN PANEL</h2>
        <form method="POST">
            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Admin Name"name="AdminName">
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password"name="AdminPassword">
            </div>
            <button type="submit"name="Signin">Sign In</button>
            <div class="extra">
                <a href="#">Forgot Password?</a>
            </div>
        </form>
    </div>

<?php
include("Connection.php");
?>
<?php
if (isset($_POST["Signin"]))
{
    
    $query="SELECT * FROM `admin_login` WHERE `Admin_name`='$_POST[AdminName]'AND Admin_password='$_POST[AdminPassword]'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1)
    {
      $_SESSION['AdminLoginId']=$_POST['AdminName'];
      header("location:Aadminlogin_panal.php");
    }
    else
    {
        echo"<script>alert('incorrect Password')</script>";
    }
}
?>

</body>
</html>
