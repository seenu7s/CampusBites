<?php
@include 'config.php'; // Ensure this file establishes the $conn connection

$Name = $_GET['name']; 

$query = "DELETE FROM `order` WHERE name ='$Name'";
$data = mysqli_query($conn, $query);

if ($data) {
    echo "Record Deleted";
} else {
    echo "Failed To Delete";
}
?>