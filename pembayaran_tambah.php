<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahPembayaran($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: pembayaran_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: pembayaran_show.php");
			die;
		}
	}

	$id_admin = $_SESSION['id_admin'];
	$nama_admin = $_SESSION['nama_admin'];

	$sql_ruangan = "SELECT * FROM tb_ruangan ORDER BY id_ruangan DESC";
	$eksekusi_ruangan = mysqli_query($koneksi, $sql_ruangan);

	if (isset($_GET['id_pasien']) > 0) {
		$id_pasien = $_GET['id_pasien'];
		$sql_pasien = "SELECT * FROM tb_pasien WHERE id_pasien = '$id_pasien' ORDER BY id_pasien DESC";
		$eksekusi_pasien = mysqli_query($koneksi, $sql_pasien);
	}else{
		$sql_pasien = "SELECT * FROM tb_pasien";
		$eksekusi_pasien = mysqli_query($koneksi, $sql_pasien);
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Pembayaran</title>
	<link rel="icon" href="img/hospital.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #5D9C59;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH PEMBAYARAN</h3>

					<div class="form-group">
						<label for="id_pasien">PASIEN</label>
						<select class="form-control" name="id_pasien" id="id_pasien">
							<option hidden>PILIH PASIEN</option>
							<?php while ($data_pasien = mysqli_fetch_array($eksekusi_pasien)) : ?>
								<option value="<?= $data_pasien['id_pasien']; ?>"><?= $data_pasien['nama_pasien']; ?></option>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_ruangan">RUANGAN</label>
						<select class="form-control" name="id_ruangan" id="id_ruangan">
							<?php while ($data_ruangan = mysqli_fetch_array($eksekusi_ruangan)) : ?>
								<option value="<?= $data_ruangan['id_ruangan']; ?>"><?= $data_ruangan['jenis_ruangan']; ?></option>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
						<label for="lama_nginap">LAMA NGINAP</label>
						<input type="number" name="lama_nginap" class="form-control">
					</div>
					<input type="hidden" name="pembayaran" value="Belum Dibayar">
					<div class="form-group">
						<label for="id_admin">ADMIN</label>
						<input class="form-control" type="text" value="<?= $nama_admin; ?>" disabled>
						<input class="form-control" type="hidden" name="id_admin" value="<?= $id_admin; ?>">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">KIRIM <i class="fa fa-arrow-right"></i></button>
						<a class="btn text-white bg-danger" href="pembayaran_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>