<?php
if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $data = mysqli_query($con, "select * from kamar where kamarId = '$id'");
    $kamar = mysqli_fetch_assoc($data);
}
if (isset($_POST["submit"])) {
    $kode = $_POST["kode"];
    $tipe = $_POST["tipe"] ?? '1';
    $status = $_POST["status"] ?? '1';
    if (!isset($id)) {
        $query = mysqli_query($con, "insert into kamar (kamarKode, kamarTipeId, kamarStatusId) values ('$kode','$tipe', '$status' )");
    } else {
        $query = mysqli_query($con, "update kamar set kamarKode='$kode', kamarTipeId='$tipe',kamarStatusId='$status' where kamarId='$id'");
    }
    if ($query) {
        # code...
        $_SESSION["msg"] = 'success';
        header("Location: index.php?page=kamar");
    }
}
?>


<div class="card-title">
    <h4><?= ($_GET["subpage"] == "add") ? "Tambah" : "Edit" ?> Data</h4>
</div>
<div class="card-body">
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="kode">Kode Kamar</label>
            <input type="text" name="kode" id="kode" class="form-control" value="<?= ($kamar["kamarKode"] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="tipe">Tipe</label>
            <select class="form-select" id="tipe" name="tipe">
                <?php
                if (!isset($id)) : ?>
                    <option value="">Pilih Tipe</option>
                    <?php endif;
                $dataTipe = mysqli_query($con, "select * from ref_kamar_tipe ");
                while ($tipe = mysqli_fetch_array($dataTipe)) :
                    if ($kamar["kamarTipeId"] == $tipe["refKamarTipeId"]) :
                    ?>
                        <option value="<?= $tipe["refKamarTipeId"] ?>" selected><?= $tipe["refKamarTipeNama"] ?></option>
                    <?php else : ?>
                        <option value="<?= $tipe["refKamarTipeId"] ?>"><?= $tipe["refKamarTipeNama"] ?></option>
                <?php endif;
                endwhile ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="status">Status</label>
            <select class="form-select" id="status" name="status">
                <?php
                if (!isset($id)) : ?>
                    <option value="">Pilih Tipe</option>
                    <?php endif;
                $dataStatus = mysqli_query($con, "select * from ref_kamar_status ");
                while ($status = mysqli_fetch_array($dataStatus)) :
                    if ($kamar["kamarStatusId"] == $status["refKamarStatusId"]) :
                    ?>
                        <option value="<?= $status["refKamarStatusId"] ?>" selected><?= $status["refKamarStatusNama"] ?></option>
                    <?php else : ?>
                        <option value="<?= $status["refKamarStatusId"] ?>"><?= $status["refKamarStatusNama"] ?></option>
                <?php endif;
                endwhile ?>
            </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary btn-sm" name="submit">Submit</button>
        </div>
    </form>
</div>