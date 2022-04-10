<?php
session_start();
if ($_SESSION["login"] != true or !isset($_SESSION["login"])) {
    header("location: login.php");
}
if (isset($_GET["auth"]) == "out") {
    session_destroy();
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Reservasi Hotel</title>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/sweetalert2@11.js"></script>
</head>

<body>
    <?php if (isset($_SESSION["msg"])) : ?>
        <?php if ($_SESSION["msg"] == "success") : ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
        <?php
        else :
        ?>
            <script>
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            </script>
        <?php
        endif;
        ?>
    <?php
    unset($_SESSION["msg"]);
    endif;
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #cfd0ce !important">
        <div class="container-fluid">
            <a class="navbar-brand text-wrap" href="#">Hotel Reservation</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto mb-2 mb-lg-0">
                    <a class="nav-link" href="index.php?page=dashboard">Dasboard</a>
                    <a class="nav-link" href="index.php?page=reservasi">Reservasi</a>
                    <a class="nav-link" href="index.php?page=bayar">Pembayaran</a>
                    <a class="nav-link" href="index.php?page=laporan">Laporan</a>
                    <?php if ($_SESSION["role"] == 'admin') : ?>
                        <a class="nav-link" href="index.php?page=kamar">Kamar</a>
                        <a class="nav-link" href="index.php?page=user">Manajemen User</a>
                    <?php endif ?>
                </div>
                <span class="d-flex">
                    <a class="btn btn-danger text-light" href="index.php?auth=out">Log out</a>
                </span>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <?php
        // print_r($_GET);
        if (isset($_GET["page"])) {

            $page = $_GET["page"];
            switch ($page) {
                case 'dashboard':
                    include "dashboard.php";
                    # code...
                    break;
                case 'kamar':
                    if ($_SESSION["role"] == "admin") {
                        include "kamar.php";
                        break;
                    } else {
                        echo "akses ditolak, user bukan admin";
                        break;
                    }
                case 'reservasi':
                    include "reservasi.php";
                    break;
                case 'ref_kamar':
                    include "ref_kamar.php";
                    break;
                case 'laporan':
                    include "laporan.php";
                    break;
                case 'bayar':
                    # code...
                    include "bayar.php";
                    break;
                case 'user':
                    # code...
                    include "user.php";
                    break;
                default:
                    # code...
                    echo "page tidak ditemukan";
                    break;
            }
        }
        if (isset($_GET["auth"])) {
            session_destroy();
            header("location: login.php");
        }
        ?>
    </div>

    <script src="assets/js/bootstrap.min.js"></script>
    <script>
        $('.ask').on("click", function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = $(this).data('href');
                    window.location.href = url;
                }
            })
        })
    </script>
</body>

</html>