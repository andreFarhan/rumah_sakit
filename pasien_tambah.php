<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahPasien($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: pasien_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: pasien_show.php");
			die;
		}
	}

	$sql_dokter = "SELECT * FROM tb_dokter";
	$eksekusi_dokter = mysqli_query($koneksi, $sql_dokter);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Pasien</title>
	<link rel="icon" href="img/hospital.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #5D9C59;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH PASIEN</h3>
					<div class="form-group">
						<label for="nama_pasien">NAMA LENGKAP</label>
						<input type="text" class="form-control" name="nama_pasien" required>
					</div>
					<div class="form-group">
						<label for="jenis_kelamin">JENIS KELAMIN</label>
						<select name="jenis_kelamin" class="form-control" required>
							<option hidden>PILIH JENIS KELAMIN</option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="telp_pasien">NO. HANDPHONE PASIEN</label>
						<input type="number" class="form-control" name="telp_pasien" required>
					</div>
					<div class="form-group">
						<label for="penyakit">PENYAKIT</label>
						<input type="text" class="form-control" name="penyakit" required>
					</div>
					<div class="form-group">
						<label for="id_dokter">DOKTER</label>
						<select name="id_dokter" class="form-control">
							<option hidden> PILIH DOKTER </option>
							<?php while ($data_dokter = mysqli_fetch_array($eksekusi_dokter)) : ?>
								<option value="<?= $data_dokter['id_dokter']; ?>"><?= $data_dokter['nama_dokter']; ?></option>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">TAMBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn text-white bg-danger" href="pasien_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>