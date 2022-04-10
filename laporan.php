<?php
include "koneksi.php";
$bulan = ['Januari', 'Feruari', 'Maret', 'April'];
$dataTahun = mysqli_query($con, "select year(transaksiTglMulai) as tahun from transaksi group by tahun");
?>
<div class="card-body">
    <div class="card-title">
        <div class="posotion-relative">
            <h4>Laporan Keutungan</h4>
            <hr>
        </div>
    </div>
    <div class="card-text">
        <form action="laporan_template.php" method="post">
            <div class="mb-3">
                <label for="">periode</label>
                <div class="input-group mb-3">

                    <select name="bulan" id="" class="form-control">
                        <?php
                        $no = 1;
                        foreach ($bulan as $b) :
                        ?>
                            <option value="<?= $no++ ?>"><?= $b ?></option>
                        <?php endforeach ?>
                    </select>
                    <span class="input-group-text">-</span>
                    <select name="year" id="" class="form-control">
                        <?php
                        while ($tahun = mysqli_fetch_assoc($dataTahun)) :
                        ?>
                            <option value="<?= $tahun["tahun"] ?>"><?= $tahun["tahun"] ?></option>
                        <?php endwhile ?>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary">Go</button>
        </form>
    </div>
</div>