<?php
include '../funcition.php';
session_start();
//disini saya menggunakan mysqli_fetch_objek karena pake assoc tidak bisa
//menggunakan query inner join berdasarkan password yang diambil dari parameter $_GET penulisan get yang benar adalah = '".$_GET['password']."'

//PENGGUNAAN INNER JOIN YANG BENAR BEGITU JUGA LEFT AND RIGHT
$select = mysqli_query($conn, "SELECT * FROM tb_siswa
												INNER JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE tb_siswa.password = '" . $_GET['password'] . "'");
$row = mysqli_fetch_object($select);
?>

<!DOCTYPE html>
<html>

<head>
	<title>Cetak Kartu</title>
	<style type="text/css">
		table {
			border-style: double;
			border-width: 3px;
			border-color: white;
		}

		table tr .text2 {
			text-align: right;
			font-size: 13px;
		}

		table tr .text {
			text-align: center;
			font-size: 13px;
		}

		table tr td {
			font-size: 13px;
		}
	</style>
</head>
<script>
	window.print();
</script>

<body>
	<center>
		<table>
			<tr>
				<td><img src="download.jfif" width="100" height="100"></td>
				<td>
					<center>
						<font size="4">PEMERINTAH KABUPATEN BOJONEGORO</font><br>
						<font size="5"><b>SMK NEGERI 4 BOJONEGORO</b></font><br>
						<font size="2">Bidang Keahlian : Bisnis dan Menejemen - Teknologi informasi dan Komunikasi</font><br>
						<font size="2"><i>Jln Raya Sokowati Kode Pos : 68173 Telp./Fax (0331)758005 Sukowati Bojonegoro Jawa
								Timur</i></font>
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<hr>
				</td>
			</tr>
			<table class="table-data" width="585" border="1" cellspacing="0" cellpadding="6" align="center">
				<!-- <tr align="center" bgcolor="#66CC33">
					<td width="174">DATA DIRI</td>
					<td width="300">KETERANGAN</td>
					<td width="192">FOTO</td>
				</tr> -->
				<tr>
					<td>Nisn</td>
					<td><?= $row->nisn ?></td>
					<td rowspan="10" align="center"><a href="../image/<?php echo $row->gambar ?>" target="_blank"><img src="../image/<?= $row->gambar; ?>" width="190" height="313"></td>
				</tr>
				<tr>
					<td>Nama Lengkap</td>
					<td><?= $row->nama_siswa ?></td>
				</tr>
				<tr>
					<td>Kelas</td>
					<td><?= $row->nama_kelas ?></td>
				</tr>
				<tr>
					<td>Jurusan</td>
					<td><?= $row->jurusan ?></td>
				</tr>
				<tr>
					<td>No.Absen</td>
					<td><?= $row->absen ?></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td><?= $row->jk ?></td>
				</tr>
				<tr>
					<td>Tanggal Lahir</td>
					<td><?= $row->tanggal_lahir ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><?= $row->alamat ?></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><?= $row->nisn ?></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><?= $row->password ?></td>
				</tr>
			</table>
		</table>
	</center>
</body>

</html>



<!-- <table width="745" class="table-data" border="0" cellpadding="8">
				<tr>
					<td>Nisn</td>
					<td><?= $row->nisn ?></td>
					<td rowspan="10" align="center"><a href="../image/<?php echo $row->gambar ?>" target="_blank"><img src="../image/<?= $row->gambar; ?>" height="50px" width="210" height="313"></td>
				</tr>
				<tr>
					<td>Nama Lengkap</td>
					<td><?= $row->nama_siswa ?></td>
				</tr>
				<tr>
					<td>Kelas</td>
					<td><?= $row->nama_kelas ?></td>
				</tr>
				<tr>
					<td>Jurusan</td>
					<td><?= $row->jurusan ?></td>
				</tr>
				<tr>
					<td>No.Absen</td>
					<td><?= $row->absen ?></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>Laki-laki</td>
				</tr>
				<tr>
					<td>Tanggal Lahir</td>
					<td><?= $row->tanggal_lahir ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><?= $row->alamat ?></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><?= $row->nisn ?></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><?= $row->password ?></td>
				</tr>
			</table> -->