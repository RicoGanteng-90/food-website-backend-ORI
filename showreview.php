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
   <title>Testimoni</title>

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

    <!-- testi --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Testimoni</h3>
   <p><a href="home.php">home</a> <span> / Testimoni</span></p>
</div>

<!-- START TESTIMONIAL -->
<section id="testimonial_area" class="section_padding">
	<div class="container">
        <?php
            $select_review = $conn->prepare("SELECT * FROM `review` ORDER BY id DESC");
            $select_review->execute();
            if($select_review->rowCount() > 0){
                while($fetch_review = $select_review->fetch(PDO::FETCH_ASSOC)){  
        ?>

		<div class="box-area">	
			<h5><?= $fetch_review['name']; ?></h5>
            <i class="fas fa-quote-left"></i>							
			<p class="content">
            <blockquote class="quote"><span><?= $fetch_review['review']; ?></span><i style="float:right" class="fas fa-quote-right"></i></blockquote>
            <div class="category"><i><?= $fetch_review['category']; ?></i></div>
			</p>
		</div>	

            <?php
                }
                }else{
                    echo '<p class="empty">Tidak ada testimoni</p>';
                }
            ?>
		</div>
</section>
<!-- END TESTIMONIAL -->




<!-- steps section ends -->


<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>