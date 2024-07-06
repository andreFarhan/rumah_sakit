<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_GET['id_ruangan']) > 0) {
		$id_ruangan = $_GET['id_ruangan'];
		$sql = "SELECT * FROM tb_ruangan 
				WHERE id_ruangan = '$id_ruangan'";
		$eksekusi = mysqli_query($koneksi, $sql);
	}else{
		$sql = "SELECT * FROM tb_ruangan
				ORDER BY id_ruangan DESC";
		$eksekusi = mysqli_query($koneksi, $sql);	
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link rel="icon" href="img/hospital.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<h3 class="mt-3">RUANGAN </h3>
		<table class="table table-striped" id="Table">
			<thead class="text-white bg-success">
				<tr>
					<th width="1%">NO</th>
					<th>JENIS RUANGAN</th>
					<th>HARGA /MALAM</th>
					<th width="1%">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $data['jenis_ruangan']; ?></td>					
					<td>Rp <?= str_replace(",", ".", number_format($data['harga_permalam'])); ?></td>					
					<td>
						<a id="tombol-hapus" href="ruangan_ubah.php?id_ruangan=<?= $data['id_ruangan']; ?>" class="badge badge-success"><i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Apakah Anda Ingin Menghapus Ruang <?= $data['jenis_ruangan']; ?> ?')" href="ruangan_hapus.php?id_ruangan=<?= $data['id_ruangan']; ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>