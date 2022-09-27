<?php
include 'koneksi.php';
include 'navbar.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Pengadaan</title>
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
            <h3>Pengadaan</h3>
        </div>
        <!-- form filter data berdasarkan range tanggal  -->
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Surat</th>
                    <th>Status</th>
                    <th>Tanggal (last update)</th>
                    <th>Keperluan</th>
                    <th>Harga</th>
                    <th>CV</th>
                    <th>Barang</th>
                    <th>Serial Number</th>
                    <th>qty</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = mysqli_query(
                    $conn,
                    "SELECT  p.id_pengadaan as p_id, n.keperluan as kepentingan,n.status as statuss,n.tgl as tanggal,p.cv as cv ,n.harga as harga, p.nomor_surat as no_surat from pengadaan p, nota_dinas n where p.nomor_surat = n.nomor_surat "
                );

                // echo "SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl, t.batas_waktu, t.tgl_bayar, t.status, t.dibayar, u.nama as nama_kasir FROM transaksi t, member m, user u WHERE t.id_member = m.id_member AND t.id_user = u.id_user";

                // $qry_transaksi=mysqli_query($conn,"SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl,  p.nama_petugas as nama_kasir FROM transaksi t, member m, petugas p WHERE t.NIP = m.NIP AND t.id_petugas = p.id_petugas order by tgl limit $halaman_awal, $batas");
                $no = 0;
                while ($data_transaksi = mysqli_fetch_array($data)) {
                    $qry_dtl_transaksi = mysqli_query($conn, "SELECT *, qty  FROM detail WHERE id_pengadaan = " . $data_transaksi['p_id'] . "");
                    echo mysqli_error($conn);
                    //    echo "SELECT *, qty * harga as total FROM detail_transaksi, paket WHERE id_transaksi = ".$data_transaksi['t_id']." AND paket.id_paket = detil_transaksi.id_paket";
                    $no++;
                    $i = 0;
                    while ($data_dtl_transaksi = mysqli_fetch_assoc($qry_dtl_transaksi)) {
                        $i++;
                        if ($i == 1) {
                ?>

                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $data_transaksi['no_surat'] ?> </td>
                                <td><?php echo $data_transaksi['statuss'] ?> </td>
                                <td><?php echo date('d M Y', strtotime($data_transaksi['tanggal'])) ?></td>
                                <td><?php echo $data_transaksi['kepentingan'] ?> </td>
                                <td>
                                    Rp.<?= number_format($data_transaksi['harga']) ?>
                                </td>
                                <td><?php echo $data_transaksi['cv'] ?> </td>

                                <td><?= $data_dtl_transaksi['barang'] ?></td>
                                <td><?= $data_dtl_transaksi['SN'] ?></td>
                                <td><?= $data_dtl_transaksi['qty'] ?></td>


                                </td>

                            </tr>
                        <?php
                        } else {
                        ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td><?= $data_dtl_transaksi['barang'] ?></td>
                                <td><?= $data_dtl_transaksi['SN'] ?></td>
                                <td><?= $data_dtl_transaksi['qty'] ?></td>


                            </tr>
                    <?php
                        }
                    }
                    ?>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="add_pengadaan.php?total_pckg=1" class="btn btn-primary">Tambah data</a>

</body>

</html>