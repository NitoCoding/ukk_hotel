<div class="card">
    <?php
    include "koneksi.php";
    if (!isset($_GET["subpage"])) :
        $data = mysqli_query($con, "select * from view_kamar");
    ?>
        <div class="card-body">
            <div class="card-title">
                <div class="posotion-relative">
                    <h4>Kamar</h4>
                    <div class="position-absolute top-0 end-0 mt-3 me-3">
                        <a href="index.php?page=kamar&subpage=add" class="btn btn-sm btn-primary">+</a></a>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="card-text">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Kode Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    if (mysqli_num_rows($data) > 0) :
                        $no = 1;
                        while ($kamar = mysqli_fetch_array($data)) :
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $kamar["kamarKode"] ?></td>
                                <td><?= $kamar["refKamarTipeNama"] ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="index.php?page=kamar&subpage=edit&id=<?= base64_encode($kamar["kamarId"]) ?>" class="btn btn-primary">edit</a>
                                        <a data-href="index.php?page=kamar&subpage=delete&id=<?= base64_encode($kamar["kamarId"]) ?>" class="btn btn-danger ask">delete</a>
                                    </div>
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
            case 'add':
                include "kamar_forms.php";
                break;
            case 'edit':
                include "kamar_forms.php";
                break;
            case 'delete':
                $id = base64_decode($_GET["id"]);
                $data = mysqli_query($con, "delete from kamar where kamarId = '$id'");
                $_SESSION["msg"] = 'deleted!';
                header("Location: index.php?page=kamar");
                break;

            default:
                # code...
                break;
        }
    endif;
    ?>
</div>