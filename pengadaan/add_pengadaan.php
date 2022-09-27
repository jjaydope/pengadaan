<?php
session_start();
if ($_SESSION['role_id'] != '1') {
    echo "<script>alert('Role tidak benar');location.href='pengadaan.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

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

    <main class="form-group">
        <h1 class="h3 fw-normal text-center">Transaksi</h1>
        <form action="add_pengadaan.php" method="get">
            <div class="container">
                <div class="relative mt-5">
                    <label for="total_pckg">Jumlah Barang</label>
                    <div class="d-flex">
                        <input type="number" name="total_pckg" id="total_pckg" class="form-control" value="<?= $_GET['total_pckg'] ? $_GET['total_pckg'] : 1  ?>" min="1" />
                        <button type="submit" class="w-24 m-1 btn btn-lg btn-primary"><i class="bi bi-arrow-clockwise"></i></button>
                    </div>
                </div>
        </form>

        <form action="proses_pengadaan.php" method="post">
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

            <div>
                <label for="cv" class="form-label">Nama CV</label>
                <input type="text" name="cv" class="form-control" placeholder="cv">
            </div>
            <br>
            <!-- <div>
                <label for="tgl" class="form-label">Tanggal Pemesanan</label>
                <input type="date" class="form-control" id="tgl" name="tgl">
            </div> 
           
                    <br>  <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">add more</a> 
                    <button type="button" onclick="copyForm()"class="btn btn-primary" >More</button> -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <th>Barang</th>
                    <th>Serial Number</th>
                    <th>qty</th>

                </thead>
                <tbody>
                    <?php for ($a = 0; $a < ($_GET['total_pckg'] ? $_GET['total_pckg'] : 1); $a++) : ?>
                        <tr>

                            <td> <input type="text" name="barang[<?= $a ?>]" class="form-control" placeholder="barang"></td>
                            <td> <input type="text" name="SN[<?= $a ?>]" class="form-control" placeholder="SN"> </td>
                            <td>
                                <div class="form-floating">
                                    <div class="d-flex">
                                        <input type="number" class="form-control" id="qty[]" name="qty[<?= $a ?>]">
                                        <span class="align-items-center justify-content-center d-flex my-auto m-1">pcs</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>



            <script type="text/javascript">
                $(document).ready(function() {
                    $('#nomor_surat').select2();
                });
                $(document).ready(function() {

                    $(document).on('click', '.remove-btn', function() {
                        $(this).closest('.main-form').remove();
                    });
                });
            </script>


            <br> <button type="submit" name="save_multiple_data" class="btn btn-primary">Save Data</button>
            <a href="pengadaan.php" class="btn btn-warning">Kembali</a>
            </div>
        </form>
    </main>
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>