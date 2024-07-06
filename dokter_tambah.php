<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahDokter($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: dokter_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: dokter_show.php");
			die;
		}
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Dokter</title>
	<link rel="icon" href="img/hospital.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #5D9C59;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH DOKTER</h3>
					<div class="form-group">
						<label for="nama_dokter">NAMA LENGKAP</label>
						<input type="text" class="form-control" name="nama_dokter" required>
					</div>
					<div class="form-group">
						<label for="telp_dokter">NO. HANDPHONE DOKTER</label>
						<input type="number" class="form-control" name="telp_dokter" required>
					</div>
					<div class="form-group">
						<label for="spesialis">SPESIALIS</label>
						<input type="text" class="form-control" name="spesialis" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">TAMBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn text-white bg-danger" href="dokter_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>