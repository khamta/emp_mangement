<?php
session_start();
include_once 'connect_db.php';
if (isset($_POST['btnlogin'])) {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, md5($_POST['password']));
    $sql = "SELECT *FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("location: index.php");
    } else {
        $message_error = '<script> swal("ຜິດພາດ", "ບັນຊີເຂົ້າໃຊ້ ແລະ ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ!",
         "error", {button: "ຕົກລົງ"});</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ລະບົບຈັດການຂໍ້ມູນພະນັກງານ</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="myCSS/style.css">
    <link rel="icon" href="image/002.jpg">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <style>
        body,
        html {
            height: 90%;
        }
    </style>
</head>

<body>
    <?php include_once 'menu.php'; ?>
    <?php echo @$message_error; ?>

    <div class="container-fluid h-100">
        <div class="row align-items-center h-100">
            <div class="col-md-6 mx-auto ">
                <i class="fas fa-user-lock mx-auto" style="display:flex; justify-content:center; margin-bottom: 20px; font-size: 80px;"></i>
                <div class="card border-info">
                    <div class="card-header bg-success text-white">
                        <h4 class="text-center">ລົງຊື່ເຂົ້າໃຊ້</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="mb-3 mt-3">
                                <label for="username" class="form-label">ຊື່ຜູ້ໃຊ້:</label>
                                <input type="text" class="form-control" id="username" placeholder="ປ້ອນຊື່ເຂົ້າໃຊ້" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">ລະຫັດຜ່ານ:</label>
                                <input type="password" class="form-control" id="password" placeholder="ປ້ອນລະຫັດຜ່ານ" name="password" required>
                            </div>
                            <div class="form-check mb-3">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember"> ຈົດຈຳຊື່ເຂົ້າໃຊ້
                                </label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="btnlogin" class="btn btn-success btn-block">ຕົກລົງ</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>