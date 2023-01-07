<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tentang</title>


 <!-- Logo Title Bar -->
 <link rel="icon" href="images/logofanny.png"
    type="image/x-icon" class="LOGO">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

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
   <h3>tentang kami</h3>
   <p><a href="index.php">Beranda</a> <span> / Tentang</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about.png" alt="">
      </div>

      <div class="content">
         <h3>Mengapa Harus Kami?</h3>
         <p>Karena Anda tidak perlu khawatir, setiap detail tentang acara pernikahan Anda adalah perhatian dan tanggung jawab kami. Tim profesional kami siap melayani berbagai kebutuhan pernikahan impian Anda, mulai persiapan acara  hingga saat acara berlangsung.</p>
         <a href="menu.php" class="btn">Layanan Produk</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">LANGKAH ORDER</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step pilih.png" alt="">
         <h3>Pilih Produk</h3>
         <p>Memilih produk yang diinginkan, kemudian melakukan pemesanan.</p>
      </div>

      <div class="box">
         <img src="images/step-waiting admin.png" alt="">
         <h3>Tunggu Konfirmasi Admin</h3>
         <p>Admin akan mengkonfirmasi Anda melalui status pemesanan.</p>
      </div>

      <div class="box">
         <img src="images/step-pembayaran.png" alt="">
         <h3>Pembayaran</h3>
         <p>Ketika status pemesanan “Diterima” maka Anda dapat melanjutkan pembayaran. </p>
      </div>

   </div>

</section>

<!-- steps section ends -->


<!-- kontrak section starts  -->

<section class="steps">

   <h1 class="title">SYARAT DAN KONDISI</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/kontrak-fotomu fotoku.png" alt="">
         <h3>Foto Anda = Foto kami</h3>
         <p>Kami berhak menggunakan foto Anda sebagai bagian promosi kami</p>
      </div>

      <div class="box">
         <img src="images/kontrak-tambah biaya.png" alt="">
         <h3>Biaya Transportasi</h3>
         <p>Diluar kecamatan Ambulu, Jember dikenakan biaya transport</p>
      </div>
      
      <div class="box">
         <img src="images/kontrak-tidak kembali.png" alt="">
         <h3>Pembayaran</h3>
         <p>Uang yang sudah telah ditransfer tidak dapat dikembalikan kembali.</p>
      </div>

   </div>

</section>

<!-- kontrak section ends -->

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>