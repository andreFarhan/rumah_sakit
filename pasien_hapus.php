<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_pasien = $_GET['id_pasien'];

	if (hapusPasien($id_pasien) > 0) {
		setAlert('Berhasil!','Data Berhasil Dihapus','success');
		header("Location: pasien_show.php");
		die;
	}
	else{
		setAlert('Gagal!','Data Gagal Dihapus','error');
		header("Location: pasien_show.php");
		die;
	}
?>