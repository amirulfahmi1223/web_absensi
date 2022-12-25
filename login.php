<?php
//mengembalikan ke dashboard jika sudah login jika belum login
//$_SESSION adalah mekanisme penyimpanan informasi kedalam variabel agar
// $_SESSION['login'] = true;
//bisa digunakan lebih dari satu halaman
session_start();
include 'funcition.php';
// //cek cookei login
// if (isset($_COOKIE['login'])) {
//   //cek value
//   if ($_COOKIE['login'] == 'true') {
//     //set session true
//     $_SESSION['login'] = true;
//   }
// }
//kalo ada $_SESSION['login'] / kalo sudah login maka kembalikan ke index
//jika ada session[login]
if (isset($_SESSION["login"])) {
  echo '<script>window.location="admin/index.php"</script>';
}

if (isset($_POST["login"])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  //cek akun ada apa tidak
  $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE email = '" . $email . "' AND password = '" . $password . "'");
  //cek validasi login
  if (mysqli_num_rows($cek) > 0) {
    $a = mysqli_fetch_object($cek);
    $_SESSION['login'] = true;
    $_SESSION['admin_id'] = $a->admin_id;
    $_SESSION['nama'] = $a->admin_name;
    $_SESSION['email'] = $a->email;
    $_SESSION['foto'] = $a->foto;
    $_SESSION['level'] = $a->level;

    //$_COOKEI sendiri untuk menyimpan data user untuk beberapa waktu
    //ada waktu kadarulasa

    echo '<script>alert("Login Berhasil")</script>';
    echo '<script>window.location="admin/index.php"</script>';
  } else {
    echo '<script>alert("Gagal, username atau password salah")</script>';
  }
}
//untuk password_verify,password_hash
// session_start();
// require 'funcition.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Login</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;700&display=swap" rel="stylesheet">
</head>

<body>
  <div class="overlay"></div>
  <form action="" method="POST" class="box">
    <div class="header">
      <h3>Login To Administator</h3>
      <p> "Pendidikan adalah senjata paling ampuh yang dapat kamu gunakan untuk mengubah dunia." - Nelson Mandela</p>
    </div>
    <div class="login-area">
      <input type="email" name="email" class="username" placeholder="Masukkan Email">
      <input type="password" name="password" class="password" placeholder="Masukkan Password">
      <input type="submit" name="login" value="Login" class="submit">
      <a href="#">Forgot Password?</a>
    </div>
  </form>
</body>

</html>