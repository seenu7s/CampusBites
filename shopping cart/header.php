<header class="header">

   <div class="flex">

      <a href="#" class="logo">CampusBites</a>

      <nav class="navbar">
         <!--<a href="admin.php">add products</a>-->
         <a href="../food-website-main/index.html">Home</a>
         <a href="../food-website-main/about.html">About</a>
         <a href="others_file/user_register.php">Login</a>
         <a href="products.php">view products</a>

      

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>
      
         <a href="others_file/feadbak.php">Feedback</a>

      </nav>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>
   <script src="jsss/script.js"></script>

</header>