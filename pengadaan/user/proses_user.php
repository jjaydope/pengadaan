<?php
if ($_POST) {

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($username)) {
        echo "<script>alert('username tidak boleh kosong');location.href='add_user.php';</script>";
    } elseif (empty($password)) {
        echo "<script>alert('password tidak boleh kosong );location.href='add_user.php';</script>";
    } elseif (empty($nama)) {
        echo "<script>alert('Nama tidak boleh kosong');location.href='add_user.php';</script>";
    } elseif (empty($role)) {
        echo "<script>alert('input role !');location.href='add_user.php';</script>";
    } else {
        include "../koneksi.php";

        $insert = mysqli_query($conn, "insert into user (nama,username,password,role_id) value ('" . $nama . "','" . $username . "','" . md5($password) . "','" . $role . "')");

        if ($insert) {
            echo "<script>alert('Petugas berhasil di tambah ');location.href='../user.php';</script>";
        } else {
            echo mysqli_error($conn);
        }
    }
}
