<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/overlay.css">
   <title>Beranda</title>

       <!-- Logo Title Bar -->
       <link rel="icon" href="images/logofanny.png"
    type="image/x-icon" class="LOGO">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <!-- font google --> 
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      type="text/css" media="all"/>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC%3A400%2C700%7CLato%3A400%2C700%2C400italic%2C700italic&amp;ver=4.9.8"
      type="text/css" media="screen"/>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
   <style>
      .hero{
         background: linear-gradient(160deg, var(--pr-color), #000);
         padding-top: 1%;
      }
   </style>
</head>

<body>

<?php include 'components/user_header.php'; ?>



<div class="hero">

   

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content">
               <span>Temukan Solusi Terbaik</span>
               <h3>acara impian Anda</h3>
               <a href="menu.php" class="btn-hero">temukan disini</a>
            </div>
            <div class="image">
               <img src="images/hero2.png" alt="">
            </div>
         </div>
      </div>      

</div>

<section class="category">

   <h1 class="title">Layanan Kami</h1>

   <div class="box-container">

      <a href="category.php?category=Makeup" class="box">
         <img src="images/cat-makeup.png" alt="">
         <h3>Makeup</h3>
      </a>

      <a href="category.php?category=Paket Wedding" class="box">
         <img src="images/cat-paket wedding.png" alt="">
         <h3>Paket Wedding</h3>
      </a>

      <a href="category.php?category=Extra Wedding" class="box">
         <img src="images/cat-extra.png" alt="">
         <h3>Extra Wedding</h3>
      </a>

      <a href="category.php?category=Paket Foto" class="box">
         <img src="images/cat-foto.png" alt="">
         <h3>Paket Foto</h3>
      </a>

   </div>

</section>

<!-- info section starts  -->

<section class="info">

   <h1 class="title">Seputar Pernikahan</h1>

   <div class="swiper info-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <h3>Gedung atau Rumah? </h3>
            <h3>Perhatikan!</h3>
            <h3> </h3>
            <p>jumlah undangan ataupun kendaraan</p>
            <p>kapasitas listrik dilokasi pernikahan</p>
            <p>penginapan untuk keluarga yang menginap</p>
            <p> </p>
            <p>
               <div class="stars">
                  <i class="fas fa-eject"></i>
                  <i class="fas fa-eject-half-alt"></i>
               </div>
            </p>
         </div>

         <div class="swiper-slide slide">
            <h3>Sovenir dan Undangan</h3>
            <h3>Jangan Lupa!</h3>
            <h3> </h3>
            <p>dipesan jauh-jauh hari</p>
            <p>sesuaikan dengan tema pernikahan</p>
            <p> </p>
            <p>
               <div class="stars">
                  <i class="fas fa-cube"></i>
                  <i class="fas fa-cube-half-alt"></i>
               </div>
            </p>
         </div>

         <div class="swiper-slide slide">
            <h3>Persiapan calon pengantin sebelum</h3>
            <h3>acara pernikahan... </h3>
            <h3> </h3>
            <p>menjaga kesehatan</p>
            <p>fokus pada pasangan</p>
            <p>minum ramuan sehat</p>
            <p>wedding mood boards</p>
            <p> </p>
            <p>
               <div class="stars">
                  <i class="fas fa-heart"></i>
                  <i class="fas fa-heart-half-alt"></i>
               </div>
            </p>
         </div>

         <div class="swiper-slide slide">
            <h3>Tips foto prewedding casual</h3>
            <h3> </h3>
            <p>menentukan tema</p>
            <p>menentukan jenis makeup</p>
            <p>menentukan lighting</p>
            <p> </p>
            <p>
               <div class="stars">
                  <i class="fas fa-camera"></i>
                  <i class="fas fa-camera-half-alt"></i>
               </div>
            </p>
         </div>

         <div class="swiper-slide slide">
            <h3>make up tahan lama</h3>
            <h3> </h3>
            <p>hindari perawatan dokter sebulan sebelumnya</p>
            <p>memakai skincare yang melembapkan</p>
            <p>minum air putih secukupnya</p>
            <p>berdiskusi dengan MUA</p>
            <p>tidur cukup</p>
            <p> </p>
            <p>
               <div class="stars">
                  <i class="fas fa-gem"></i>
                  <i class="fas fa-gem-half-alt"></i>
               </div>
            </p>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- reviews section ends -->

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".info-slider", {
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