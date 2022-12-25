<?php
session_start();
if (!isset($_SESSION["login"])) {
  echo '<script>window.location="../login.php"</script>';
}
if ($_SESSION["level"] != 'Admin') {
  echo '<script>window.location="../login.php"</script>';
}
include '../funcition.php';
$id = $_GET['admin_id'];
if ($id == 'admin_id') {
  echo '<script>window.location="../data-siswa.php"</script>';
}
if (hapusOfficer($id) > 0) {
  $_SESSION['info'] = 'Dihapus';
  echo "<script>window.location='data-officer.php'</script>";
} else {
  $_SESSION['info'] = 'Gagal Dihapus';
  echo mysqli_error($conn);
}
