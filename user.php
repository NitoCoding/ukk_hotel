<div class="card">
    <?php
    include "koneksi.php";
    if (!isset($_GET["subpage"])) :
        $data = mysqli_query($con, "select * from user");
    ?>
        <div class="card-body">
            <div class="card-title">
                <div class="posotion-relative">
                    <h4>Manajemen User</h4>
                    <div class="position-absolute top-0 end-0 mt-3 me-3">
                        <a href="index.php?page=user&subpage=add" class="btn btn-sm btn-primary">+</a></a>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="card-text">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>username</th>
                        <th>role</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    if (mysqli_num_rows($data) > 0) :
                        $no = 1;
                        while ($user = mysqli_fetch_array($data)) :
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $user["userName"] ?></td>
                                <td><?= $user["userRole"] ?></td>
                                <td>
                                    <div class="btn-group">
                                        <?php if ($user['is_active'] == 'true') : ?>
                                            <a href="index.php?page=user&subpage=disactive&id=<?= base64_encode($user["userId"]) ?>" class="btn btn-primary">disactive</a>
                                        <?php else : ?>
                                            <a href="index.php?page=user&subpage=active&id=<?= base64_encode($user["userId"]) ?>" class="btn btn-success">active</a>
                                        <?php endif; ?>
                                        <a data-href="index.php?page=user&subpage=delete&id=<?= base64_encode($user["userId"]) ?>" class="btn btn-danger">delete</a>

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
            case 'delete':
                $id = base64_decode($_GET["id"]);
                $data = mysqli_query($con, "delete from user where userId = '$id'");
                $_SESSION["msg"] = 'deleted!';
                header("Location: index.php?page=user");
                break;
            case 'disactive':
                $id = base64_decode($_GET["id"]);
                $data = mysqli_query($con, "update user set is_active='false' where userId = '$id'");
                $_SESSION["msg"] = 'success';
                header("Location: index.php?page=user");
                break;
            case 'active':
                $id = base64_decode($_GET["id"]);
                $data = mysqli_query($con, "update user set is_active='true' where userId = '$id'");
                $_SESSION["msg"] = 'success';
                header("Location: index.php?page=user");
                break;
            case 'add':
                include "user_form.php";
                break;

            default:
                # code...
                break;
        }
    endif;
    ?>
</div>