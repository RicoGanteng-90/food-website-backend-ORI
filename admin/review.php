<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `review` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:review.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Testimoni</title>

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

<!-- review section starts  -->

<section class="messages">

   <h1 class="heading">Testimoni</h1>

   <div class="box-container">
   <div class="box">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <tr>
         <tr>
            <td>Nama</td>
            <td>Testimoni</td>
            <td>Aksi</td>
         </tr>
      </tr>
      <?php
      $select_review = $conn->prepare("SELECT * FROM `review` ORDER BY id DESC");
      $select_review->execute();
      if($select_review->rowCount() > 0){
         while($fetch_review = $select_review->fetch(PDO::FETCH_ASSOC)){
    ?>
    <tr>
            <td><span><?= $fetch_review['name']; ?></span></td>
            <td><span><?= $fetch_review['review']; ?></span></td>
            <td><a href="review.php?delete=<?= $fetch_review['id']; ?>" class="delete-btn" onclick="return confirm('yakin ini menghapus testimoni ini?');">hapus</a></td>
         </tr>
         <?php
            $fetch_review['id']++;
         ?>
      <?php
      }
      }else{
      echo '';
      }
      ?>
      <table>

   </div>
   </div>

</section>

<!-- review section ends -->









<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>