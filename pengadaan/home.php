<?php
include 'koneksi.php';

include 'navbar.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home | Pengadaan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Rekap Nota Dinas</h2>
                <h4>Hai <?= $_SESSION['nama'] ?> !!!</h4>
                <a href="logout.php">Logout</a> |
                <a href="notadinas.php">Nota Dinas</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <?php
                include 'grafik.php';
                ?>
            </div>
        </div>
    </div>

</body>

</html>