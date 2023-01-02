<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_employees'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $position = $_POST['position'];
   $position = filter_var($position, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $select_employees = $conn->prepare("SELECT * FROM `employees` WHERE name = ?");
   $select_employees->execute([$name]);

   if($select_employees->rowCount() > 0){
      $message[] = 'employee name already exists!';
   }else{
         $insert_employees = $conn->prepare("INSERT INTO `employees`(name, email, number, position, address) VALUES(?,?,?,?,?)");
         $insert_employees->execute([$name, $email, $number, $position, $address]);

         $message[] = 'new employee added!';

   }

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_employees = $conn->prepare("DELETE FROM `employees` WHERE id = ?");
   $delete_employees->execute([$delete_id]);
   header('location:employees.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Karyawan</title>

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

<!-- add employees section starts  -->

<section class="add-employees">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>tambahkan karyawan</h3>
      <input type="text" required placeholder="masukan nama karyawan" name="name" maxlength="100" class="box">
      <input type="email" name="email" required placeholder="masukan email karyawan" maxlength="100" class="box">
      <input type="number" name="number" required placeholder="masukan nomor telepon karyawan" class="box" maxlength="14">
      <input type="text" required placeholder="masukan posisi / jabatan karyawan" name="position" maxlength="100" class="box">
      <textarea required placeholder="masukan alamat karyawan" name="address" maxlength="1000" class="box"></textarea>
      <input type="submit" value="tambahkan" name="add_employees" class="btn">
   </form>

</section>

<!-- add employees section ends -->

<!-- show employees section starts  -->

<section class="show-employees" style="padding-top: 0;">

   <div class="box-container">
      <div class="box">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>
            <tr>
               <th>nama</th>
               <th>email</th>
               <th>nomor telepon</th>
               <th>posisi</th>
               <th>alamat</th>
               <th>aksi</th>
            </tr>
         </thead>
      <?php
      $show_employees = $conn->prepare("SELECT * FROM `employees` ORDER BY id DESC");
      $show_employees->execute();
      if($show_employees->rowCount() > 0){
         while($fetch_employees = $show_employees->fetch(PDO::FETCH_ASSOC)){  
      ?>
         <tr>
            <td><span><?= $fetch_employees['name']; ?></span></td>
            <td><span><?= $fetch_employees['email']; ?></span></td>
            <td><span><?= $fetch_employees['number']; ?></span></td>
            <td><span><?= $fetch_employees['position']; ?></span></td>
            <td><span><?= $fetch_employees['address']; ?></span></td>
            <td><div class="flex-btn">
         <a href="update_employees.php?update=<?= $fetch_employees['id']; ?>" class="option-btn-aksi">edit</a>
         <a href="employees.php?delete=<?= $fetch_employees['id']; ?>" class="delete-btn-aksi" onclick="return confirm('delete this employee?');">hapus</a>
      </div></td>
         </tr>
         <?php
            $fetch_employees['id']++;
         ?>
     
   </table>
   </div>
   <?php
         }
      }else{
         echo '';
      }
      ?>
   </div>

</section>

<!-- show products section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>