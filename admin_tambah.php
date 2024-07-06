<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahAdmin($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: admin_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: admin_show.php");
			die;
		}
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Admin</title>
	<link rel="icon" href="img/hospital.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #5D9C59;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH ADMIN</h3>
					<div class="form-group">
						<label for="nama_admin">NAMA LENGKAP</label>
						<input type="text" class="form-control" name="nama_admin" required>
					</div>
					<div class="form-group">
						<label for="telp_admin">NO. HANDPHONE</label>
						<input type="number" class="form-control" name="telp_admin" required>
					</div>
					<div class="form-group">
						<label for="username">USERNAME</label>
						<input type="text" class="form-control" name="username" required>
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
						<button type="submit" class="btn btn-primary" name="submit">TAMBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn text-white bg-danger" href="admin_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>