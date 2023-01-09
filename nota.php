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
                Jl. Sudirman No.3012, Palembang<br>
                Kec. Palembang Raya, Palembang,<br>
                Sumatera selatan 30961<br>
                Phone : (804) 123-5432<br>
                Email : info@sahretech.com
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong><?php echo $fetch_orders['name']; ?></strong><br>
                <?php echo $fetch_orders['address']; ?><br>
                Phone : <?php echo $fetch_orders['number']; ?><br>
                Email &nbsp;: <?php echo $fetch_orders['email']; ?>                
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
                  <th>Metode pembayaran</th>                  
                </tr>
                </thead>                

                <tbody>
                    <tr>
                        <input type="hidden" name="order_id" value="<?= $fetch_products['id']; ?>">                                                
                        <td><?php echo $fetch_orders['event_time']; ?></td>                        
                        <td><?php echo $fetch_orders['total_products']; ?></td>                        
                        <td><?php echo $fetch_orders['method']; ?></td>
                                                
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>Total harga :</b></td>
                        <td><b><?php echo "Rp. " . number_format($fetch_orders['total_price'],0,',','.'); ?></b></td>
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