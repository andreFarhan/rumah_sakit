<?php 
  include 'functions.php';

  $id_admin = $_SESSION['id_admin'];
  $admin = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE id_admin = '$id_admin'");
  $data_admin = mysqli_fetch_assoc($admin);
  
  $i=1;$jml_total=0;

  $id_pembayaran = $_GET['id_pembayaran'];

  $sql_ruangan = "SELECT * FROM tb_ruangan 
    INNER JOIN tb_pembayaran ON tb_pembayaran.id_ruangan = tb_ruangan.id_ruangan
    WHERE id_pembayaran = '$id_pembayaran'";
  $eksekusi_ruangan = mysqli_query($koneksi, $sql_ruangan);

  $sql_pembayaran = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran 
    INNER JOIN tb_pasien ON tb_pembayaran.id_pasien =  tb_pasien.id_pasien 
    WHERE id_pembayaran = '$id_pembayaran'");
  $fetch_pembayaran = mysqli_fetch_assoc($sql_pembayaran);

  $sql_total_harga = mysqli_query($koneksi, "SELECT SUM(harga_permalam*lama_nginap) as jml_harga FROM tb_pembayaran
    INNER JOIN tb_ruangan ON tb_ruangan.id_ruangan = tb_pembayaran.id_ruangan
  WHERE tb_pembayaran.id_pembayaran = '$id_pembayaran'
  ");
  $eksekusi_total_harga = mysqli_fetch_assoc($sql_total_harga);
  $total_harga = $eksekusi_total_harga['jml_harga'];


  if (isset($_POST['bayar'])) {
    $pembayaran_harga = $_POST['pembayaran_harga'];
    $nama_pasien = $_POST['nama_pasien'];
    $uang_bayar = $_POST['uang_bayar'];
    if ($uang_bayar >= $pembayaran_harga) {
      $kembalian = $uang_bayar - $pembayaran_harga;
      $id_pembayaran = $_POST['id_pembayaran'];
      
      $cek_sql_update = mysqli_affected_rows($koneksi);

    } else {
      $kembalian = (int)$uang_bayar - (int)$pembayaran_harga;
        setAlert('Gagal!','Uang Yang Dibayar Kurang!','error');
        header("Location: pembayaran.php?id_pembayaran=$id_pembayaran");
        die;
    }
  }

  if (isset($_POST['selesai'])) {
    $pembayaran_harga = $_POST['pembayaran_harga'];
    $uang_bayar = $_POST['uang_bayar'];
    $kembalian = $uang_bayar - $pembayaran_harga;
    $id_pembayaran = $_POST['id_pembayaran'];

    $sql_bayar = mysqli_query($koneksi, "UPDATE tb_pembayaran SET pembayaran = 'Lunas' WHERE id_pembayaran = '$id_pembayaran'");

    setAlert('Berhasil!','Pembayaran Berhasil','success');
    header("Location: pembayaran_show.php?id_pembayaran=$id_pembayaran");
    die;
    
  }

  $pembayaran_harga = $total_harga;


?>

<!DOCTYPE html>
<html lang="en" id="page-top">
  <head>
    <title>Pembayaran</title>
    <link rel="icon" href="img/sneaker-fill.svg">
  </head>
  <body>
    <?php include 'nav.php'; ?>
      <div class="container mt-5">
        <h1>Pembayaran</h1>
        <div class="row mb-3">
          <div class="col-md-4 mx-2 p-4 rounded text-white" style="background-color: #5D9C59;">
            <h5>Pembayaran</h5>
            <form method="post">
              <?php if (isset($_POST['bayar'])): ?>
                <input type="hidden" name="id_pembayaran" value="<?= $id_pembayaran; ?>">
                <input type="hidden" name="uang_bayar" value="<?= $uang_bayar; ?>">
              <?php endif ?>
              <input type="hidden" name="id_pembayaran" value="<?= $fetch_pembayaran['id_pembayaran']; ?>">
              <input type="hidden" name="nama_pasien" value="<?= $fetch_pembayaran['nama_pasien']; ?>">
              
              <div class="form-group">
                <label for="Nama pasien">Nama pasien</label>
                <?php if (isset($_POST['bayar'])): ?>
                  <input style="cursor: not-allowed;" disabled value="<?= $nama_pasien; ?>" type="text" id="Nama pasien" class="form-control" name="Nama pasien">
                <?php else: ?>
                  <input style="cursor: not-allowed;" disabled value="<?= $fetch_pembayaran['nama_pasien']; ?>" type="text" id="Nama pasien" class="form-control" name="Nama pasien">
                <?php endif ?>
              </div>

              <hr style="border: 1px solid">

              <div class="form-group">
                <label for="pembayaran_harga"><b>TOTAL PEMBAYARAN</b></label>
                <input style="cursor: not-allowed;" type="text" disabled value="Rp <?= str_replace(",", ".", number_format($pembayaran_harga)); ?>" id="pembayaran_harga" class="form-control text-right">
              </div>

              <input type="hidden" name="pembayaran_harga" value="<?= $pembayaran_harga; ?>">

              <hr style="border: 1px dotted">

              <div class="form-group">
                <label for="uang_bayar">Uang yang dibayar</label>
                <?php if (isset($_POST['bayar'])): ?>
                <input style="cursor: not-allowed;" disabled type="text" id="uang_bayar" class="form-control text-right" name="uang_bayar" value="Rp <?= str_replace(",", ".", number_format($uang_bayar)); ?>">
                <?php else: ?>
                <input type="number" id="uang_bayar" class="form-control text-right" name="uang_bayar">
                <?php endif ?>
              </div>
              <?php if (isset($_POST['bayar'])): ?>
                <div class="form-group">
                  <label for="kembalian">Kembalian</label>
                  <input style="cursor: not-allowed;" disabled type="text" id="kembalian" class="form-control text-right" name="kembalian" value="Rp <?= str_replace(",", ".", number_format($kembalian)); ?>">
                </div>
              <?php endif ?>
              <?php if (isset($_POST['bayar'])): ?>
                <button type="submit" name="selesai" class="btn btn-primary"><i class="fas fa-fw fa-handshake"></i> Selesai</button>
              <?php else: ?>
                <button type="submit" name="bayar" class="btn btn-primary"><i class="fas fa-fw fa-handshake"></i> Bayar</button>
                <a href="pembayaran_show.php" class="btn text-white bg-danger"> Batal</a>
              <?php endif ?>
            </form>
          </div>
          <div class="col-md-7 mx-2 p-4 rounded text-white" style="background-color: #5D9C59;">
            <div class="table-responsive">
              <h4>Daftar Pembelian</h4>
              <table class="table text-white">
                <tr>
                  <th>Jenis Ruangan</th>
                  <th>Lama Nginap</th>
                  <th>Harga</th>
                  <th>Total</th>
                </tr>
                <?php while ($data_ruangan = mysqli_fetch_array($eksekusi_ruangan)): ?>
                  <tr>
                    <td><?= $data_ruangan['jenis_ruangan']; ?></td>
                    <td><?= $data_ruangan['lama_nginap']; ?></td>
                    <td>Rp <?= str_replace(",", ".", number_format($data_ruangan['harga_permalam'])); ?></td>
                    <td>Rp <?= str_replace(",", ".", number_format($total=($data_ruangan['lama_nginap']*$data_ruangan['harga_permalam']))); ?></td>
                  </tr>
                <?php endwhile ?>
              </table>
            </div>
          </div>
        </div>
      </div>
  </body>
  <?php include 'footer.php'; ?>
</html>