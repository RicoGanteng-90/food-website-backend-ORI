<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_partners'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $keterangan = $_POST['keterangan'];
   $keterangan = filter_var($keterangan, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $select_partners = $conn->prepare("SELECT * FROM `partners` WHERE name = ?");
   $select_partners->execute([$name]);

   if($select_partners->rowCount() > 0){
      $message[] = 'nama partner sudah ada!';
   }else{
         $insert_partners = $conn->prepare("INSERT INTO `partners`(name, email, number, keterangan, address) VALUES(?,?,?,?,?)");
         $insert_partners->execute([$name, $email, $number, $keterangan, $address]);

         $message[] = 'partner berhasil ditambahkan!';

   }

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_partners = $conn->prepare("DELETE FROM `partners` WHERE id = ?");
   $delete_partners->execute([$delete_id]);
   header('location:partners.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Partner / Mitra kerja</title>

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

<!-- add partners section starts  -->

<section class="add-partners">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>tambahkan partner</h3>
      <input type="text" required placeholder="masukan nama partner" name="name" maxlength="100" class="box">
      <input type="email" name="email" required placeholder="masukan email partner" maxlength="100" class="box">
      <input type="text" required placeholder="masukan nomor telepon partner" name="number" onkeypress="if(this.value.length == 16) return false;" class="box">
      <textarea required placeholder="deskripsi partner" name="keterangan" maxlength="1000" class="box"></textarea>
      <textarea required placeholder="masukan alamat partner" name="address" maxlength="1000" class="box"></textarea>
      <input type="submit" value="tambahkan partner" name="add_partners" class="btn">
   </form>

</section>

<!-- add partners section ends -->

<!-- show partners section starts  -->

<section class="show-partners" style="padding-top: 0;">

<div class="box-container">
   <div class="box">
   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <tr>
         <thead>
            <tr>
               <th>nama</th>
               <th>email</th>
               <th>nomor telepon</th>
               <th>deskripsi</th>
               <th>alamat</th>
               <th>aksi</th>
         </tr>
         </thead>
      </tr>
      <?php
      $show_partners = $conn->prepare("SELECT * FROM `partners` ORDER BY id DESC");
      $show_partners->execute();
      if($show_partners->rowCount() > 0){
         while($fetch_partners = $show_partners->fetch(PDO::FETCH_ASSOC)){  
      ?>
         <tr>
            <td><span><?= $fetch_partners['name']; ?></span></td>
            <td><span><?= $fetch_partners['email']; ?></span></td>
            <td><span><?= $fetch_partners['number']; ?></span></td>
            <td><span><?= $fetch_partners['keterangan']; ?></span></td>
            <td><span><?= $fetch_partners['address']; ?></span></td>
            <td><div class="flex-btn">
               <a href="update_partners.php?update=<?= $fetch_partners['id']; ?>" class="option-btn-aksi">edit</a>
               <a href="partners.php?delete=<?= $fetch_partners['id']; ?>" class="delete-btn-aksi" onclick="return confirm('delete this partner?');">hapus</a>
            </div></td>
         </tr>
         <?php
            $fetch_partners['id']++;
         ?>
      <?php
         }
      }else{
         echo '';
      }
      ?>
   </table>
   </div>
</div>
</section>

<!-- show products section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>