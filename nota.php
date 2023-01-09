<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body style="padding: 0 20;">
    <div>
    <?php 
        include "components/connect.php";

        session_start();
        
        $admin_id = $_SESSION['admin_id'];

        if(!isset($admin_id)){
        header('location:admin_login.php');
        }
        
                    $id = $_GET['id'];               
                    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id=?");
                    $select_orders->execute([$id]);
                    if($select_orders->rowCount() > 0){
                       while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                    
    ?>
      <section class="content">
        <div class="row">
            <div>
                <div class="span12">
                    <table class="table">
                    <tr>
                        <td><h5><strong>&nbsp;Tanggal pesan : </strong><?php echo $fetch_orders['order_time']; ?> </h5></td>
                        </tr>                
                    </table>
                </div>
            </div>
        </div>
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong>Fani Sulistiowati</strong><br>
                JJl. Mangga Karang Templek, Ambulu, Kabupaten Jember, Jawa Timur<br>
                Phone : 082161171191 & 082244442422<br>
                Email : Fannymanyun26@gmail.com
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong><?php echo $fetch_orders['name']; ?></strong><br>
                <?php echo $fetch_orders['address']; ?><br>
                Phone : <?php echo $fetch_orders['number']; ?><br>
                Email &nbsp;: <?php echo $fetch_orders['email']; ?><br>
                <b>Metode pembayaran</b> : <?php echo $fetch_orders['method']; ?>
              </address>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>                                    
                  <th>Tanggal acara</th>                  
                  <th>Produk</th>                                                   
                </tr>
                </thead>                

                <tbody>
                    <tr>
                        <input type="hidden" name="order_id" value="<?= $fetch_products['id']; ?>">                                                
                        <td><?php echo $fetch_orders['event_time']; ?></td>                        
                        <td><?php echo $fetch_orders['total_products']; ?></td>                                                                                                
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>Total harga : <b><?php echo "Rp. " . number_format($fetch_orders['total_price'],0,',','.'); echo ",00" ?></b></b></td>                        
                    </tr>
                </tbody>
                <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>
            </table>
          </div>
      </section>
    </div>
  </body>
   <script>
      window.print()
  </script>