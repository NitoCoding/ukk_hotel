<?php
if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $data = mysqli_query($con, "select * from ref_kamar_tipe where refKamarTipeId='$id'");
    $tipe = mysqli_fetch_assoc($data);
}
if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $gambar = (!empty($_FILES["gambar"]["name"])) ? upload() : ( $tipe["refKamarTipeImages"] ?? NULL);
    // echo $gambar;
    if(!isset($id)){
        $query = mysqli_query($con,"insert into ref_kamar_tipe (refKamarTipeNama, refKamarTipeharga, refKamarTipeImages) values ('$nama','$harga', '$gambar' )");
    }else{
        $query = mysqli_query($con,"update ref_kamar_tipe set refKamarTipeNama='$nama', refKamarTipeHarga='$harga',refKamarTipeImages='$gambar' where refkamarTipeId='$id'");
    }
    
}
function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek Ekstensi Gambarnya
    $ekstensiGambarValid =  ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        exit;
    }

    // Nama File Baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    
    // Lolos Pengecekan
    move_uploaded_file($tmpName, 'assets/images/' . $namaFileBaru);
    
    return $namaFileBaru;
}
?>


<div class="card-title">
    <h4><?= ($_GET["subpage"] == "add") ? "Tambah" : "Edit" ?> Tipe</h4>
</div>
<div class="card-body">
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="kode">Kode Kamar</label>
            <input type="text" name="kode" id="kode" class="form-control" value="<?= ($tipe["refKamarTipeId"] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="Nama">Nama Kamar</label>
            <input type="text" name="nama" id="Nama" class="form-control" value="<?= ($tipe["refKamarTipeNama"] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="Harga">Harga Kamar</label>
            <input type="text" name="harga" id="Harga" class="form-control" value="<?= ($tipe["refKamarTipeHarga"] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary btn-sm" name="submit">Submit</button>
        </div>
    </form>
</div>