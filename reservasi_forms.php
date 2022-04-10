<?php
if (!isset($_GET['tipe'])) {
}
$id = base64_decode($_GET['tipe']);
$data = mysqli_query($con, "select * from ref_kamar_tipe where refKamarTipeId='$id'");
$tipe = mysqli_fetch_assoc($data);
$data1 =  mysqli_query($con, "select * from kamar where kamarStatusId=1 and kamarTipeId='$id'");
if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $tglMulai = $_POST["tglMulai"];
    $tglSelesai = $_POST["tglSelesai"];
    $tipekamar = $id;
    $nomorKamar = $_POST["kamar"];
    $total = date_difference($tglSelesai, $tglMulai) * (int) $tipe["refKamarTipeHarga"];
    $query = mysqli_query($con, "insert into transaksi (transaksiNamaPemesan, transaksiTglMulai, transaksiTglSelesai, transaksiTipeKamarId,transaksiKamarId,transaksiTotal) values ('$nama','$tglMulai', '$tglSelesai', '$id','$nomorKamar','$total' )");
    if($query){
        header("Location: index.php?page=reservasi");
    }
}
function date_difference($d2, $d1)
{
    $dateTimeObject1 = date_create($d2);
    $dateTimeObject2 = date_create($d1);

    $difference = date_diff($dateTimeObject1, $dateTimeObject2);
    return $difference->d;
}
?>


<div class="card-title">
    <h4><?= ($_GET["subpage"] == "reserve") ? "Tambah" : "Edit" ?> reservasi</h4>
</div>
<div class="card-body">
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="tipe">Tipe Kamar</label>
            <input type="text" name="tipe" id="tipe" class="form-control" value="<?= ($tipe["refKamarTipeNama"] ?? '') ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="nama">Nama Pemesan</label>
            <input type="text" name="nama" id="nama" class="form-control">
        </div>
        <div class="mb-3">
            <label for="tgl">Tanggal Reservasi</label>
            <div class="input-group mb-3">
                <input type="date" class="form-control" name="tglMulai" id="tglMulai" placeholder="Tanggal Mulai">
                <span class="input-group-text">-</span>
                <input type="date" class="form-control" name="tglSelesai" id="tglSelesai" placeholder="Tanggal Selesai">
            </div>
        </div>
        <div class="mb-3">
            <label for="kamar">Nomor Kamar</label>
            <select class="form-select" id="kamar" name="kamar">
                <?php
                while ($kamar = mysqli_fetch_assoc($data1)) :
                ?>
                    <option value="<?= $kamar["kamarId"] ?>"><?= $kamar["kamarKode"] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary btn-sm" name="submit">Submit</button>
        </div>
    </form>
</div>
<script>
    var d1 = $('#tglMulai').val();
    var d2 = $('#tglSelesai').val();
    var diff = d2 - d1;

    var daydiff = diff / (1000 * 60 * 60 * 24);
</script>