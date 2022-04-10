<?php
include "koneksi.php";
$bulan = $_POST["bulan"];
$year = $_POST["year"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
</head>

<body>
    <center>
        <div>

            <h2>Laporan Keuangan</h2>
            <h3>Perpustakaan</h3>
        </div>
        <div>
            <table border="0" cellpadding="10px" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Pemesan</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Kamar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = mysqli_query($con, "select * from view_transaksi where month(transaksiTglMulai) = '$bulan' and year(transaksiTglMulai)='$year'");
                    while ($user = mysqli_fetch_array($sql)) {
                    ?>
                        <tr>
                            <td><?= $user["transaksiNamaPemesan"] ?></td>
                            <td><?= $user["transaksiTglMulai"] ?></td>
                            <td><?= $user["transaksiTglSelesai"] ?></td>
                            <td><?= $user["kamarKode"] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </center>
    <script>
        window.print();
    </script>
</body>

</html>