<!DOCTYPE html>
<html>

<head>
    <title>Grafik Barang</title>
    <script src="js/Chart.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <style type="text/css">
        body {
            font-family: "Lato", sans-serif;
        }
    </style>
    <div style="width: 800px;margin: 0px auto;">
        <form method="POST" action="" class="form-inline mt-2">
            <label class="col-form-label" for="date1">Tanggal mulai </label>
            <input type="date" name="date1" id="date1" class="form-control mr-2">
            <label for="date2">sampai </label>
            <input type="date" name="date2" id="date2" class="form-control mr-2">
            <button type="submit" name="submit" class="btn btn-primary">Cari</button>
            <a href="home.php" class="btn btn-danger">Reset</a>
        </form>
        <br>
        <?php
        if (isset($_POST['submit'])) {
            $date1 = strtotime($_POST['date1']);
            $date2 = strtotime($_POST['date2']);
            if (!empty($date1) && !empty($date2)) {
                echo " Periode: " . date("d M Y", $date1) . " - " . date("d M Y", $date2);
            } else {
                echo "";
            }
        } else {
            echo "";
        }
        ?>
        <canvas id="myChart"></canvas>
        <script>
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["raw", "sekertariat", "Input BAST"],
                    datasets: [{
                        label: 'Jumlah Nota Dinas',
                        data: [
                            <?php
                            if (isset($_POST['submit'])) {
                                $date1 = $_POST['date1'];
                                $date2 = $_POST['date2'];

                                if (!empty($date1) && !empty($date2)) {
                                    // perintah tampil data berdasarkan range tanggal
                                    $jumlah_raw = mysqli_query($conn, "SELECT * FROM nota_dinas WHERE status='raw' and tgl BETWEEN '$date1' and '$date2'");
                                    echo mysqli_num_rows($jumlah_raw);
                                } else {
                                    // perintah tampil semua data
                                    $jumlah_raw = mysqli_query($conn, "select * from nota_dinas where status='raw'");
                                    echo mysqli_num_rows($jumlah_raw);
                                }
                            } else {
                                // perintah tampil semua data
                                $jumlah_raw = mysqli_query($conn, "select * from nota_dinas where status='raw'");
                                echo mysqli_num_rows($jumlah_raw);
                            }
                            ?>,

                            <?php
                            if (isset($_POST['submit'])) {
                                $date1 = $_POST['date1'];
                                $date2 = $_POST['date2'];

                                if (!empty($date1) && !empty($date2)) {
                                    // perintah tampil data berdasarkan range tanggal
                                    $jumlah_sekertariat = mysqli_query($conn, "SELECT * FROM nota_dinas WHERE status='sekertariat' and tgl BETWEEN '$date1' and '$date2'");
                                    echo mysqli_num_rows($jumlah_sekertariat);
                                } else {
                                    // perintah tampil semua data
                                    $jumlah_sekertariat = mysqli_query($conn, "select * from nota_dinas where status='sekertariat'");
                                    echo mysqli_num_rows($jumlah_sekertariat);
                                }
                            } else {
                                // perintah tampil semua data
                                $jumlah_sekertariat = mysqli_query($conn, "select * from nota_dinas where status='sekertariat'");
                                echo mysqli_num_rows($jumlah_sekertariat);
                            }
                            ?>,
                            <?php
                            if (isset($_POST['submit'])) {
                                $date1 = $_POST['date1'];
                                $date2 = $_POST['date2'];

                                if (!empty($date1) && !empty($date2)) {
                                    // perintah tampil data berdasarkan range tanggal
                                    $jumlah_BAST = mysqli_query($conn, "SELECT * FROM nota_dinas WHERE status='Confirmed(input BAST)' and tgl BETWEEN '$date1' and '$date2'");
                                    echo mysqli_num_rows($jumlah_BAST);
                                } else {
                                    // perintah tampil semua data
                                    $jumlah_BAST = mysqli_query($conn, "select * from nota_dinas where status='Confirmed(input BAST)'");
                                    echo mysqli_num_rows($jumlah_BAST);
                                }
                            } else {
                                // perintah tampil semua data
                                $jumlah_BAST = mysqli_query($conn, "select * from nota_dinas where status='Confirmed(input BAST)'");
                                echo mysqli_num_rows($jumlah_BAST);
                            }
                            ?>
                        ],
                        backgroundColor: [
                            'rgb(65,105,225)',
                            'rgb(240,128,128)',
                            'rgb(222,184,135)'
                        ],
                        borderColor: [
                            'rgb(65,105,225)',
                            'rgb(240,128,128)',
                            'rgb(222,184,135)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    </div>
</body>

</html>