<?php

@include 'config.php';

// Check if nutritional columns exist, if not, redirect to fix_database.php
$check_columns = mysqli_query($conn, "SHOW COLUMNS FROM `products` LIKE 'calories'");
if(mysqli_num_rows($check_columns) == 0) {
    echo "<script>alert('Database needs to be updated. You will be redirected to the database update page.'); window.location.href='fix_database.php';</script>";
    exit();
}

if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$p_image;
   
   // Get nutritional information
   $calories = $_POST['calories'];
   $protein = $_POST['protein'];
   $carbs = $_POST['carbs'];
   $fat = $_POST['fat'];
   $fiber = $_POST['fiber'];
   $vitamins = $_POST['vitamins'];
   $minerals = $_POST['minerals'];
   $description = $_POST['description'];

   $insert_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image, calories, protein, carbs, fat, fiber, vitamins, minerals, description) 
   VALUES('$p_name', '$p_price', '$p_image', '$calories', '$protein', '$carbs', '$fat', '$fiber', '$vitamins', '$minerals', '$description')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:admin.php');
      $message[] = 'product could not be deleted';
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:admin.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:admin.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

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

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add a new product</h3>
   <input type="text" name="p_name" placeholder="enter the product name" class="box" required>
   <input type="number" name="p_price" min="0" placeholder="enter the product price" class="box" required>
   <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   
   <!-- Nutritional Information Fields -->
   <input type="number" name="calories" min="0" placeholder="Calories per serving" class="box" required>
   <input type="number" name="protein" min="0" step="0.1" placeholder="Protein (g)" class="box" required>
   <input type="number" name="carbs" min="0" step="0.1" placeholder="Carbohydrates (g)" class="box" required>
   <input type="number" name="fat" min="0" step="0.1" placeholder="Fat (g)" class="box" required>
   <input type="number" name="fiber" min="0" step="0.1" placeholder="Fiber (g)" class="box" required>
   <textarea name="vitamins" placeholder="Vitamins (e.g., Vitamin A, C, D...)" class="box" required></textarea>
   <textarea name="minerals" placeholder="Minerals (e.g., Iron, Calcium...)" class="box" required></textarea>
   <textarea name="description" placeholder="Product Description" class="box" required></textarea>
   
   <input type="submit" value="add the product" name="add_product" class="btn">
</form>

</section>

<section class="display-product-table">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` ORDER BY id DESC");
         if(mysqli_num_rows($select_products) > 0){
            while($row = mysqli_fetch_assoc($select_products)){
      ?>

      <div class="box">
         <img src="uploaded_img/<?php echo $row['image']; ?>" alt="">
         <h3><?php echo $row['name']; ?></h3>
         <div class="price">₹<?php echo $row['price']; ?>/-</div>
         
         <div class="nutrition-info">
            <h4>Nutritional Information (per serving)</h4>
            <div class="nutrition-grid">
               <div class="nutrition-item">
                  <span>Calories:</span> <?php echo $row['calories']; ?> kcal
               </div>
               <div class="nutrition-item">
                  <span>Protein:</span> <?php echo $row['protein']; ?>g
               </div>
               <div class="nutrition-item">
                  <span>Carbs:</span> <?php echo $row['carbs']; ?>g
               </div>
               <div class="nutrition-item">
                  <span>Fat:</span> <?php echo $row['fat']; ?>g
               </div>
               <div class="nutrition-item">
                  <span>Fiber:</span> <?php echo $row['fiber']; ?>g
               </div>
            </div>
            <div class="description">
               <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
               <p><strong>Vitamins:</strong> <?php echo $row['vitamins']; ?></p>
               <p><strong>Minerals:</strong> <?php echo $row['minerals']; ?></p>
            </div>
         </div>
         
         <div class="action-buttons">
            <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are you sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
            <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
         </div>
      </div>

      <?php
            };    
         }else{
            echo "<div class='empty'>no product added</div>";
         };
      ?>
   </div>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
      <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the prodcut" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>

<style>
.box-container {
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
   gap: 2rem;
   justify-content: center;
   padding: 2rem;
   max-width: 1200px;
   margin: 0 auto;
}

.box {
   text-align: center;
   padding: 2rem;
   box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
   border: 1px solid #eee;
   border-radius: 1rem;
   background: #fff;
   transition: transform 0.3s ease;
}

.box:hover {
   transform: translateY(-5px);
}

.box img {
   height: 25rem;
   width: 100%;
   object-fit: cover;
   border-radius: 0.5rem;
   margin-bottom: 1rem;
}

.box h3 {
   margin: 1rem 0;
   font-size: 2.2rem;
   color: #333;
}

.box .price {
   font-size: 2.2rem;
   color: var(--orange);
   margin-bottom: 1.5rem;
   font-weight: bold;
}

.nutrition-info {
   margin-top: 1.5rem;
   padding: 1.5rem;
   background: #f8f9fa;
   border-radius: 0.5rem;
   text-align: left;
}

.nutrition-info h4 {
   color: #333;
   margin-bottom: 1.2rem;
   font-size: 1.8rem;
   text-align: center;
}

.nutrition-grid {
   display: grid;
   grid-template-columns: repeat(2, 1fr);
   gap: 1.2rem;
   margin-bottom: 1.2rem;
}

.nutrition-item {
   font-size: 1.4rem;
   color: #555;
}

.nutrition-item span {
   font-weight: 600;
   color: #333;
}

.description {
   font-size: 1.4rem;
   color: #666;
   margin-top: 1.2rem;
   line-height: 1.6;
}

.description p {
   margin: 0.8rem 0;
}

.description strong {
   color: #333;
}

.action-buttons {
   display: flex;
   gap: 1rem;
   justify-content: center;
   margin-top: 1.5rem;
}

.action-buttons a {
   flex: 1;
   text-align: center;
   padding: 1rem;
   font-size: 1.4rem;
   border-radius: 0.5rem;
   transition: all 0.3s ease;
}

.delete-btn {
   background: #ff4444;
   color: white;
}

.delete-btn:hover {
   background: #cc0000;
}

.option-btn {
   background: var(--orange);
   color: white;
}

.option-btn:hover {
   background: #e67e00;
}

.empty {
   text-align: center;
   background-color: #f8f9fa;
   color: #666;
   font-size: 1.8rem;
   padding: 2rem;
   border-radius: 0.5rem;
   margin: 2rem auto;
   max-width: 50rem;
   box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
}
</style>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>