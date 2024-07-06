  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="bootstrap/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="font-awesome/css/all.min.css">
<style type="text/css">
    .container {
        margin-top: 30px;
    }
    .dropdown-toggle,
    .dropdown-menu {
        border-radius: 0px !important;
    }
    .dropdown-item:hover {
        color: white;
        background-color: #0f4c81;
    }
    .btn-danger {
        width: 55%;
    }
    .dropdown:hover>.dropdown-menu {
      display: block;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if ($_SERVER['REQUEST_URI'] == '/rumah_sakit/dashboard.php'): ?>
        <li class="nav-item active">
      <?php else: ?>
        <li class="nav-item">
      <?php endif ?>
        <a class="nav-link" href="dashboard.php"><i class="fa fa-hospital"></i> Dashboard</a>
      </li>

      <?php if ($_SERVER['REQUEST_URI'] == '/rumah_sakit/admin_show.php' OR $_SERVER['REQUEST_URI'] == '/rumah_sakit/admin_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/rumah_sakit/admin_ubah.php'): ?>
      <li class="nav-item dropdown active">
      <?php else: ?>
      <li class="nav-item dropdown">
      <?php endif ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user-alt"></i> Admin
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="admin_show.php"><i class="fa fa-user-alt"></i> Admin</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="admin_tambah.php"><i class="fa fa-user-plus"></i> Tambah Admin</a>
        </div>
      </li>

      <?php if ($_SERVER['REQUEST_URI'] == '/rumah_sakit/dokter_show.php' OR $_SERVER['REQUEST_URI'] == '/rumah_sakit/dokter_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/rumah_sakit/dokter_ubah.php'): ?>
      <li class="nav-item dropdown active">
      <?php else: ?>
      <li class="nav-item dropdown">
      <?php endif ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-stethoscope"></i> Dokter
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="dokter_show.php"><i class="fa fa-stethoscope"></i> Dokter</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="dokter_tambah.php"><i class="fa fa-stethoscope"></i><strong>+</strong> Tambah Dokter</a>
        </div>
      </li>

      <?php if ($_SERVER['REQUEST_URI'] == '/rumah_sakit/pasien_show.php' OR $_SERVER['REQUEST_URI'] == '/rumah_sakit/pasien_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/rumah_sakit/pasien_ubah.php'): ?>
      <li class="nav-item dropdown active">
      <?php else: ?>
      <li class="nav-item dropdown">
      <?php endif ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-users"></i> Pasien
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="pasien_show.php"><i class="fa fa-users"></i> Pasien</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="pasien_tambah.php"><i class="fa fa-user-plus"></i> Tambah Pasien</a>
        </div>
      </li>

      <?php if ($_SERVER['REQUEST_URI'] == '/rumah_sakit/pembayaran_show.php' OR $_SERVER['REQUEST_URI'] == '/rumah_sakit/pembayaran_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/rumah_sakit/pembayaran_ubah.php' OR $_SERVER['SCRIPT_NAME'] == '/rumah_sakit/pembayaran.php'): ?>
      <li class="nav-item dropdown active">
      <?php else: ?>
      <li class="nav-item dropdown">
      <?php endif ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-money-bill"></i> Pembayaran
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="pembayaran_show.php"><i class="fa fa-money-bill"></i> Pembayaran</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="pembayaran_tambah.php"><i class="fa fa-money-bill"></i><strong>+</strong> Tambah Pembayaran</a>
        </div>
      </li>

      <?php if ($_SERVER['REQUEST_URI'] == '/rumah_sakit/ruangan_show.php' OR $_SERVER['REQUEST_URI'] == '/rumah_sakit/ruangan_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/rumah_sakit/ruangan_ubah.php' OR $_SERVER['SCRIPT_NAME'] == '/rumah_sakit/ruangan.php'): ?>
      <li class="nav-item dropdown active">
      <?php else: ?>
      <li class="nav-item dropdown">
      <?php endif ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-door-closed"></i> Ruangan
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="ruangan_show.php"><i class="fa fa-door-closed"></i> Ruangan</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="ruangan_tambah.php"><i class="fa fa-door-closed"></i><strong>+</strong> Tambah Ruangan</a>
        </div>
      </li>


      <li class="nav-item">
        <a onclick="return confirm('Apakah anda ingin keluar?')" class="nav-link" href="logout.php"><i class="fa fa-door-open"></i> Keluar</a>
      </li>
    </ul>
      <?php 
        $username = ucwords($_SESSION['username']);
       ?>
      <b class="mr-sm-2 mb-n1 text-white">Admin, <?= $username; ?></b>
  </div>
</nav>