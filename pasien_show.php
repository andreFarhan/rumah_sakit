<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}
	
	if (isset($_GET['id_pasien']) > 0) {
		$id_pasien = $_GET['id_pasien'];
		$sql = "SELECT * FROM tb_pasien 
				INNER JOIN tb_dokter ON tb_dokter.id_dokter = tb_pasien.id_dokter
				WHERE tb_pasien.id_pasien = '$id_pasien' 
				ORDER BY tb_pasien.id_pasien DESC";
		$eksekusi = mysqli_query($koneksi, $sql);
	}else{
		$sql = "SELECT * FROM tb_pasien 
				INNER JOIN tb_dokter ON tb_dokter.id_dokter = tb_pasien.id_dokter			
				ORDER BY id_pasien DESC";
	 	$eksekusi = mysqli_query($koneksi, $sql);
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pasien</title>
	<link rel="icon" href="img/hospital.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<h3 class="mt-3">PASIEN</h3>
		<table class="table table-striped" id="Table">
			<thead class="text-white bg-success">
				<tr>
					<th width="1%">NO</th>
					<th>NAMA</th>
					<th>JENIS KELAMIN</th>
					<th>NO. HP</th>
					<th>PENYAKIT</th>
					<th>DOKTER</th>
					<th width="1%">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $data['nama_pasien']; ?></td>
					<td><?= $data['jenis_kelamin']; ?></td>
					<td><?= $data['telp_pasien']; ?></td>
					<td><?= $data['penyakit']; ?></td>
					<td><?= $data['nama_dokter']; ?></td>
					<td>
						<a href="pasien_ubah.php?id_pasien=<?= $data['id_pasien']; ?>" class="badge badge-success"><i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Apakah anda ingin menghapus pasien <?= $data['nama_pasien']; ?> ?')" href="pasien_hapus.php?id_pasien=<?= $data['id_pasien']; ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>
