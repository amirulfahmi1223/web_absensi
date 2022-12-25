<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_absensi";
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  echo "Koneksi Gagal" . mysqli_connect_error($conn);
}
function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
function tambahSiswa($data)
{
  global $conn;
  //ambil Id terbesar di kolom id pendaftaran,lalu ambil 5 karakter aja dari sebelah kanan 
  $getMaxId = mysqli_query($conn, "SELECT MAX(RIGHT(password, 3)) AS pass FROM tb_siswa");
  $d = mysqli_fetch_object($getMaxId);
  //menggunakan 0 sebanyak 5 kali menggunakan %05s
  $generatePass = 'SMKN4' . date('Y') . sprintf("%03s", $d->pass + 1);
  $nisn = $data["nisn"];
  $nama = htmlspecialchars($data["nama"]);
  $jk = htmlspecialchars($data["jk"]);
  $kelas = htmlspecialchars($data["kelas"]);
  $absen = htmlspecialchars($data["absen"]);
  $tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
  $alamat = htmlspecialchars($data["alamat"]);

  //upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }
  $result = mysqli_query($conn, "SELECT nisn FROM tb_siswa WHERE nisn = '$nisn'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>alert('Siswa sudah terdaftar');</script>";
    return false; //dihentikan funcitionya
    //supaya insert nya gagal dan yang bawah tidak dijalankan
  }
  //query insert data
  $query = "INSERT INTO tb_siswa 
                 VALUES 
('$nisn','$nama','$kelas','$absen','$gambar','$jk','$tgl_lahir','$alamat','1','$generatePass')
";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function upload()
{
  $namafile = $_FILES['gambar']['name'];
  $ukuranfile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  //cek apakah tidak ada gambar yang diupload
  if ($error === 4) {
    echo "<script>
    alert('Pilih gambar terlebih dahulu');
    </script>";
    return false;
  }

  //cek apakah yang diupload adalah gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
  $ekstensiGambar = explode('.', $namafile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
    alert('Yang anda upload bukan gambar');
    </script>";
    return false;
  }
  //cek jika ukurannya terlalu besar
  if ($ukuranfile > 2000000) {
    echo "<script>
    alert('Ukuran gambar terlalu besar!');
    </script>";
    return false;
  }
  //lolos pengecekan, gambar siap diupload
  //generate nama gambar baru
  $namafileBaru = uniqid();
  $namafileBaru .= '.';
  $namafileBaru .= $ekstensiGambar;
  move_uploaded_file($tmpName, '../image/' . $namafileBaru);
  return $namafileBaru;
}
function tambahKelas($data)
{
  global $conn;
  $kelas = htmlspecialchars($data["kelas"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  //upload gambar
  $logo = uploadLogo();
  if (!$logo) {
    return false;
  }

  $query = "INSERT INTO tb_kelas 
            VALUES ('','$kelas','$jurusan','$logo')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
function uploadLogo()
{
  $namafile = $_FILES['logo']['name'];
  $ukuranfile = $_FILES['logo']['size'];
  $error = $_FILES['logo']['error'];
  $tmpName = $_FILES['logo']['tmp_name'];

  //cek apakah tidak ada gambar yang diupload
  if ($error === 4) {
    echo "<script>
    alert('Pilih gambar terlebih dahulu');
    </script>";
    return false;
  }

  //cek apakah yang diupload adalah gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
  $ekstensiGambar = explode('.', $namafile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
    alert('Yang anda upload bukan gambar');
    </script>";
    return false;
  }
  //cek jika ukurannya terlalu besar
  if ($ukuranfile > 2000000) {
    echo "<script>
    alert('Ukuran gambar terlalu besar!');
    </script>";
    return false;
  }
  //lolos pengecekan, gambar siap diupload
  //generate nama gambar baru
  $namafileBaru = uniqid();
  $namafileBaru .= '.';
  $namafileBaru .= $ekstensiGambar;
  move_uploaded_file($tmpName, 'logo/' . $namafileBaru);
  return $namafileBaru;
}
function tambahOfficer($data)
{
  global $conn;
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $password = htmlspecialchars($data["password"]);
  $level = htmlspecialchars($data["level"]);
  //upload gambar
  $foto = uploadFoto();
  if (!$foto) {
    return false;
  }
  $result = mysqli_query($conn, "SELECT email FROM tb_admin WHERE email = '$email'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>alert('Email sudah terdaftar');</script>";
    return false; //dihentikan funcitionya
    //supaya insert nya gagal dan yang bawah tidak dijalankan
  }

  $query = "INSERT INTO tb_admin 
            VALUES ('','$nama','$email','$password','$foto','$level')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
function uploadFoto()
{
  $namafile = $_FILES['foto']['name'];
  $ukuranfile = $_FILES['foto']['size'];
  $error = $_FILES['foto']['error'];
  $tmpName = $_FILES['foto']['tmp_name'];

  //cek apakah tidak ada gambar yang diupload
  if ($error === 4) {
    echo "<script>
    alert('Pilih gambar terlebih dahulu');
    </script>";
    return false;
  }

  //cek apakah yang diupload adalah gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
  $ekstensiGambar = explode('.', $namafile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
    alert('Yang anda upload bukan gambar');
    </script>";
    return false;
  }
  //cek jika ukurannya terlalu besar
  if ($ukuranfile > 2000000) {
    echo "<script>
    alert('Ukuran gambar terlalu besar!');
    </script>";
    return false;
  }
  //lolos pengecekan, gambar siap diupload
  //generate nama gambar baru
  $namafileBaru = uniqid();
  $namafileBaru .= '.';
  $namafileBaru .= $ekstensiGambar;
  move_uploaded_file($tmpName, 'foto/' . $namafileBaru);
  return $namafileBaru;
}
function Absen($data)
{
  global $conn;
  //ambil Id terbesar di kolom id pendaftaran,lalu ambil 5 karakter aja dari sebelah kanan 
  $getMaxId = mysqli_query($conn, "SELECT MAX(RIGHT(id_absen, 3)) AS id FROM tb_absen");
  $d = mysqli_fetch_object($getMaxId);
  //menggunakan 0 sebanyak 5 kali menggunakan %05s
  $generateId = 'A' . date('d') . date('m') . date('Y') . sprintf("%03s", $d->id + 1);
  $nisn = htmlspecialchars($data["nisn"]);
  $nama = htmlspecialchars($data["nama"]);
  $jk = htmlspecialchars($data["jk"]);
  $id_kelas = htmlspecialchars($data["id_kelas"]);
  $absen = htmlspecialchars($data["absen"]);
  $query = "INSERT INTO tb_absen
            VALUES ('$generateId','$nisn','$nama','$jk','$id_kelas','$absen',null)";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
function ubahSiswa($data)
{
  global $conn;
  $nisn = $data["nisn"];
  $nama = htmlspecialchars($data["nama"]);
  $kelas = htmlspecialchars($data["kelas"]);
  $absen = htmlspecialchars($data["absen"]);
  $jk = htmlspecialchars($data["jk"]);
  $tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
  $alamat = htmlspecialchars($data["alamat"]);
  $status = htmlspecialchars($data["status"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  //cek apakah user pilih gambar baru atau tidak
  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }
  $query = "UPDATE tb_siswa
                 SET 
                 nisn = '$nisn',
                 nama_siswa = '$nama',
                 id_kelas = '$kelas',
                 absen = '$absen',
                 jk = '$jk',
                 tanggal_lahir = '$tgl_lahir',
                 status = '$status',
                 alamat = '$alamat',
                 gambar = '$gambar'
                 WHERE nisn = '$data[nisn]'";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
function ubahKelas($data)
{
  global $conn;
  $kelas = htmlspecialchars($data["kelas"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $logoLama = htmlspecialchars($data["logoLama"]);
  //cek apakah user pilih gambar baru atau tidak
  if ($_FILES['logo']['error'] === 4) {
    $logo = $logoLama;
  } else {
    $logo = uploadLogo();
  }
  $query = "UPDATE tb_kelas 
           SET 
           nama_kelas = '$kelas',
           jurusan = '$jurusan',
           logo = '$logo'
           WHERE id_kelas = '$data[id_kelas]'";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}


function ubahOfficer($data)
{
  global $conn;
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $password = htmlspecialchars($data["password"]);
  $level = htmlspecialchars($data["level"]);
  $fotoLama = htmlspecialchars($data["fotoLama"]);
  //cek apakah user pilih gambar baru atau tidak
  if ($_FILES['foto']['error'] === 4) {
    $foto = $fotoLama;
  } else {
    $foto = uploadFoto();
  }
  $query = "UPDATE tb_admin 
           SET 
           admin_name = '$nama',
           email = '$email',
           password = '$password',
           foto = '$foto',
           level = '$level'
           WHERE admin_id = '$data[admin_id]'";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapusSiswa($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_siswa WHERE nisn = $id");
  return mysqli_affected_rows($conn);
}
function hapusKelas($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_kelas WHERE id_kelas = $id");
  return mysqli_affected_rows($conn);
}
function hapusOfficer($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_admin WHERE admin_id = $id");
  return mysqli_affected_rows($conn);
}
function cari($keyword)
{
  $query = "SELECT * FROM tb_kelas
      WHERE
      nama_kelas LIKE '%$keyword%'";
  return query($query); //query diambil dari atas/pertama
  //yaitu funcition query($query) jadi tidak dari variabel query cari
}
