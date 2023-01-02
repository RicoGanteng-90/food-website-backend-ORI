<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Beranda</title>

   <!-- Logo Title Bar -->
   <link rel="icon" href="../images/logofanny.png"
   type="image/x-icon" class="LOGO">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   
   <!-- font google --> 
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      type="text/css" media="all"/>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC%3A400%2C700%7CLato%3A400%2C700%2C400italic%2C700italic&amp;ver=4.9.8"
      type="text/css" media="screen"/>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
   
   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

   <div class="box">
      <h3>Selamat Datang &nbsp <?= $fetch_profile['name']; ?>☺️ </h3>
      <a href="update_profile.php" class="btn">edit profil</a>
   </div>

   <div class="box">
      <?php
         $total_belum = 0;
         $select_belum = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_belum->execute(['Belum Lunas']);
         while($fetch_belum = $select_belum->fetch(PDO::FETCH_ASSOC)){
            $total_belum += $fetch_belum['total_price'];
         }
      ?>
      <h3><span>Rp. </span><?php echo " " . number_format ($total_belum,0,',','.'); ?><span></span></h3>
      <a href="belum_lunas.php" class="btn">Order Belum Lunas</a>
   </div>

   <div class="box">
      <?php
         $total_lunas = 0;
         $select_lunas = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_lunas->execute(['lunas']);
         while($fetch_lunas = $select_lunas->fetch(PDO::FETCH_ASSOC)){
            $total_lunas += $fetch_lunas['total_price'];
         }
      ?>
      <h3><span>Rp. </span><?php echo " " . number_format ($total_lunas,0,',','.'); ?><span></span></h3>
      <a href="lunas.php" class="btn">Order Lunas</a>
   </div>

   <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $numbers_of_orders = $select_orders->rowCount();
      ?>
      <h3><?= $numbers_of_orders; ?></h3>
      <a href="placed_orders.php" class="btn">Lihat Order</a>
   </div>

   <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $numbers_of_products = $select_products->rowCount();
      ?>
      <h3><?= $numbers_of_products; ?></h3>
      <a href="products.php" class="btn">lihat produk</a>
   </div>

   <div class="box">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
      <h3><?= $numbers_of_users; ?></h3>
      <a href="users_accounts.php" class="btn">data pengguna</a>
   </div>

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h3><?= $numbers_of_admins; ?></h3>
     
      <a href="admin_accounts.php" class="btn">data admin</a>
   </div>

   <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $numbers_of_messages = $select_messages->rowCount();
      ?>
      <h3><?= $numbers_of_messages; ?></h3>
      <a href="messages.php" class="btn">lihat pesan</a>
   </div>

   <div class="box">
      <?php
         $select_employees = $conn->prepare("SELECT * FROM `employees`");
         $select_employees->execute();
         $numbers_of_employees = $select_employees->rowCount();
      ?>
      <h3><?= $numbers_of_employees; ?></h3>
      <a href="employees.php" class="btn">data karyawan</a>
   </div>

   <div class="box">
      <?php
         $select_partners = $conn->prepare("SELECT * FROM `partners`");
         $select_partners->execute();
         $numbers_of_partners = $select_partners->rowCount();
      ?>
      <h3><?= $numbers_of_partners; ?></h3>
      <a href="partners.php" class="btn">data partner</a>
   </div>

   </div>

</section>

<!-- admin dashboard section ends -->









<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>