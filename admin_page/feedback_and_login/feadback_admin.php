
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
            body{
                background:;
            }
            table{
                background-color:white;
            }
            
        </style>
</head>
<body>
    
</body>
</html>
<?php
include("feadback_connect.php"); // Ensure this file establishes the $conn connection
error_reporting(0);

// Query to fetch data from the table
$query = "SELECT * FROM feedbacktable";
$data = mysqli_query($conn, $query); // Execute the query

if ($data) {
    $total = mysqli_num_rows($data); // Get total number of rows

    if ($total > 0) {
        // Display each row
        ?>
        <div class="container mt-5">
            <div class="row">
                <div class="clo-lg-12">
                    <table class="table table-dark text-center clo-lg-7"width="80%"align="center">
                    <thead>
                        <h2 align="center">Display Record</h2>
                            <tr>
                               <th width="10%">Name</th>
                               <th width="20%">Email</th>
                               <th width="10%">Opinion</th>
                               <th width="30%">Message</th>
                               <th width="10%">Operations</th>
                            </tr>
                   </thead>
        <?php
        while ($result = mysqli_fetch_assoc($data)) {
            echo " <tr>
                    <td>".$result['Name']."</td>
                    <td>".$result['Email']."</td>
                    <td>".$result['Opinion']."</td>
                    <td>".$result['Message']."</td>
                     

                    
                    <td><a href='delete_feedback.php?id={$result['Name']}'><input 
                        type='submit'value='Delete'class='Delete'></a></td>
                   </tr>
                   ";
           
        }
        echo "";//Total records: $total
    } else {
        echo "No records found.";
    }
} else {
    echo "Error executing query: " . mysqli_error($conn);
}
?>
</table>
