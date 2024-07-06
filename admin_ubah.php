<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (ubahAdmin($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Diubah','success');
			header("Location: admin_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Diubah','error');
			header("Location: admin_show.php");
			die;
		}
	}

	$id_admin = $_GET['id_admin'];

	$sql = "SELECT * FROM tb_admin WHERE id_admin = '$id_admin'";
	$eksekusi = mysqli_query($koneksi, $sql);
	$data = mysqli_fetch_array($eksekusi);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah admin</title>
	<link rel="icon" href="img/hospital.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #5D9C59;">
				<form method="POST">
					<h3 class="mt-3">UBAH ADMIN</h3>
					<input type="hidden" name="id_admin" value="<?= $data['id_admin']; ?>">
					<div class="form-group">
						<label for="nama_admin">NAMA LENGKAP</label>
						<input type="text" class="form-control" name="nama_admin" value="<?= $data['nama_admin']; ?>" required>
					</div>
					<div class="form-group">
						<label for="telp_admin">NO. HANDPHONE</label>
						<input type="number" class="form-control" name="telp_admin" value="<?= $data['telp_admin']; ?>" required>
					</div>
					<div class="form-group">
						<label for="username">username</label>
						<input type="text" class="form-control" value="<?= $data['username']; ?>" disabled>
						<input type="hidden" name="username" value="<?= $data['username']; ?>">
					</div>
					<div class="form-group">
						<label for="password_lama">PASSWORD LAMA</label>
						<input type="password" class="form-control" name="password_lama" required>
					</div>
					<div class="form-group">
						<label for="password">PASSWORD</label>
						<input type="password" class="form-control" name="password" required>
					</div>
					<div class="form-group">
						<label for="password2">KONFIRMASI PASSWORD</label>
						<input type="password" class="form-control" name="password2" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">UBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn text-white bg-danger" href="admin_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>