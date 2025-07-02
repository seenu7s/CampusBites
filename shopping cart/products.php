<?php

@include 'config.php';

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      .nutrition-info {
         margin-top: 10px;
         padding: 10px;
         background: #f9f9f9;
         border-radius: 5px;
      }
      .nutrition-info h4 {
         color: #333;
         margin-bottom: 5px;
      }
      .nutrition-grid {
         display: grid;
         grid-template-columns: repeat(2, 1fr);
         gap: 10px;
         margin-bottom: 10px;
      }
      .nutrition-item {
         font-size: 14px;
      }
      .nutrition-item span {
         font-weight: bold;
      }
      .description {
         font-size: 14px;
         color: #666;
         margin-top: 10px;
      }
      .modal {
         display: none;
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: rgba(0,0,0,0.7);
         z-index: 1000;
      }
      .modal-content {
         position: relative;
         background: white;
         width: 80%;
         max-width: 600px;
         margin: 50px auto;
         padding: 20px;
         border-radius: 10px;
      }
      .close-modal {
         position: absolute;
         right: 20px;
         top: 10px;
         font-size: 24px;
         cursor: pointer;
      }
   </style>
</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">

<section class="products">

   <h1 class="heading">latest products</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">₹<?php echo $fetch_product['price']; ?>/-</div>
            
            <div class="nutrition-info">
               <h4>Nutritional Information (per serving)</h4>
               <div class="nutrition-grid">
                  <div class="nutrition-item">
                     <span>Calories:</span> <?php echo $fetch_product['calories']; ?> kcal
                  </div>
                  <div class="nutrition-item">
                     <span>Protein:</span> <?php echo $fetch_product['protein']; ?>g
                  </div>
                  <div class="nutrition-item">
                     <span>Carbs:</span> <?php echo $fetch_product['carbs']; ?>g
                  </div>
                  <div class="nutrition-item">
                     <span>Fat:</span> <?php echo $fetch_product['fat']; ?>g
                  </div>
                  <div class="nutrition-item">
                     <span>Fiber:</span> <?php echo $fetch_product['fiber']; ?>g
                  </div>
               </div>
               <button type="button" class="btn" onclick="showNutritionDetails(<?php echo htmlspecialchars(json_encode($fetch_product)); ?>)">
                  View Full Nutrition Info
               </button>
            </div>
            
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<!-- Nutrition Details Modal -->
<div id="nutritionModal" class="modal">
   <div class="modal-content">
      <span class="close-modal" onclick="closeModal()">&times;</span>
      <h2 id="modalTitle"></h2>
      <div id="modalContent"></div>
   </div>
</div>

<script>
function showNutritionDetails(product) {
    const modal = document.getElementById('nutritionModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');
    
    modalTitle.textContent = product.name + ' - Complete Nutritional Information';
    
    modalContent.innerHTML = `
        <div class="nutrition-info">
            <h4>Description</h4>
            <p>${product.description}</p>
            
            <h4>Macronutrients (per serving)</h4>
            <div class="nutrition-grid">
                <div class="nutrition-item">
                    <span>Calories:</span> ${product.calories} kcal
                </div>
                <div class="nutrition-item">
                    <span>Protein:</span> ${product.protein}g
                </div>
                <div class="nutrition-item">
                    <span>Carbohydrates:</span> ${product.carbs}g
                </div>
                <div class="nutrition-item">
                    <span>Fat:</span> ${product.fat}g
                </div>
                <div class="nutrition-item">
                    <span>Fiber:</span> ${product.fiber}g
                </div>
            </div>
            
            <h4>Vitamins</h4>
            <p>${product.vitamins}</p>
            
            <h4>Minerals</h4>
            <p>${product.minerals}</p>
        </div>
    `;
    
    modal.style.display = 'block';
}

function closeModal() {
    document.getElementById('nutritionModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('nutritionModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>