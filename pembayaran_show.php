<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$sql = "SELECT * FROM tb_pembayaran
			INNER JOIN tb_pasien ON tb_pasien.id_pasien = tb_pembayaran.id_pasien
			INNER JOIN tb_ruangan ON tb_ruangan.id_ruangan = tb_pembayaran.id_ruangan
			INNER JOIN tb_admin ON tb_admin.id_admin = tb_pembayaran.id_admin
			ORDER BY id_pembayaran DESC
			";
	$eksekusi = mysqli_query($koneksi, $sql);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pembayaran</title>
	<link rel="icon" href="img/hospital.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<h3 class="mt-3">PEMBAYARAN </h3>
		<table class="table table-striped" id="Table" style="width: 110%; margin-left: -5%">
			<thead class="text-white bg-success">
				<tr>
					<th>NO</th>
					<th>PASIEN</th>
					<th>RUANGAN</th>
					<th>LAMA NGINAP</th>
					<th>HARGA PERMALAM</th>
					<th>TOTAL</th>
					<th>STATUS</th>
					<th>ADMIN</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><a href="pasien_show.php?id_pasien=<?= $data['id_pasien']; ?>" style="text-decoration: none; font-weight: bold;"><?= $data['nama_pasien']; ?></a></td>
					<td><a href="ruangan_show.php?id_ruangan=<?= $data['id_ruangan']; ?>" style="text-decoration: none; font-weight: bold;"><?= $data['jenis_ruangan']; ?></a></td>
					<td><?= $data['lama_nginap']; ?></td>
					<td>Rp <?= str_replace(",", ".", number_format($data['harga_permalam'])); ?></td>
					<td>Rp <?= str_replace(",", ".", number_format($total_harga = ($data['harga_permalam']*$data['lama_nginap']))); ?></td>
					<td>
						<?php if ($data['pembayaran'] == 'Belum Dibayar'): ?>
							<a class="badge badge-danger" href="pembayaran.php?id_pembayaran=<?= $data['id_pembayaran']; ?>"><?= $data['pembayaran']; ?></a>
						<?php else: ?>
							<a class="btn btn-success" href><?= $data['pembayaran']; ?></a>
						<?php endif ?>
					</td>
					<td><?= ucfirst($data['nama_admin']); ?></td>
					<td>
						<a href="pembayaran_ubah.php?id_pembayaran=<?= $data['id_pembayaran']; ?>" class="badge badge-success"><i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Apakah Anda Ingin Menghapus Pembayaran Ini ?')" href="pembayaran_hapus.php?id_pembayaran=<?= $data['id_pembayaran']; ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>