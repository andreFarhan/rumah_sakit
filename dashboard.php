<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

    $nama_admin = ucwords($_SESSION['nama_admin']);

    $sql = "SELECT * FROM tb_pasien";
    $eksekusi = mysqli_query($koneksi, $sql);
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pasien</title>
    <link rel="icon" href="img/hospital.png">
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="container mt-5 mb-5">
        <div class="alert alert-info text-center">
            <h4><b>Selamat Datang <b><?= $nama_admin; ?></b></b></h4>
        </div>
        
        <div class="row">

            <div class="col-lg-10 col-12 text-center mx-auto">
                <h2 class="mb-5 text-dark">
                    <p>Jam Digital: <b><span id="jam" style="font-size:24"></span></b></p>
                </h2>

                <p>Fasilitas kesehatan yang menyediakan perawatan medis dan pengobatan bagi pasien yang membutuhkan. Rumah sakit biasanya terdiri dari berbagai departemen dan layanan yang ditujukan untuk merawat berbagai jenis kondisi medis dan menyediakan perawatan jangka pendek maupun jangka panjang.</p>
            </div>
        </div>

    </div>
     <script type="text/javascript">
        window.onload = function() { jam(); }
       
        function jam() {
            var e = document.getElementById('jam'),
            d = new Date(), h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());
       
            e.innerHTML = h +':'+ m +':'+ s;
       
            setTimeout('jam()', 1000);
        }
       
        function set(e) {
            e = e < 10 ? '0'+ e : e;
            return e;
        }
    </script>
</body>

<?php include 'footer.php'; ?>

</html>
