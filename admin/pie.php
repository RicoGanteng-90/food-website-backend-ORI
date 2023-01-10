<!DOCTYPE html>
<html>
<head>
    <script src="js/Chart.js"></script>    
</head>
<body>
    <br>
    <h2 style="text-align:center">Layanan Jasa pada Fany Makeup Wedding</h2>
    <canvas id="myChart"></canvas>
    <?php
    $kon = mysqli_connect("localhost","root","","db_fani_wedding");

    $nama_cat= "";
    $jumlah=null;
    $sql="select category,COUNT(*) as 'total' from products GROUP by category";
    $hasil=mysqli_query($kon,$sql);

    while ($data = mysqli_fetch_array($hasil)) {
        //Mengambil nilai jurusan dari database
        $cat=$data['category'];
        $nama_cat .= "'$cat'". ", ";
        //Mengambil nilai total dari database
        $jum=$data['total'];
        $jumlah .= "$jum". ", ";
    }
?>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'pie',
        // The data for our dataset
        data: {
            labels: [<?php echo $nama_cat; ?>],
            datasets: [{
                label:'Layanan Jasa pada Fany Makeup Wedding',
                backgroundColor: ['rgb(102, 205, 170)', 'rgba(	255, 127, 0)', 'rgb(47, 79, 79)','rgba(218, 112, 214)'],
                borderColor: ['rgb(220, 220, 220)'],
                data: [<?php echo $jumlah; ?>]
            }]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
</body>
</html>