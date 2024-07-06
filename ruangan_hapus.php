<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_ruangan = $_GET['id_ruangan'];

	if (hapusRuangan($id_ruangan) > 0) {
		setAlert('Berhasil!','Data Berhasil Dihapus','success');
		header("Location: ruangan_show.php");
		die;
	}else{
		setAlert('Gagal!','Data Gagal Dihapus','error');
		header("Location: ruangan_show.php");
		die;
	}
 ?>
