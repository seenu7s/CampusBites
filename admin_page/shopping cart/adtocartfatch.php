<?php
@include 'config.php'; 
?>

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
            .Delete{
                
                color:black;
                border:0;
                outine:none;
                border-radius:5px;
                width:80px;
                font-weight:bold;
                cursor:pointer;
              }
              .table-container {
              margin-top: 50px;
              overflow-x: auto;
  
              }
            
        </style>
</head>
<body>
<div class="container mt-5 show-order">
  <h3 class="text-center">Display The Recorde</h3>
    <div class="row">
        <div class="clo-lg-12">
            <table class="table table-dark text-center">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Customer Name</th>
                  <th scope="col">Phone No</th>
                  <th scope="col">Email</th>
                  <th scope="col">Method</th>
                  <th scope="col">Flat</th>
                  <th scope="col">Street</th>
                  <th scope="col">City</th>
                  <th scope="col">Country</th>
                  <th scope="col">Pin_code</th>
                  <th scope="col">Total_products</th>
                  <th scope="col">Total_price</th>
                  <th scope="col">State</th>
                  <th scope="col">Operation</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query="SELECT * FROM `order`";
                  $user_result=mysqli_query($conn,$query);
                  while($user_fetch=mysqli_fetch_assoc($user_result))
                  {
                    echo"
                      <tr>
                        <th>$user_fetch[id]</th>
                        <th>$user_fetch[name]</th>
                        <th>$user_fetch[number]</th>
                        <th>$user_fetch[email]</th>
                        <th>$user_fetch[method]</th>
                        <th>$user_fetch[flat]</th>
                        
                        <th>$user_fetch[street]</th>
                        <th>$user_fetch[city]</th>
                        
                        <th>$user_fetch[country]</th>
                        <th>$user_fetch[pin_code]</th>
                        <th>$user_fetch[total_products]</th>
                        <th>$user_fetch[total_price]</th>
                        <th>$user_fetch[state]</th>
                   
                       <td>
                          <table class='table  text-center'>
                          <td><a href='deleted_adtocart.php?name={$user_fetch['name']}'><input 
                          type='submit'value='Delete'class='Delete'></a></td>
                            
                            <tbody>
                        "; 
                           
                      echo"
                              </tbody>
                          </table>
                        </td>
                      </tr>
                    ";
                  }
                ?>
              </tbody>
            </table>
        </div>
    </div>

    
</div>
</body>
</html>