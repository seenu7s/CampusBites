<?php

@include 'config.php';

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}

if(isset($_POST['update_quantity'])){
   $update_id = $_POST['update_id'];
   $update_quantity = (int)$_POST['update_quantity'];
   
   // Debug information
   error_log("Updating quantity for ID: " . $update_id . " to: " . $update_quantity);
   
   // Validate quantity
   if($update_quantity > 0) {
      $update_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'");
      
      if($update_query) {
         error_log("Quantity updated successfully");
         header('location:cart.php');
         exit();
      } else {
         error_log("Error updating quantity: " . mysqli_error($conn));
         echo '<div class="message"><span>Error updating quantity. Please try again.</span></div>';
      }
   } else {
      echo '<div class="message"><span>Invalid quantity. Please enter a number greater than 0.</span></div>';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .nutrition-summary {
         margin-top: 20px;
         padding: 20px;
         background: #f9f9f9;
         border-radius: 5px;
      }
      .nutrition-summary h3 {
         color: #333;
         margin-bottom: 15px;
      }
      .nutrition-grid {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
         gap: 15px;
         margin-bottom: 15px;
      }
      .nutrition-item {
         background: white;
         padding: 10px;
         border-radius: 5px;
         box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      }
      .nutrition-item span {
         font-weight: bold;
         color: #333;
      }
   </style>

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="shopping-cart">

   <h1 class="heading">shopping cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
         $grand_total = 0;
         $total_calories = 0;
         $total_protein = 0;
         $total_carbs = 0;
         $total_fat = 0;
         $total_fiber = 0;
         
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
               // Get product details including nutritional info
               $product_query = mysqli_query($conn, "SELECT * FROM `products` WHERE name = '{$fetch_cart['name']}'");
               $product = mysqli_fetch_assoc($product_query);
               
               $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
               $grand_total += $sub_total;
               
               // Calculate total nutritional values
               $total_calories += $product['calories'] * $fetch_cart['quantity'];
               $total_protein += $product['protein'] * $fetch_cart['quantity'];
               $total_carbs += $product['carbs'] * $fetch_cart['quantity'];
               $total_fat += $product['fat'] * $fetch_cart['quantity'];
               $total_fiber += $product['fiber'] * $fetch_cart['quantity'];
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>₹<?php echo $fetch_cart['price']; ?>/-</td>
            <td>
               <form action="" method="post" class="quantity-form">
                  <input type="hidden" name="update_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>" class="quantity-input" required>
                  <input type="submit" value="update" name="update_quantity" class="option-btn">
               </form>
            </td>
            <td>₹<?php echo $sub_total; ?>/-</td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('remove item from cart?');">remove</a></td>
         </tr>
         <?php
            };
         }else{
            echo '<tr><td style="text-align: center;" colspan="6">no items added</td></tr>';
         }
         ?>
         <tr class="table-bottom">
            <td colspan="4">grand total :</td>
            <td>₹<?php echo $grand_total; ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">delete all</a></td>
         </tr>

      </tbody>

   </table>

   <?php if($grand_total > 0) { ?>
   <div class="nutrition-summary">
      <h3>Total Nutritional Information</h3>
      <div class="nutrition-grid">
         <div class="nutrition-item">
            <span>Total Calories:</span> <?php echo $total_calories; ?> kcal
         </div>
         <div class="nutrition-item">
            <span>Total Protein:</span> <?php echo $total_protein; ?>g
         </div>
         <div class="nutrition-item">
            <span>Total Carbs:</span> <?php echo $total_carbs; ?>g
         </div>
         <div class="nutrition-item">
            <span>Total Fat:</span> <?php echo $total_fat; ?>g
         </div>
         <div class="nutrition-item">
            <span>Total Fiber:</span> <?php echo $total_fiber; ?>g
         </div>
      </div>
   </div>
   <?php } ?>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
   </div>

</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>