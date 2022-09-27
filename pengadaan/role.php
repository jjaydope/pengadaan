<?php include "koneksi.php"; ?>
<?php include "navbar.php";
if ($_SESSION['role_id'] != '1') {
    echo "<script>alert('Role tidak benar');location.href='home.php';</script>";
} ?>


<!DOCTYPE html>

<html>

<head>
    <title>Petugas|Gudang</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- css bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div align="center">
            <h2>ROLE</h2>
        </div>
        <pre>Role</pre>
        <hr>
        <!--Panel Form pencarian -->
        <!--<div class="row">
            <div class="panel panel-default">
                 <div class="panel-heading"><b>Pencarian</b></div>
                <div class="panel-body">
                   <form class="form-inline">
                        <div class="form-group">
                            <select class="form-control" id="Kolom" name="Kolom" required="">
                                <?php
                                $kolom = (isset($_GET['Kolom'])) ? $_GET['Kolom'] : "";
                                ?>
                                <option value="nomor_surat" <?php if ($kolom == "nomor_surat") echo "selected"; ?>>No. Surat</option>
                                <option value="BAST" <?php if ($kolom == "BAST") echo "selected"; ?>>BAST</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-conntrol" id="KataKunci" name="KataKunci" placeholder="Kata kunci.." required="" value="<?php if (isset($_GET['KataKunci']))  echo $_GET['KataKunci']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Cari</button>
                        <a href="role.php" class="btn btn-danger">Reset</a>
                    </form> -->
        <br>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Role</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

                $kolomCari = (isset($_GET['Kolom'])) ? $_GET['Kolom'] : "";

                $kolomKataKunci = (isset($_GET['KataKunci'])) ? $_GET['KataKunci'] : "";

                // Jumlah data per halaman
                $limit = 10;
                $limitStart = ($page - 1) * $limit;


                //kondisi jika parameter pencarian kosong
                if ($kolomCari == "" && $kolomKataKunci == "") {
                    $data_nota = mysqli_query($conn, "SELECT * FROM role LIMIT " . $limitStart . "," . $limit);
                } else {
                    //kondisi jika parameter kolom pencarian diisi
                    $data_nota = mysqli_query($conn, "SELECT * FROM role WHERE $kolomCari LIKE '%$kolomKataKunci%' LIMIT " . $limitStart . "," . $limit);
                }
                $no = $limitStart + 1;

                while ($d = mysqli_fetch_array($data_nota)) {
                ?>
                    <tr>
                        <td> <?= $d['id_role'] ?> </td>
                        <td> <?= $d['nama'] ?> </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div align="right">
            <ul class="pagination">
                <?php
                // Jika page = 1, maka LinkPrev disable
                if ($page == 1) {
                ?>
                    <!-- link Previous Page disable -->
                    <li class="disabled"><a href="#">Previous</a></li>
                    <?php
                } else {
                    $LinkPrev = ($page > 1) ? $page - 1 : 1;

                    if ($kolomCari == "" && $kolomKataKunci == "") {
                    ?>
                        <li><a href="role.php?page=<?php echo $LinkPrev; ?>">Previous</a></li>
                    <?php
                    } else {
                    ?>
                        <li><a href="role.php?Kolom=<?php echo $kolomCari; ?>&KataKunci=<?php echo $kolomKataKunci; ?>&page=<?php echo $LinkPrev; ?>">Previous</a></li>
                <?php
                    }
                }
                ?>
                <?php
                //kondisi jika parameter pencarian kosong
                if ($kolomCari == "" && $kolomKataKunci == "") {
                    $data_nota = mysqli_query($conn, "SELECT * FROM role");
                } else {
                    //kondisi jika parameter kolom pencarian diisi
                    $data_nota = mysqli_query($conn, "SELECT * FROM role WHERE $kolomCari LIKE '%$kolomKataKunci%'");
                }

                //Hitung semua jumlah data yang berada pada tabel Sisawa
                $JumlahData = mysqli_num_rows($data_nota);

                // Hitung jumlah halaman yang tersedia
                $jumlahPage = ceil($JumlahData / $limit);

                // Jumlah link number 
                $jumlahNumber = 1;

                // Untuk awal link number
                $startNumber = ($page > $jumlahNumber) ? $page - $jumlahNumber : 1;

                // Untuk akhir link number
                $endNumber = ($page < ($jumlahPage - $jumlahNumber)) ? $page + $jumlahNumber : $jumlahPage;

                for ($i = $startNumber; $i <= $endNumber; $i++) {
                    $linkActive = ($page == $i) ? ' class="active"' : '';

                    if ($kolomCari == "" && $kolomKataKunci == "") {
                ?>
                        <li<?php echo $linkActive; ?>><a href="role.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                        <?php
                    } else {
                        ?>
                            <li<?php echo $linkActive; ?>><a href="role.php?Kolom=<?php echo $kolomCari; ?>&KataKunci=<?php echo $kolomKataKunci; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                    }
                }
                        ?>

                        <!-- link Next Page -->
                        <?php
                        if ($page == $jumlahPage) {
                        ?>
                            <li class="disabled"><a href="#">Next</a></li>
                            <?php
                        } else {
                            $linkNext = ($page < $jumlahPage) ? $page + 1 : $jumlahPage;
                            if ($kolomCari == "" && $kolomKataKunci == "") {
                            ?>
                                <li><a href="role.php?page=<?php echo $linkNext; ?>">Next</a></li>
                            <?php
                            } else {
                            ?>
                                <li><a href="role.php?Kolom=<?php echo $kolomCari; ?>&KataKunci=<?php echo $kolomKataKunci; ?>&page=<?php echo $linkNext; ?>">Next</a></li>
                        <?php
                            }
                        }
                        ?>
            </ul>
        </div>
</body>

</html>