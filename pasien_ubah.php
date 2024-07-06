<?php  
	
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_pasien = $_GET['id_pasien'];
	$sql = "SELECT * FROM tb_pasien 
			LEFT OUTER JOIN tb_dokter ON tb_dokter.id_dokter = tb_pasien.id_dokter
			WHERE id_pasien = $id_pasien";
	$eksekusi = mysqli_query($koneksi, $sql);
	$data = mysqli_fetch_assoc($eksekusi);

	$sql_dokter = "SELECT * FROM tb_dokter";
	$eksekusi_dokter = mysqli_query($koneksi, $sql_dokter);

	if (isset($_POST['submit'])) {
		if (ubahPasien($_POST) > 0 ) {
			setAlert('Berhasil!','Data Berhasil Diubah','success');
			header("Location: pasien_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Diubah','error');
			header("Location: pasien_show.php");
			die;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah Pasien</title>
	<link rel="icon" href="img/hospital.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #5D9C59;">
				<form method="POST">
					<h3 class="mt-3">UBAH PASIEN</h3>
					<input type="hidden" name="id_pasien" value="<?= $data['id_pasien']; ?>">
					<div class="form-group">
						<label for="nama_pasien">NAMA LENGKAP</label>
						<input type="text" class="form-control" name="nama_pasien" value="<?= $data['nama_pasien']; ?>" required>
					</div>
					<div class="form-group">
						<label for="jenis_kelamin">JENIS KELAMIN</label>
						<select name="jenis_kelamin" class="form-control" required>
							<option value="<?= $data['jenis_kelamin']; ?>" hidden><?= $data['jenis_kelamin']; ?></option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="penyakit">PENYAKIT</label>
						<input type="text" class="form-control" name="penyakit" value="<?= $data['penyakit']; ?>" required>
					</div>
					<div class="form-group">
						<label for="telp_pasien">NO. HANDPHONE</label>
						<input type="number" class="form-control" name="telp_pasien"  value="<?= $data['telp_pasien']; ?>" required>
					</div>
					<div class="form-group">
						<label for="id_dokter">DOKTER</label>
						<select name="id_dokter" class="form-control">
							<option value="<?= $data['id_dokter']; ?>" hidden><?= $data['nama_dokter']; ?></option>
							<?php while ($data_dokter = mysqli_fetch_array($eksekusi_dokter)) : ?>
								<option value="<?= $data_dokter['id_dokter']; ?>"><?= $data_dokter['nama_dokter']; ?></option>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">UBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn text-white bg-danger" href="pasien_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>