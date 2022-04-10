<?php
include "koneksi.php";

if (isset($_POST["submit"])) {
    $username = $_POST["name"];
    $password = md5($_POST["pass"]);
    $check_user = mysqli_query($con, "select * from user where userName = '$username' and userPassword = '$password'");
    // print_r($check_user);

    if (mysqli_num_rows($check_user) > 0) {
        # code...
        $user = mysqli_fetch_assoc($check_user);
        session_start();
        //code...
        $_SESSION["username"] = $user["userName"];
        $_SESSION["role"] = $user["userRole"];
        $_SESSION["login"] = true;
        if ($user["userRole"]) {
            header("location: index.php?page=dashboard");
        } else {
            header("location: login.php");
        }
    } else {
        $_SESSION["msg"] = "gagal login";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body style="background-color: #babbb9">
    <div class="d-flex align-items-center justify-content-center" style="height: 600px">
        <div class="card">
            <div class="card-body">
                <div class="card-title text-center h3">
                    Login
                    <hr>
                </div>
                <br>
                <div class="card-text">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="name">username</label>
                            <input type="text" name="name" id="pass" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="pass">password</label>
                            <input type="password" name="pass" id="pass" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="submit" class="btn btn-primary">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>