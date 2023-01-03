<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/head.css">
</head>
<body>

<header class="header">

   <section class="flex">

      <a class="logo" href="home.php">
        <img class="z" src="images/logofanny.png" width="35" height="35"> &nbsp; Fanny Wedding Organizer
      </a>
        
      <nav class="navbar">
         <a href="home.php">Beranda</a>
         <a href="about.php">Tentang</a>
         <a href="menu.php">Produk</a>
         <a href="orders.php">Order</a>
         <a href="contact.php">Kontak</a>
         <a href="showreview.php">Testimoni</a>
      </nav>

      <div class="icons">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn">Profil</a>
            <a href="components/user_logout.php" onclick="return confirm('keluar dari web WoFy?');" class="delete-btn">keluar</a>
         </div>
         <p class="account">
            <a href="login.php">Masuk</a>  /  
            <a href="register.php">Daftar</a>
         </p> 
         <?php
            }else{
         ?>
            <p class="name">Silahkan masuk terlebih dahulu!</p>
            <a href="login.php" class="btn">Masuk</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>
</body>
</html>