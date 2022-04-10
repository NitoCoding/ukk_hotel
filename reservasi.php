<div class="card">
    <?php
    include "koneksi.php";
    if (!isset($_GET["subpage"])) :
        $data = mysqli_query($con, "select * from ref_kamar_tipe");
    ?>
        <div class="card-body">
            <div class="card-title">
                <div class="posotion-relative">
                    <h4>Reservasi Kamar</h4>
                    <hr>
                    <div class="position-absolute top-0 end-0 mt-3 me-3">
                        <?php if ($_SESSION["role"] == 'admin') : ?>
                            <a href="index.php?page=reservasi&subpage=add" class="btn btn-sm btn-primary">+</a></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-text">
                <h5>Tipe Kamar</h5>
                <hr>
                <div class="row">
                    <?php
                    while ($ref = mysqli_fetch_assoc($data)) :
                        // print_r($ref);
                        // echo base64_encode($ref['refKamarTipeId']);
                    ?>
                        <div class="col-3">
                            <div class="card">
                                <img src="assets/images/<?= $ref["refKamarTipeImages"] ?>" alt="" width="295vw" height="170vw">
                                <dov class="card-title"><?= $ref['refKamarTipeNama'] ?></dov>
                                <div class="card-text">
                                    <table class="table">
                                        <tr>
                                            <td>Harga Kamar</td>
                                            <td><?= $ref['refKamarTipeHarga'] ?></td>
                                        </tr>
                                    </table>
                                    <div class="m-2">
                                        <?php if ($_SESSION["role"] == 'admin') : ?>
                                            <a href="index.php?page=reservasi&subpage=edit&id=<?= base64_encode($ref['refKamarTipeId']) ?>" class="btn btn-primary text-start">Edit</a>
                                        <?php endif; ?>
                                        <a href="index.php?page=reservasi&subpage=reserve&tipe=<?= base64_encode($ref['refKamarTipeId']) ?>" class="btn btn-primary text-end">Reservasi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile ?>
                </div>
            </div>
        </div>
    <?php
    else :
        $subpage = $_GET["subpage"];
        switch ($subpage) {
            case 'reserve':
                include "reservasi_forms.php";
                break;
            case 'add':
                include "ref_kamar_forms.php";
                break;
            case 'edit':
                include "ref_kamar_forms.php";
                break;
            default:
                # code...
                break;
        }
    endif;
    ?>
</div>