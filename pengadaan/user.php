<?php
include 'koneksi.php';
include 'navbar.php';
//include 'authcheck.php';

$view = $conn->query("SELECT u.*,r.nama as nama_role FROM user as u INNER JOIN role as r ON u.role_id=r.id_role");
$no = 0;
$no++;
?>

<head>
    <title>Petugas|Gudang</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- css bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body></body>
<div class="container">

    <?php if (isset($_SESSION['success']) && $_SESSION['success'] != '') { ?>

        <div class="alert alert-success" role="alert">
            <?= $_SESSION['success'] ?>
        </div>

    <?php
    }
    $_SESSION['success'] = '';
    ?>

    <h1>List User</h1>
    <hr>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role </th>
            <th>Aksi</th>
        </tr>
        <?php

        while ($row = $view->fetch_array()) { ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['nama_role'] ?></td>
                <td>
                    <a href="user/edit_user.php?id=<?= $row['id_user'] ?>">Edit</a> |
                    <a href="user/hapus_user.php?id=<?= $row['id_user'] ?>" onclick="return confirm('apakah anda yakin?')">Hapus</a>
                </td>
            </tr>

        <?php }
        ?>

    </table>
    <a href="user/add_user.php" class="btn btn-primary">Tambah data</a>
</div>
</body>