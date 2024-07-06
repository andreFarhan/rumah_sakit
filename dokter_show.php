<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$sql = "SELECT * FROM tb_dokter
			ORDER BY id_dokter DESC";
	$eksekusi = mysqli_query($koneksi, $sql);
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
		<h3 class="mt-3">DOKTER </h3>
		<table class="table table-striped" id="Table">
			<thead class="text-white bg-success">
				<tr>
					<th width="1%">NO</th>
					<th>NAMA</th>
					<th>SPESIALIS</th>
					<th>NO. HP</th>
					<th width="1%">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= ucwords($data['nama_dokter']); ?></td>
					<td><?= $data['spesialis']; ?></td>					
					<td><?= $data['telp_dokter']; ?></td>					
					<td>
						<a id="tombol-hapus" href="dokter_ubah.php?id_dokter=<?= $data['id_dokter']; ?>" class="badge badge-success"><i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Apakah Anda Ingin Menghapus <?= ucwords($data['nama_dokter']); ?> ?')" href="dokter_hapus.php?id_dokter=<?= $data['id_dokter']; ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>