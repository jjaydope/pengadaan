<?php
session_start();
if ($_SESSION['role_id'] != '1') {
    echo "<script>alert('Role tidak benar');location.href='../user.php';</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengadaan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- css bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
</head>

<body>
    <div class="container">
        <div align="center">
            <h3>TAMBAH PETUGAS</h3>
        </div>
        <form action="proses_user.php" method="post" enctype="multipart/form-data">
            Nama :
            <input type="varchar" name="nama" value="" class="form-control">
            Username :
            <input type="varchar" name="username" value="" class="form-control">
            Password :
            <input type="password" name="password" value="" class="form-control">
            <br>
            Role:
            <select name="role" id="role" class="form-select">
                <option disabled>Role</option>
                <?php
                include "../koneksi.php";
                $qry_member = mysqli_query($conn, "select * from role");
                while ($data_member = mysqli_fetch_array($qry_member)) {
                    echo '<option value="' . $data_member['id_role'] . '">' . $data_member['nama'] . '</option>';
                }
                ?>
            </select>

            <br />
            <input type="submit" name="simpan" value="Tambah Petugas" class="btn btn-primary">
            <a href="../user.php" class="btn btn-warning">Kembali</a>
    </div>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>