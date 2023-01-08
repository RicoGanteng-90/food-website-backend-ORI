<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if (isset($_POST['update'])) {

    $order_id = $_POST['order_id'];
    $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);
    
    $event_time = $_POST['event_time'];
    $event_time = filter_var($event_time, FILTER_SANITIZE_STRING);

    $update_date = $conn->prepare("UPDATE `orders` SET event_time = ? WHERE id = ?");
    $update_date->execute([$event_time, $order_id]);

    header('Location: placed_orders.php');
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin</title>

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
    .accounts .box-container .box{
        width: 100%;
        border:var(--border);
        padding:1.4rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-size: 1.8rem;
    }

    .button {
        background-color: #282842;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        }

        .button1 {width: 100%;}
 </style>   

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admins accounts section starts  -->

<section class="accounts">

   <h1 class="heading">Data pengunduran tanggal acara</h1>

   <div class="box-container">

   <div class="box">

   <?php
      $update_id = $_GET['update'];
      $show_products = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
      $show_products->execute([$update_id]);
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){
   ?>

   <form action="" method="POST" enctype="multipart/form-data">
   <input type="hidden" name="order_id" value="<?= $fetch_products['id']; ?>">
   <h3>Waktu pengunduran acara</h3>
        <input type="datetime-local" class="box" name="event_time" value="<?= $fetch_products['event_time']; ?>">
        <div class="up">
        <input type="submit" value="update" class="btn" name="update" onclick="halo()">
        </div>
   </form>   

   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

   </div>

   </div>

</section>

<!-- admins accounts section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

<script>
      function halo() {
      alert("Tanggal berhasil di update");
      }
</script>

</body>
</html>