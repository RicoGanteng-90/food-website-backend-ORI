<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $review = $_POST['review'];
   $review = filter_var($review, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `review` WHERE name = ? AND review = ?");
   $select_message->execute([$name, $review]);

   if($select_message->rowCount() > 0){
      $message[] = 'sudah mengirim testimoni';
   }else{
      $insert_message = $conn->prepare("INSERT INTO `review`( user_id, name, review) VALUES(?,?,?)");
      $insert_message->execute([$user_id, $name,$review]);

      $message[] = 'testimoni terkirim';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>beri penilaian</title>

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


<!-- contact section starts  -->

<section  class="review">

   <div class="row">

      <form action="" method="post">
         <h3>testimoni</h3>
         <input type="text" name="name" maxlength="100" class="box" placeholder="masukan nama Anda" required>
         <textarea name="review" class="box" required placeholder="kesan Anda menggunakan layanan kami" maxlength="500" cols="30" rows="10"></textarea>
         <input type="submit" value="kirim" name="send" class="btn">
      </form>

   </div>

</section>

<!-- contact section ends -->










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>