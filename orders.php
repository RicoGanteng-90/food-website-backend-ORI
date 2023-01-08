<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};


if (isset($_POST['add_img'])) {

   $mid = $_POST['mid'];
   $mid = filter_var($mid, FILTER_SANITIZE_STRING);

   $image = $_FILES['img']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['img']['size'];
   $image_tmp_name = $_FILES['img']['tmp_name'];
   $image_folder = 'admin_img/' . $image;

   if (!empty($image)) {
      if ($image_size > 2000000) {
         $message[] = 'ukuran gambar terlalu besar';
      } else {
         $update_image = $conn->prepare("UPDATE `orders` SET proof_payment = ? WHERE id = ?");
         $update_image->execute([$image, $mid]);         
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'bukti transfer berhasil dikirim!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:orders.php');
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
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY id DESC");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
               $stat=$fetch_orders["order_status"];
               $pay=$fetch_orders["payment_status"];

            if ($stat == "Diterima") {
               $bukti = "<input type=file name=img class=box accept=image/jpg, image/jpeg, image/png, image/webp required>";
               $tomb = "<button class=upp type=submit name=add_img>Upload</button>";
            }else{
               $bukti = "";
               $tomb = "";
            }

            if($pay == "Lunas"){
               $nota = "<button class=note>Cetak nota</button>";
               $nilai = "<button onclick = window.location.href='review.php' class=grade>Beri Penilaian</button>";
            }else{
               $nota = "";
               $nilai = "";
            }
   ?>
   
   
         <div class="box">   
         <table>
              
               <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td><span><?= $fetch_orders['name']; ?></span></td>
               </tr>
               <tr>
                  <td>Email</td>
                  <td>:</td>
                  <td><span><?= $fetch_orders['email']; ?></span></td>
               </tr>
               <tr>
                  <td>Nomor Telepon</td>
                  <td>:</td>
                  <td><span><?= $fetch_orders['number']; ?></span></td>
               </tr>
               <tr>
                  <td>Alamat</td>
                  <td>:</td>
                  <td><span><?= $fetch_orders['address']; ?></span></td>
               </tr>
               <tr>
                  <td>Tanggal Order</td>
                  <td>:</td>
                  <td><span><?= $fetch_orders['order_time']; ?> </span></td>
               </tr>
               <tr>
                  <td>Waktu Acara</td>
                  <td>:</td>
                  <td><span><?= $fetch_orders['event_time']; ?></span></td>
               </tr>
               <tr>
                  <td>Total Produk</td>
                  <td>:</td>
                  <td><span><?= $fetch_orders['total_products']; ?></span></td>
               </tr>
               <tr>
                  <td>Total Pembayaran</td>
                  <td>:</td>
                  <td><span><?php echo " " . number_format($fetch_orders['total_price'],0,',','.'); ?></span></td>
               </tr>
               <tr>
                  <td>Metode Pembayaran</td>
                  <td>:</td>
                  <td><span><?= $fetch_orders['method']; ?></span></td>
               </tr>         
               <form action="" method="POST" enctype="multipart/form-data">
               <input type="hidden" name="mid" value="<?= $fetch_orders['id']; ?>">
               <tr>
                  <td>Status Pesanan</td>
                  <td>:</td>
                  <td><span style="color:<?php if($fetch_orders['order_status'] == 'Diproses'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['order_status']; ?></span></td>
               </tr>
               <tr>
                  <td>Status Pembayaran</td>
                  <td>:</td>
                  <td><span style="color:<?php if($fetch_orders['payment_status'] == 'Belum lunas'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span></td>
               </tr>
               <br><p> </p><br>
               
            </table>
            <br>
            <?php echo $bukti; ?> &nbsp; &nbsp; <?php echo $tomb; ?><br><br>
            <a href="orders.php?delete=<?= $fetch_orders['id']; ?>" class="hap" onclick="return confirm('Batalkan order ini?\nPesanan akan dihapus');">Batalkan</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php echo $nota; ?> &nbsp; &nbsp; <?php echo $nilai; ?>            
         </div>
         </form>

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