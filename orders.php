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
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>order</h3>
   <p><a href="html.php">Beranda</a> <span> / Order</span></p>
</div>

<section class="orders">

   <h3 class="title">Pesanan Anda </h3>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">silahkan login untuk melihat pesanan Anda</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
               $stat=$fetch_orders["payment_status"];
               if($stat=="Belum lunas"){
                  $status="<button>cetak</button>";
               }else{
                  $status="";
               }
   ?>
   <div class="box">
      <p>tanggal order : <span><?= $fetch_orders['order_time']; ?></span></p>
      <p>nama : <span><?= $fetch_orders['name']; ?></span></p>
      <p>email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>nomor telepon : <span><?= $fetch_orders['number']; ?></span></p>
      <p>waktu acara : <span><?= $fetch_orders['event_time']; ?></span></p>
      <p>alamat : <span><?= $fetch_orders['address']; ?></span></p>
      <p>metode pembayaran : <span><?= $fetch_orders['method']; ?></span></p>
      <p>total produk : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>total pembayaran : <span><?php echo " " . number_format($fetch_orders['total_price'],0,',','.'); ?></span></p>
      <p>status order : <span style="color:<?php if($fetch_orders['order_status'] == ' '){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['order_status']; ?></span> </p>
      <p>status pembayaran : <span style="color:<?php if($fetch_orders['payment_status'] == 'Belum lunas'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span><p><?php echo $status; ?></p></p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">tidak ada pesanan!</p>';
      }
      }
   ?>

   </div>

</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>