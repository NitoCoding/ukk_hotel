<div class="card">
    <?php
    include "koneksi.php";
    if (!isset($_GET["subpage"])) :
        $data = mysqli_query($con, "select * from view_transaksi order by transaksiStatus");
    ?>
        <div class="card-body">
            <div class="card-title">
                <div class="posotion-relative">
                    <h4>Pembayaran</h4>
                    <hr>
                </div>
            </div>
            <div class="card-text">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Kamar</th>
                        <th>Total Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    if (mysqli_num_rows($data) > 0) :
                        $no = 1;
                        while ($user = mysqli_fetch_array($data)) :
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $user["transaksiNamaPemesan"] ?></td>
                                <td><?= $user["transaksiTglMulai"] ?></td>
                                <td><?= $user["transaksiTglSelesai"] ?></td>
                                <td><?= $user["kamarKode"] ?></td>
                                <td><?= $user["transaksiTotal"] ?></td>
                                <td><?php if($user["transaksiStatus"] != "lunas") : ?>
                                    <a href="index.php?page=bayar&subpage=bayar&id=<?= base64_encode($user["transaksiId"]) ?>" class="btn btn-sm btn-primary">Bayar</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endwhile;
                    else : ?>
                        <tr>
                            <td colspan="9" class="text-center">Tidak Ada Data</td>
                        </tr>
                    <?php endif ?>

                </table>
            </div>
        </div>
    <?php
    else :
        $subpage = $_GET["subpage"];
        switch ($subpage) {
            case 'bayar':
                include "bayar_forms.php";
                break;

            default:
                # code...
                break;
        }
    endif;
    ?>
</div>