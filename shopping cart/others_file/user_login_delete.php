<?php
include("user_config.php"); // Ensure $conn is defined

// Fetch the email from the URL
$Name = $_GET['id'];

// Prepared statement to delete the record
$stmt = $conn->prepare("DELETE FROM user_form WHERE email = ?");
$stmt->bind_param("s", $Name);

// Execute the query and provide feedback
if ($stmt->execute()) {
    echo "Record Deleted";
} else {
    echo "Failed to Delete";
}
$stmt->close();
?>
