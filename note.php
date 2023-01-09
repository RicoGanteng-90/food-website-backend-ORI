<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Order</title>

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
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include '../components/admin_header.php' ?>

<!-- placed orders section starts  -->

<section class="placed-orders">

   <h1 class="heading">Order Lunas</h1>

   <div class="box-container">

   
   <div class="box">
   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
         <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Email</td>
            <td>Nomor Telepon</td>
            <td>Alamat</td>
            <td>Waktu Acara</td>
            <td>Total Pembayaran</td>  
            <td>Bukti Pembayaran</td>
            <td>Status Pembayaran</td>                     
         </tr>
      </thead>
      
      <?php      
      $select_orders = $conn->prepare("SELECT orders.id, orders.user_id, orders.name, orders.email, orders.number, orders.address, orders.event_time, orders.total_price, orders.proof_payment, orders.payment_status
      FROM orders
      WHERE payment_status = 'Lunas';");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
         <tr>
            <td><span><?= $fetch_orders['id']; ?></td>
            <td><span><?= $fetch_orders['name']; ?></span></td>
            <td><span><?= $fetch_orders['email']; ?></span></td>
            <td><span><?= $fetch_orders['number']; ?></span></td>
            <td><span><?= $fetch_orders['address']; ?></span></td>
            <td><span><?= $fetch_orders['event_time']; ?></span></td>
            <td><span><?php echo " " . number_format($fetch_orders['total_price'],0,',','.'); ?></span></td>                        
            <td><div class="zoom"><img src="../admin_img/<?= $fetch_orders['proof_payment']; ?>" width="80px" alt=""></div></td>            
            <td><span><?= $fetch_orders['payment_status']; ?></span></td>            
            </form>
         </tr>

   <?php
      }
   }else{
      echo '';
   }
   ?>
   </table>
   </div>
   </div>
</body>
</html>