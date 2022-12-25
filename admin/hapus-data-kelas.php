<?php
session_start();
if (!isset($_SESSION["login"])) {
  echo '<script>window.location="../login.php"</script>';
}
if ($_SESSION["level"] != 'Admin') {
  echo '<script>window.location="../login.php"</script>';
}
include '../funcition.php';
$id = $_GET['id_kelas'];
if ($id == '') {
  echo '<script>window.location="../data-kelas.php"</script>';
}
if (hapusKelas($id) > 0) {
  echo "<script>alert('Hapus data berhasil')</script>";
  echo "<script>window.location='data-kelas.php'</script>";
} else {
  echo "<script>alert('Hapus data gagal')</script>";
  echo mysqli_error($conn);
}
