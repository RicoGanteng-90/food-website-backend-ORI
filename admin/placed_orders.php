<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){

   $order_id = $_POST['order_id'];
   $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

   $order_status = $_POST['order_status'];
   $order_status = filter_var($order_status, FILTER_SANITIZE_STRING);

   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);

   $update_status = $conn->prepare("UPDATE `orders` SET order_status = ?, payment_status = ? WHERE id = ?");
   $update_status->execute([$order_status, $payment_status, $order_id]);

   $message[] = 'status diperbarui';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Order</title>

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

      <style>      
      .zoom {      
      background-color: transparent;
      transition: transform .1s;
      width: 0px auto;
      height: 0px auto;      
      }

      .zoom:hover {
      -ms-transform: scale(1.5); /* IE 9 */
      -webkit-transform: scale(1.5); /* Safari 3-8 */
      transform: scale(6.5); 
      }
      </style>
<style>
   #myInput {
   background-repeat: no-repeat;
   width: 100%;
   font-size: 16px;
   padding: 12px 20px 12px 40px;
   border: 1px solid #ddd;
   margin-bottom: 12px;
   }

   .btn-upp{
      display: block;
      margin-top: 1rem;
      border-radius: .5rem;
      cursor: pointer;
      width: 50%;
      font-size: 1rem;
      color:var(--white);
      padding:0.5rem 0.5rem;
      text-transform: capitalize;
      text-align: center;
   }

   .btn-upp{
      background-color: #b29723;
   }
</style>

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- placed orders section starts  -->

<section class="placed-orders">

   <h1 class="heading">order</h1>

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
            <td>Total Produk</td>
            <td>Total Pembayaran</td>            
            <td>Status Pesanan</td>
            <td>Bukti Pembayaran</td>
            <td>Status Pembayaran</td>            
            <td>Action</td>
         </tr>
      </thead>
      
      <?php      
      $select_orders = $conn->prepare("SELECT * FROM `orders` ORDER BY id DESC");
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
            <td><span><?= $fetch_orders['total_products']; ?></span></td>
            <td><span><?php echo " " . number_format($fetch_orders['total_price'],0,',','.'); ?></span></td> 
            <form action="" method="POST" enctype="multipart/form-data">
            <td>
               <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
               <select name="order_status" class="drop-down-order">                  
                  <option hidden selected value="<?= $fetch_orders['order_status']; ?>" ><?= $fetch_orders['order_status']; ?></option>
                  <option value=""></option>
                  <option value="Ditolak">Ditolak</option>
                  <option value="Diterima">Diterima</option>
               </select>
            </td>
            <td>               
                  <div class="zoom"><img src="../admin_img/<?= $fetch_orders['proof_payment']; ?>" width="80px" alt=""></div>
            </td>
            <td>
            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
               <select name="payment_status" class="drop-down-bayar">
                  <option hidden value="<?= $fetch_orders['payment_status']; ?>" selected><?= $fetch_orders['payment_status']; ?></option>                  
                  <option value=""></option>
                  <option value="Belum lunas">Belum lunas</option>
                  <option value="Lunas">Lunas</option>                  
               </select>
            </td>               
            <td>
               <div class="flex-btn">               
               <input type="submit" value="update" class="btn-order" name="update_payment">
               <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn-order" onclick="return confirm('Hapus order ini?');">Hapus</a>
               <a href="date_update.php?update=<?= $fetch_orders['id']; ?>" class="btn-upp">Undur</a>
               </div>               
            </td>
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
</section>

<!-- placed orders section ends -->


<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>