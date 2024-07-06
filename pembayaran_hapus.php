<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_pembayaran = $_GET['id_pembayaran'];

	if (hapusPembayaran($id_pembayaran) > 0) {
		setAlert('Berhasil!','Data Berhasil Dihapus','success');
		header("Location: pembayaran_show.php");
		die;
	}else{
		setAlert('Gagal!','Data Gagal Dihapus','error');
		header("Location: pembayaran_show.php");
		die;
	}
 ?>
