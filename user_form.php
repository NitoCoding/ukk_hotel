<?php
if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $data = mysqli_query($con, "select * from ref_kamar_tipe where refKamarTipeId='$id'");
    $tipe = mysqli_fetch_assoc($data);
}
if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $pass = md5($_POST["pass"]);
    $role = 'worker';
    $is_active = true;
    // echo $gambar;
        $query = mysqli_query($con,"insert into user (userName, userPassword, userRole,is_active) values ('$nama','$pass', '$role','$is_active')");
    header("location: index.php?page=user");
}

?>


<div class="card-title">
    <h4><?= ($_GET["subpage"] == "add") ? "Tambah" : "Edit" ?> Tipe</h4>
</div>
<div class="card-body">
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="Nama">Nama</label>
            <input type="text" name="nama" id="Nama" class="form-control">
        </div>
        <div class="mb-3">
            <label for="pass">Pass</label>
            <input type="text" name="pass" id="pass" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary btn-sm" name="submit">Submit</button>
        </div>
    </form>
</div>