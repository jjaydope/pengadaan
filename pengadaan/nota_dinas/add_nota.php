<?php
include '../koneksi.php';
session_start();
if ($_SESSION['role_id'] != '1') {
	echo "<script>alert('Role tidak benar');location.href='../notadinas.php';</script>";
}

if (isset($_POST['simpan'])) {
	// echo var_dump($_POST);
	$nomor = $_POST['nomor_surat'];
	$keperluan = $_POST['keperluan'];
	$harga = $_POST['harga'];
	$status = $_POST['status'];
	$tgl = $_POST['tgl'];


	// Menyimpan ke database;
	mysqli_query($conn, "INSERT INTO nota_dinas VALUES ('$nomor','$keperluan','$harga','$status','$tgl')");

	$_SESSION['success'] = 'Berhasil menambahkan data';

	// mengalihkan halaman ke list barang
	header("location:../notadinas.php");
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Kasir</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>


<body>
	<div class="container">
		<h1>Pengadaan</h1>
		<form method="post">
			<div class="form-group">
				<label>nomor surat </label>
				<input type="text" name="nomor_surat" class="form-control" placeholder="nomor surat">
			</div>
			<div class="form-group">
				<label>keperluan</label>
				<input type="text" name="keperluan" class="form-control" placeholder="keperluan">
			</div>
			<div class="form-group">
				<label>Harga</label>
				<input type="number" name="harga" class="form-control" placeholder="Harga Pengadaan">
			</div>
			<div class="form-group">
				<label>Tanggal</label>
				<input type="date" name="tgl" class="form-control" placeholder="Tanggal">
			</div>
			<div class="form-group">
				<label for="status" class="form-label">status : </label>
				<br>
				<select name="status" id="status" class="form-select">
					<option disabled selected>Pilih Status </option>
					<option value="raw">raw</option>
					<!-- <option value="Sekertariat">Sekertariat</option> -->
					<!-- <option value="Confirmed(input BAST)">Confirmed(input BAST)</option> -->
				</select>
			</div>

			<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
			<a href="../notadinas.php" class="btn btn-warning">Kembali</a>
		</form>

	</div>
</body>

</html>