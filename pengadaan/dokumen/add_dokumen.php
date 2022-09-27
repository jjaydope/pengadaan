<?php
session_start();
if ($_SESSION['role_id'] != '1') {
    echo "<script>alert('Role tidak benar');location.href='../dokumen.php';</script>";
}
?>
<?php
include '../koneksi.php';


if (isset($_POST['simpan'])) {
    // echo var_dump($_POST);
    $nomor = $_POST['nomor_surat'];
    $bast = $_POST['BAST'];
    $tgl = $_POST['tgl'];


    // Menyimpan ke database;
    mysqli_query($conn, "INSERT INTO dokumen VALUES (NULL, '$nomor','$bast','$tgl')");

    $_SESSION['success'] = 'Berhasil menambahkan data';

    // mengalihkan halaman ke list barang
    header("location:../dokumen.php");
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
        <pre>
                <h1>Dokumen</h1>
        </pre>
        <form action="proses_dokumen.php" method="post">
            <div>
                <label for="nomor_surat" class="form-label">Surat</label>
                <select name="nomor_surat" id="nomor_surat" class="form-select">
                    <option disabled>Pilih Surat</option>
                    <?php
                    include "koneksi.php";
                    $qry_member = mysqli_query($conn, "select * from nota_dinas");
                    while ($data_member = mysqli_fetch_array($qry_member)) {
                        echo '<option value="' . $data_member['nomor_surat'] . '">' . $data_member['nomor_surat'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label>BAST</label>
                <input type="text" name="BAST" class="form-control" placeholder="BAST">
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tgl" class="form-control" placeholder="Tanggal">
            </div>

            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

            <a href="../dokumen.php" class="btn btn-warning">Kembali</a>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#nomor_surat').select2();
        });
    </script>
</body>

</html>