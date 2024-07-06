<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (ubahPembayaran($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Diubah','success');
			header("Location: pembayaran_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Diubah','error');
			header("Location: pembayaran_show.php");
			die;
		}
	}

	$id_pembayaran = $_GET['id_pembayaran'];

	$id_admin = $_SESSION['id_admin'];
	$sql_admin = "SELECT * FROM tb_admin WHERE id_admin = '$id_admin'";
	$eksekusi_admin = mysqli_query($koneksi, $sql_admin);
	$data_admin = mysqli_fetch_array($eksekusi_admin);

	$sql_ruangan = "SELECT * FROM tb_ruangan ORDER BY id_ruangan DESC";
	$eksekusi_ruangan = mysqli_query($koneksi, $sql_ruangan);

	$sql_pasien = "SELECT * FROM tb_pasien ORDER BY id_pasien DESC";
	$eksekusi_pasien = mysqli_query($koneksi, $sql_pasien);

	$sql_pembayaran = "SELECT * FROM tb_pembayaran 
					LEFT OUTER JOIN tb_ruangan ON tb_ruangan.id_ruangan = tb_pembayaran.id_ruangan
					LEFT OUTER JOIN tb_pasien ON tb_pasien.id_pasien = tb_pembayaran.id_pasien
					WHERE id_pembayaran = '$id_pembayaran'";
	$eksekusi_pembayaran = mysqli_query($koneksi, $sql_pembayaran);
	$data_pembayaran = mysqli_fetch_array($eksekusi_pembayaran);


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah Pembayaran</title>
	<link rel="icon" href="img/hospital.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #5D9C59;">
				<form method="POST">
					<h3 class="mt-3">UBAH PEMBAYARAN</h3>
					<input type="hidden" name="id_pembayaran" value="<?= $data_pembayaran['id_pembayaran']; ?>">
					<div class="form-group">
						<label for="id_pasien">PASIEN</label>
						<select class="form-control" name="id_pasien" id="id_pasien">
							<option value="<?= $data_pembayaran['id_pasien']; ?>" hidden><?= $data_pembayaran['nama_pasien']; ?></option>
							<?php while ($data_pasien = mysqli_fetch_array($eksekusi_pasien)) : ?>
								<option value="<?= $data_pasien['id_pasien']; ?>"><?= $data_pasien['nama_pasien']; ?></option>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_ruangan">SEPATU</label>
						<select class="form-control" name="id_ruangan" id="id_ruangan">
							<option value="<?= $data_pembayaran['id_ruangan']; ?>" hidden><?= $data_pembayaran['jenis_ruangan']; ?></option>
							<?php while ($data_ruangan = mysqli_fetch_array($eksekusi_ruangan)) : ?>
								<option value="<?= $data_ruangan['id_ruangan']; ?>"><?= $data_ruangan['jenis_ruangan']; ?></option>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
						<label for="lama_nginap">LAMA NGINAP</label>
						<input type="number" name="lama_nginap" value="<?= $data_pembayaran['lama_nginap']; ?>" class="form-control">
					</div>
					<input type="hidden" name="pembayaran" value="Belum Dibayar">
					<input type="hidden" name="tanggal" value="<?= date('Y-m-d\TH:i:s'); ?>">
					<div class="form-group">
						<label for="id_admin">ADMIN</label>
						<input class="form-control" type="text" value="<?= $data_admin['nama_admin']; ?>" disabled>
						<input class="form-control" type="hidden" name="id_admin" value="<?= $id_admin; ?>">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">BERIKUTNYA <i class="fa fa-arrow-right"></i></button>
						<a class="btn text-white bg-danger" href="pembayaran_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>