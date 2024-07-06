<?php 
	
	session_start();

	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "db_rumah_sakit";

	$koneksi = mysqli_connect($host,$username,$password,$database);

	date_default_timezone_set('asia/jakarta');

	function tambahDokter($data){
		global $koneksi;
		$nama_dokter = ucwords(strtolower($data['nama_dokter']));
		$telp_dokter = $data['telp_dokter'];
		$spesialis = $data['spesialis'];

		$sql = "INSERT INTO tb_dokter VALUES('','$nama_dokter','$telp_dokter','$spesialis')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function tambahAdmin($data){
		global $koneksi;
		$nama_admin = ucwords(strtolower($data['nama_admin']));
		$username = $data['username'];
		$password = $data['password'];
		$password2 = $data['password2'];
		$telp_admin = $data['telp_admin'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username = '$username'");

		if (mysqli_fetch_assoc($result)) {
			setAlert('Gagal!','username Telah Digunakan','error');
			header("Location: admin_tambah.php");
			die;
		}
		if ($password !== $password2) {
			setAlert('Gagal!','Konfirmasi Password Salah','error');
			header("Location: admin_tambah.php");
			die;
		}

		$password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO tb_admin VALUES('','$nama_admin', '$telp_admin','$username','$password')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);

	}

	function tambahPasien($data){
		global $koneksi;
		$id_dokter = $data['id_dokter'];
		$nama_pasien = ucwords(strtolower($data['nama_pasien']));
		$jenis_kelamin = $data['jenis_kelamin'];
		$telp_pasien = $data['telp_pasien'];
		$penyakit = $data['penyakit'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_pasien WHERE nama_pasien = '$nama_pasien'");

		if (mysqli_fetch_assoc($result)) {
			echo "
			<script>
			alert('Nama Pelanggan Sudah Digunakan!')
			</script>
			";	
		}

		$sql = "INSERT INTO tb_pasien VALUES('','$id_dokter','$nama_pasien','$jenis_kelamin','$telp_pasien','$penyakit')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function tambahPembayaran($data){
		global $koneksi;
		$id_ruangan = $data['id_ruangan'];
		$id_pasien = $data['id_pasien'];
		$lama_nginap = $data['lama_nginap'];
		$pembayaran = $data['pembayaran'];
		$tanggal = $data['tanggal'];
		$id_admin = $data['id_admin'];


		$sql = "INSERT INTO tb_pembayaran VALUES('','$id_ruangan','$id_pasien','$lama_nginap','$pembayaran','$tanggal','$id_admin')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_insert_id($koneksi);
	}

	function tambahRuangan($data){
		global $koneksi;
		$jenis_ruangan = ucwords(strtolower($data['jenis_ruangan']));
		$harga_permalam = $data['harga_permalam'];

		$sql = "INSERT INTO tb_ruangan VALUES('','$jenis_ruangan','$harga_permalam')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function ubahAdmin($data){
		global $koneksi;
		$id_admin = $data['id_admin'];
		$nama_admin = ucwords(strtolower($data['nama_admin']));
		$telp_admin = $data['telp_admin'];
		$username = $data['username'];
		$password = $data['password'];
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$password2 = $data['password2'];
		$password_lama = $data['password_lama'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username = '$username'");
		$fetch = mysqli_fetch_assoc($result);
		$password_lama_verify = password_verify($password_lama, $fetch['password']);

		if ($password !== $password2) {
			echo "
			<script>
			alert('Konfirmasi Password tidak sama!')
			</script>
			";
			return false;
		}

		if ($password_lama_verify) {
			$sql = "UPDATE tb_admin SET nama_admin = '$nama_admin', telp_admin = '$telp_admin', password = '$password_hash' WHERE id_admin = '$id_admin'";
			$eksekusi = mysqli_query($koneksi, $sql);

			return mysqli_affected_rows($koneksi);
		}else{
			echo "
			<script>
			alert('Password Lama tidak benar!')
			</script>
			";
			return false;
		}

	}

	function ubahDokter($data){
		global $koneksi;
		$id_dokter = $data['id_dokter'];
		$nama_dokter = ucwords(strtolower($data['nama_dokter']));
		$telp_dokter = $data['telp_dokter'];
		$spesialis = $data['spesialis'];

		$sql = "UPDATE tb_dokter SET nama_dokter = '$nama_dokter', telp_dokter = '$telp_dokter', spesialis = '$spesialis' WHERE id_dokter = '$id_dokter'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function ubahPasien($data){
		global $koneksi;
		$id_pasien = $data['id_pasien'];
		$id_dokter = $data['id_dokter'];
		$nama_pasien = ucwords(strtolower($data['nama_pasien']));
		$jenis_kelamin = $data['jenis_kelamin'];
		$telp_pasien = $data['telp_pasien'];
		$penyakit = $data['penyakit'];

		$sql = "UPDATE tb_pasien SET id_dokter = '$id_dokter', nama_pasien = '$nama_pasien', penyakit = '$penyakit', jenis_kelamin = '$jenis_kelamin', telp_pasien = '$telp_pasien' WHERE id_pasien = '$id_pasien'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function ubahPembayaran($data){
		global $koneksi;
		$id_pembayaran = $data['id_pembayaran'];
		$id_ruangan = $data['id_ruangan'];
		$id_pasien = $data['id_pasien'];
		$lama_nginap = $data['lama_nginap'];
		$pembayaran = $data['pembayaran'];
		$tanggal = $data['tanggal'];
		$id_admin = $data['id_admin'];

		$sql = "UPDATE tb_pembayaran SET id_ruangan = '$id_ruangan', id_pasien = '$id_pasien', lama_nginap = '$lama_nginap',pembayaran = '$pembayaran', tanggal = '$tanggal', id_admin = '$id_admin' WHERE id_pembayaran = '$id_pembayaran'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function ubahRuangan($data){
		global $koneksi;
		$id_ruangan = $data['id_ruangan'];
		$jenis_ruangan = $data['jenis_ruangan'];
		$harga_permalam = $data['harga_permalam'];

		$sql = "UPDATE tb_ruangan SET jenis_ruangan = '$jenis_ruangan', harga_permalam = '$harga_permalam' WHERE id_ruangan = '$id_ruangan'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}


	function hapusDokter($id){
		global $koneksi;
		$sql = "DELETE FROM tb_dokter WHERE id_dokter = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusAdmin($id){
		global $koneksi;
		$sql = "DELETE FROM tb_admin WHERE id_admin = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}
	
	function hapusPasien($id){
		global $koneksi;
		$sql = "DELETE FROM tb_pasien WHERE id_pasien = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusPembayaran($id){
		global $koneksi;
		$sql = "DELETE FROM tb_pembayaran WHERE id_pembayaran = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusRuangan($id){
		global $koneksi;
		$sql = "DELETE FROM tb_ruangan WHERE id_ruangan = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function setAlert($title='',$text='',$type='',$buttons=''){

		$_SESSION["alert"]["title"]		= $title;
		$_SESSION["alert"]["text"] 		= $text;
		$_SESSION["alert"]["type"] 		= $type;
		$_SESSION["alert"]["buttons"]	= $buttons; 

	}

	if (isset($_SESSION['alert'])) {

		function alert(){
			$title 		= $_SESSION["alert"]["title"];
			$text 		= $_SESSION["alert"]["text"];
			$type 		= $_SESSION["alert"]["type"];
			$buttons	= $_SESSION["alert"]["buttons"];

			echo"
			<div id='msg' data-title='".$title."' data-type='".$type."' data-text='".$text."' data-buttons='".$buttons."'></div>
			<script>
				let title 		= $('#msg').data('title');
				let type 		= $('#msg').data('type');
				let text 		= $('#msg').data('text');
				let buttons		= $('#msg').data('buttons');

				if(text != '' && type != '' && title != ''){
					Swal.fire({
						title: title,
						text: text,
						icon: type,
					});
				}
			</script>
			";
			unset($_SESSION["alert"]);
		}
	}
 ?>