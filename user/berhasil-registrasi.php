<?php
include '../funcition.php';
session_start();
if (isset($_SESSION["masuk"])) {
  echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Registrasi Akun</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top" style="background-color:#1ABC9C;">
     <div class="info-data" data-infodata="<?php if (isset($_SESSION['register'])) {
                                          echo $_SESSION['register'];
                                        }
                                         unset($_SESSION['register']);?>"></div>
  <header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
      <!-- Masthead Avatar Image-->
      <img class="masthead-avatar mb-5" src="../img/undraw_accept_terms_re_lj38.svg" alt="..." />
      <!-- Masthead Heading-->
      <div class="card">
        <div class="card-header text-dark">
          REGISTRASI BERHASIL
        </div>
        <div class="card-body text-dark">
          <h5 class="card-title">PASSWORD ANDA ADALAH</h5>
          <p class="card-text"><?= $_GET['password']; ?></p>
          <a href="cetak-kartu.php?password=<?= $_GET['password']; ?>" target="_blank" class="btn btn-primary">CETAK KARTU</a>
        </div>
      </div>
    </div>
  </header>
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
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
