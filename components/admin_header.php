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

<header class="header">

   <section class="flex">

      <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="dashboard.php">Beranda</a>
         <a href="products.php">Produk</a>
         <a href="placed_orders.php">Order</a>
         <a href="admin_accounts.php">Admin</a>
         <a href="users_accounts.php">Pengguna</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">edit profil</a>
         <div class="flex-btn">
            <a href="register_admin.php" class="option-btn">daftar</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('keluar dari web admin WoFy?');" class="delete-btn">keluar</a>
      </div>

   </section>

</header>