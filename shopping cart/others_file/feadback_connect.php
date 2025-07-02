<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "feedback";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn) {
   // echo "connection ok";
}
else{
    echo "connection failed!".mysqli_connect_error();
}

// Close the connection

?>
