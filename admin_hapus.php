<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_admin = $_GET['id_admin'];

	if (isset($id_admin)) {
		if (hapusAdmin($id_admin) > 0) {
			setAlert('Berhasil!','Data Berhasil Dihapus','success');
			header("Location: admin_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Dihapus','error');
			header("Location: admin_show.php");
			die;
		}
	}
 ?>