<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_dokter = $_GET['id_dokter'];

	if (isset($id_dokter)) {
		if (hapusDokter($id_dokter) > 0) {
			setAlert('Berhasil!','Data Berhasil Dihapus','success');
			header("Location: dokter_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Dihapus','error');
			header("Location: dokter_show.php");
			die;
		}
	}
 ?>