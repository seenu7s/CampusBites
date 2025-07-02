<?php
include("feadback_connect.php"); // Ensure this file establishes the $conn connection

$Name = $_GET['id']; // Changed from 'Name' to 'id' to match the link

$query = "DELETE FROM feedbacktable WHERE Name ='$Name'";
$data = mysqli_query($conn, $query);

if ($data) {
    echo "Record Deleted";
} else {
    echo "Failed To Delete";
}
?>
