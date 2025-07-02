
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
           /* .Delete{
                
                color:black;
                border:0;
                outine:none;
                border-radius:5px;
                width:80px;
                font-weight:bold;
                cursor:pointer;
            }*/
        </style>
</head>
<body>
    
</body>
</html>


<?php
include("user_config.php"); // Ensure this file establishes the $conn connection
error_reporting(0);

// Query to fetch data from the table
$query = "SELECT * FROM `user_form`";
$data = mysqli_query($conn, $query);

if ($data) {
    $total = mysqli_num_rows($data);

    if ($total > 0) {
        ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-dark text-center col-lg-7" width="80%" align="center">
                        <thead>
                            <h2 align="center">Display Record</h2>
                            <tr>
                                <th width="10%">Email</th>
                                <th width="20%">Password</th>
                                <th width="10%">Operations</th>
                            </tr>
                        </thead>
        <?php
        while ($result = mysqli_fetch_assoc($data)) {
            echo "
            <tr>
                <td>{$result['email']}</td>
                <td>{$result['password']}</td>
                <td>
                    <a href='user_login_delete.php?id={$result['email']}'>
                        <input type='button' value='Delete' class='Delete'>
                    </a>
                </td>
            </tr>";
        }
        ?>
                    </table>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "No records found.";
    }
} else {
    echo "Error executing query: " . mysqli_error($conn);
}
?>
