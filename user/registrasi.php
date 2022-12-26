<?php
//bisa menggunakan include atau require
session_start();

include '../funcition.php';
if (isset($_SESSION["masuk"])) {
  echo '<script>window.location="login.php"</script>';
}
$getMaxId = mysqli_query($conn, "SELECT MAX(RIGHT(password, 3)) AS pass FROM tb_siswa");
$d = mysqli_fetch_object($getMaxId);
//menggunakan 0 sebanyak 5 kali menggunakan %05s
$generatePass = 'SMKN4' . date('Y') . sprintf("%03s", $d->pass + 1);
if (isset($_POST['submit'])) {
  if (tambahSiswa($_POST) > 0) {
    $_SESSION['register'] = 'Berhasil';
    echo '<script>window.location = "../user/berhasil-registrasi.php?password=' . $generatePass . '"</script>';
  } else {
    $_SESSION['register'] = 'Gagal';
    echo mysqli_error($conn);
  }
}

$select = query("SELECT * FROM tb_kelas ORDER BY nama_kelas ASC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Registrasi Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>
<style>
    body {
    background-color: #f8f8f8;
  }
</style>
<body class="sb-nav-fixed">
    <!-- SWAL -->
  <div class="info-data" data-infodata="<?php if (isset($_SESSION['register'])) {
                                          echo $_SESSION['register'];
                                        }
                                        ?>"></div>
  <div id="layoutSidenav_content">
    <main>
      <div class="container px-3">
        <h3 class="alert alert-primary text-center mt-3">FORM REGISTRASI ABSENSI SISWA</h3>
        <div class="row">
          <div class="col-md-12 ">
            <div class="card shadow-lg mb-5">
              <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                  <div class="form-group">
                    <label for="inputAddress">Nisn</label>
                    <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" maxlength="12" class="form-control" id="validationCustom04" name="nisn" placeholder="Masukkan Nisn" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      Please choose a nisn.
                    </div>
                  </div>
                  <div class="form-group mt-4">
                    <label for="">Nama Lengkap</label>
                    <input type="text" maxlength="125" class="form-control" id="validationCustom02" name="nama" placeholder="Masukkan Nama Lengkap" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      Please choose a nama lengkap.
                    </div>
                  </div>
                  <div class="form-group mt-4">
                    <label for="">Kelas</label>
                    <select name="kelas" id="" class="form-control" id="validationCustom02" required>
                      <option value="">-- PILIH KELAS --</option>
                      <?php foreach ($select as $row) : ?>
                        <option value="<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      Please choose a kelas.
                    </div>
                  </div>
                  <div class="form-group mt-4">
                    <label for="">No. Absen</label>
                    <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" maxlength="5" class="form-control" id="validationCustom04" name="absen" placeholder="Masukkan No. Absen" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      Please choose a no absen.
                    </div>
                  </div>
                  <div class="form-group mt-4">
                    <label for="">Jenis Kelamin</label>
                    <select name="jk" id="" class="form-control" id="validationCustom02" required>
                      <option value="">-- PILIH --</option>
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      Please choose a kelas.
                    </div>
                  </div>
                  <div class="form-group mt-4">
                    <label for="">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="validationCustom02" name="tgl_lahir" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      Please choose a tanggal lahir.
                    </div>
                  </div>
                  <div class="form-group mt-4">
                    <label for="">Alamat</label>
                    <textarea name="alamat" cols="30" rows="5" required class="form-control" id="validationCustom02" placeholder="Masukkan Alamat"></textarea>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      Please choose a alamat.
                    </div>
                  </div>
                  <div class="form-group mt-4 mb-4">
                    <input type="file" class="form-control-file mt-2" name="gambar" required>
                    <small>Masukkan foto 3X4 dengan ukuran maksimal 2 MB</small>
                  </div>
                  <!--Bagian Button-->
                  <input type="submit" class="btn btn-primary w-25" name="submit" value="Daftar">
                </form>
              </div>
            </div>
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
  <!-- sweet alert -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <!-- Swal -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
  <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
  <script>
    const notifikasi = $('.info-data').data('infodata');

    if (notifikasi == "Berhasil") {
      Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Registrasi Berhasil',
      })
    } else if (notifikasi == "Gagal") {
      Swal.fire({
        icon: 'error',
        title: 'GAGAL',
        text: 'Registrasi Gagal!',
      })
    } else if (notifikasi == "Kosong") {

    }
  </script>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
  <script src="js/datatables-simple-demo.js"></script>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</body>

</html>
