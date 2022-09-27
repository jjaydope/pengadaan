<?php
if ($_POST) {
    // detail transaction
    $qty = $_POST['qty'];
    $barang = $_POST['barang'];
    $sn = $_POST['SN'];
    $date = date('Y-m-d');
    // transanction
    // $petugas = $_POST['petugas'];
    $cv = $_POST['cv'];
    $member = $_POST['nomor_surat'];


    include("koneksi.php");

    if (empty($cv)) {
        echo "<script>alert('Harap semua data diisi dengan benar!');location.href='add_pengadaan.php?total_pckg=1';</script>";
    } else {
        $insert_transaction = mysqli_query($conn, "insert into pengadaan (nomor_surat,cv,tgl) value ('" . $member . "','" . $cv . "','" . $date . "')");
    }

    $id_transaction = mysqli_insert_id($conn);
    for ($a = 0; $a < count($qty); $a++) {
        $insert_dtl_transaction = mysqli_query($conn, "insert into detail (id_pengadaan, barang, SN, qty) value ('" . $id_transaction . "','" . $barang[$a] . "','" . $sn[$a] . "','" . $qty[$a] . "')");

        $query = "update nota_dinas set status='sekertariat' , tgl ='$date' where nomor_surat='$member'";
        $update = mysqli_query($conn, $query);
    }


    if ($update) {
        echo "<script>alert('Pengadaan Tersimpan');location.href='pengadaan.php';</script>";
    } else {
        echo "<script>alert('Maaf Gagal,Coba kembali!');location.href='add_pengadaan.php?total_pckg=1';</script>";
    }
}
