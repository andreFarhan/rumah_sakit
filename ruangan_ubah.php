<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (ubahRuangan($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Diubah','success');
			header("Location: ruangan_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Diubah','error');
			header("Location: ruangan_show.php");
			die;
		}
	}

	$id_ruangan = $_GET['id_ruangan'];
	$sql = "SELECT * FROM tb_ruangan WHERE id_ruangan = '$id_ruangan'";
	$eksekusi = mysqli_query($koneksi, $sql);
	$data = mysqli_fetch_array($eksekusi);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah Ruangan</title>
	<link rel="icon" href="img/hospital.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #5D9C59;">
				<form method="POST">
					<h3 class="mt-3">UBAH DOKTER</h3>
					<input type="hidden" name="id_ruangan" value="<?= $data['id_ruangan']; ?>" >
					<div class="form-group">
						<label for="jenis_ruangan">JENIS RUANGAN</label>
						<input type="text" class="form-control" name="jenis_ruangan" value="<?= $data['jenis_ruangan']; ?>" required>
					</div>
					<div class="form-group">
						<label for="harga_permalam">HARGA PERMALAM</label>
						<input type="number" class="form-control" name="harga_permalam" value="<?= $data['harga_permalam']; ?>" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">UBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn text-white bg-danger" href="ruangan_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>