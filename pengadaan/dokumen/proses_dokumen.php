<?php
if ($_POST) {
    // detail transaction
    $nomor = $_POST['nomor_surat'];
    $bast = $_POST['BAST'];
    $tgl = $_POST['tgl'];

    include("../koneksi.php");

    if (empty($tgl)) {
        echo "<script>alert('Harap semua data diisi dengan benar!');location.href='add_dokumen.php';</script>";
    } else {
        $insert_transaction = mysqli_query($conn, "insert into dokumen (nomor_surat,BAST,tgl) value ('" . $nomor . "','" . $bast . "','" . $tgl . "')");
    }

    $id_transaction = mysqli_insert_id($conn); {

        $query = "update nota_dinas set status='Confirmed(input BAST)', tgl ='$tgl' where nomor_surat='$nomor'";
        $update = mysqli_query($conn, $query);
        // echo "insert into detail_transaksi (id_transaksi, id_paket, qty) value ('".$id_transaction."','".$type[$i]."','".$qty[$i]."')";
    }

    if ($update) {
        echo "<script>alert('BAST sudah terinput');location.href='../dokumen.php';</script>";
    } else {
        echo "<script>alert('Maaf Gagal,Coba kembali!');location.href='add_dokumen.php';</script>";
    }
}
