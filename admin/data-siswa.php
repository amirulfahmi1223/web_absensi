<?php
//bisa menggunakan include atau require
session_start();

include '../funcition.php';
//cek kalo gada session login maka blm login
//kembalikan ke login
//jika tidak ada session[login] maka tendang ke login.php
if (!isset($_SESSION["login"])) {
  echo '<script>window.location="../login.php"</script>';
}
//cek jika tidak admin
if ($_SESSION["level"] != 'Admin') {
  echo "<script>alert('Akses Ditolak Anda Bukan Admin')</script>";
  echo '<script>window.location="../login.php"</script>';
}
$select = query("SELECT tb_siswa.nisn,tb_siswa.nama_siswa,tb_siswa.absen,
                        tb_siswa.gambar,tb_siswa.jk,tb_siswa.gambar,
                        tb_siswa.alamat,tb_siswa.status,tb_siswa.password,tb_kelas.nama_kelas
                        FROM tb_siswa
                        INNER JOIN tb_kelas ON tb_siswa.id_kelas=tb_kelas.id_kelas");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Dashboard - Administator</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="../user/assets/favicon.ico" />
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>

<body class="sb-nav-fixed">
  <!-- SWAL -->
  <div class="info-data" data-infodata="<?php if (isset($_SESSION['info'])) {
                                          echo $_SESSION['info'];
                                        }
                                        unset($_SESSION['info']); ?>"></div>
  <!-- akhir -->
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-black">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="../user/index.php">Administator Sekolah</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
      </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="setting.php">Settings</a></li>
          <li><a class="dropdown-item" href="#!">Activity Log</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" data-toggle="modal" data-target="#logout" href="keluar.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Navigasi</div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <a class="nav-link mt-2 mb-2" href="index.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard
            </a>
            <!-- Divider -->
            <?php if ($_SESSION['level'] == 'Admin') :  ?>
              <hr class="sidebar-divider my-0">
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#datakelas" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon">
                  <i class="fa-solid fa-school"></i>
                </div>
                Data Kelas
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="datakelas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="data-kelas.php"><i class="fa fa-angle-double-right me-2"></i>Data Kelas</a>
                  <a class="nav-link" href="tambah-kelas.php"><i class="fa fa-angle-double-right me-2"></i>Tambah Kelas</a>
                </nav>
              </div>
              <!-- Divider -->
              <hr class="sidebar-divider my-0">
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#datasiswa" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                Data Siswa
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="datasiswa" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="data-siswa.php"><i class="fa fa-angle-double-right me-2"></i>Data Siswa</a>
                  <a class="nav-link" href="tambah-siswa.php"><i class="fa fa-angle-double-right me-2"></i>Tambah Siswa</a>
                </nav>
              </div>
              <!-- Divider -->
              <hr class="sidebar-divider my-0">
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#officer" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                Officer
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="officer" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="data-officer.php"><i class="fa fa-angle-double-right me-2"></i>Data Officer</a>
                  <a class="nav-link" href="tambah-officer.php"><i class="fa fa-angle-double-right me-2"></i>Tambah Officer</a>
                </nav>
              </div>
            <?php endif; ?>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <a class="nav-link mt-2 mb-2" href="data-absensi.php">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
              Data Absensi
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <a class="nav-link mt-2 mb-2" href="setting.php">
              <div class="sb-nav-link-icon"> <i class="fas fa-cogs fa-sm fa-fw"></i></div>
              Setting
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <a class="nav-link mt-2 mb-2" data-toggle="modal" data-target="#logout" href="keluar.php">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
              Log Out
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h2 class="mt-4 mb-3">Data Siswa</h2>
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Data Seluruh Siswa
            </div>
            <div class="card-body">
              <table id="datatablesSimple" class="text-center">
                <thead>
                  <tr>
                    <th class="text-center">Nisn</th>
                    <th class="text-center">Nama Siswa</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Absen</th>
                    <th class="text-center">JK</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Password</th>
                    <th colspan="2" scope="col" class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th class="text-center">Nisn</th>
                    <th class="text-center">Nama Siswa</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Absen</th>
                    <th class="text-center">JK</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Password</th>
                    <th colspan="2" scope="col" class="text-center">Aksi</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($select as $row) : ?>
                    <tr>
                      <td><?= $row['nisn']; ?></td>
                      <td><?= $row['nama_siswa']; ?></td>
                      <td><?= $row['nama_kelas']; ?></td>
                      <td><?= $row['absen']; ?></td>
                      <td><?= $row['jk']; ?></td>
                      <td><?= $row['alamat']; ?></td>
                      <td><a href="../image/<?php echo $row['gambar'] ?>" target="_blank"><img src="../image/<?= $row['gambar']; ?>" height="50px" width="50px"></td>
                      <td><?php echo ($row['status'] == 0) ? 'Tidak Aktif' : 'Aktif'; ?></a></td>

                      <td><?= $row['password']; ?></td>
                      <td>
                        <a href="edit-siswa.php?nisn=<?php echo $row['nisn'];  ?>" class="btn btn-success text-white rounded"><i class="fa-solid fa-pen-to-square"></i></a>
                      </td>
                      <td><a href="hapus-data-siswa.php?nisn=<?= $row['nisn']; ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger text-white rounded delete-siswa"><i class="fa-solid fa-trash-can"></i></a>
                      </td>
                      </td>
                    </tr>
                  <?php endforeach;  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; SMK TARUNA 2022</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Logout Modal-->
  <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah Anda Yakin Ingin Keluar?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="keluar.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <!-- sweetalert -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <!-- Swal -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
  <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
  <script src="js/js-ku.js"></script>
  <!-- akhir -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
  <script src="js/datatables-simple-demo.js"></script>
</body>

</html>