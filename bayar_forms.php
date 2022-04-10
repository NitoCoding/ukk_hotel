<?php
if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $data = mysqli_query($con, "select transaksiKamarId,transaksiTotal from transaksi where transaksiId = '$id'");
}
$transaksi = mysqli_fetch_assoc($data);
$kamarId = $transaksi["transaksiKamarId"];
// print_r($transaksi);
if (isset($_POST["submit"])) {
    $bayar = $_POST["bayar"];
    $status = "lunas";
    $statusKamar = '1';
    $query = mysqli_query($con, "update transaksi set transaksiBayar='$bayar',transaksiStatus='$status' where transaksiId='$id'");
    $query1 = mysqli_query($con, "update kamar set kamarStatusId='$statusKamar' where kamarId='$kamarId'");
    // header("Location: index.php?page=bayar");
}
?>


<div class="card-title">
    <h4>Form Pembayaran</h4>
</div>
<div class="card-body">
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="biaya">Total Biaya</label>
            <input type="text" name="biaya" id="biaya" class="form-control" value="<?= ($transaksi["transaksiTotal"] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="bayar">Pembayaran</label>
            <input type="text" name="bayar" id="bayar" class="form-control">
        </div>
        <div class="mb-3">
            <label for="kembali">Kembalian</label>
            <input type="text" name="kembali" id="kembali" class="form-control" disabled>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary btn-sm" id="submit" name="submit" dis>Submit</button>
        </div>
    </form>
</div>
<script>
    $('#submit').hide();
    $('#bayar').on("input",function(){
        var biaya = $('#biaya').val();
        var bayar = $('#bayar').val();
        
        var diff = bayar - biaya;

        $('#kembali').val(diff);
        if(diff < 0){
            $('#submit').hide();
            return
        }
        $('#submit').show();
    })

</script>