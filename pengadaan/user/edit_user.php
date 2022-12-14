<?php
include '../koneksi.php';
session_start();
if ($_SESSION['role_id'] != '1') {
    echo "<script>alert('Role tidak benar');location.href='../user.php';</script>";
}

$role = mysqli_query($conn, "SELECT * FROM role");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //menampilkan data berdasarkan ID
    $data = mysqli_query($conn, "SELECT * FROM user where id_user='$id'");
    $data = mysqli_fetch_assoc($data);
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    // Menyimpan ke database;
    mysqli_query($conn, "UPDATE user SET nama='$nama', username='$username', password ='" . md5($password) . "', role_id=$role_id where id_user='$id' ");

    $_SESSION['success'] = 'Berhasil memperbaruhi data';

    // mengalihkan halaman ke list barang
    header('location: ../user.php');
}

?>

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
        <h1>Edit Barang</h1>
        <form method="post">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama User" value="<?= $data['nama'] ?>">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" value="<?= $data['username'] ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" value="<?= $data['password'] ?>">
            </div>
            <div class="form-group">
                <label>Role Akses</label>
                <select class="form-control" name="role_id">
                    <option value="">Pilih Role Akses</option>

                    <?php while ($row = mysqli_fetch_array($role)) { ?>

                        <option value="<?= $row['id_role'] ?>" <?= $row['id_role'] == $data['role_id'] ? 'selected' : '' ?>><?= $row['nama'] ?></option>

                    <?php } ?>
                </select>
            </div>
            <input type="submit" name="update" value="Perbaruhi" class="btn btn-primary">
            <a href="../user.php" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</body>