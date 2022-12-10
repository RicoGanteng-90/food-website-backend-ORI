<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update'])){

   $id = $_POST['id'];
   $id = filter_var($id, FILTER_SANITIZE_STRING);
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

   $update_partners = $conn->prepare("UPDATE `partners` SET name = ?, email = ?, number = ?, keterangan = ?, address = ? WHERE id = ?");
   $update_partners->execute([$name, $email, $number, $keterangan, $address, $id]);

   $message[] = 'partner updated!';


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Partners</title>

   <!-- Logo Title Bar -->
<link rel="icon" href="images/logofanny.png"
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

<!-- update partners section starts  -->

<section class="update-partners">

   <h1 class="heading">update partners</h1>

   <?php
      $update_id = $_GET['update'];
      $show_partners = $conn->prepare("SELECT * FROM `partners` WHERE id = ?");
      $show_partners->execute([$update_id]);
      if($show_partners->rowCount() > 0){
         while($fetch_partners = $show_partners->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $fetch_partners['id']; ?>">
      <span>update name</span>
      <input type="text" required placeholder="enter partner name" name="name" maxlength="100" class="box" value="<?= $fetch_partners['name']; ?>">
      <span>update email</span>
      <input type="email" name="email" required placeholder="enter partner email" maxlength="100" class="box" value="<?= $fetch_partners['email']; ?>">
      <span>update number phone</span>
      <input type="text" min="0" max="9999999999" required placeholder="enter partners number phone" name="number" class="box" onkeypress="if(this.value.length == 16) return false;" class="box" value="<?= $fetch_partners['number']; ?>">
      <span>update description</span>
      <textarea required placeholder="enter partner description" name="keterangan" maxlength="1000" class="box"><?php echo $fetch_partners['keterangan'];?></textarea>
      <span>update address</span>
      <textarea required placeholder="enter partner address" name="address" maxlength="1000" class="box"><?php echo $fetch_partners['address'];?></textarea>
      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="partners.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no partners added yet!</p>';
      }
   ?>

</section>

<!-- update product section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>