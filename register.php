<?php 
session_start();
include_once 'connect_db.php';
include_once 'function/function.php';

if (isset($_POST['register'])){
    $name = data_input($_POST['name']);
    $phone = data_input($_POST['phone']);
    $username = data_input($_POST['username']);
    $password = data_input($_POST['password']);
    $con_password = data_input($_POST['con_password']);
// ກວດສອບຖານຂໍ້ມູນວ່າມີ ຜູ້ໃຊ້ນີ້ຫລື ບໍ່
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    $error_username = "ຊື່ບັນຊີເຂົ້າໃຊ້ນີ້ມີໃນລະບົບແລ້ວ!";
}
//ກວດສອບລະຫັດຜ່ານວ່າກົງກັນຫລືບໍ່?
 if ($password !== $con_password) {
        $error_password = "ລະຫັດຜ່ານ ແລະ ລະຫັດຢືນຢັນບໍ່ກົງກັນ";
    }
// ເພີ່ມຂໍ້ມູນລົງໃນຖານຂໍ້ມູນ
if (empty($error_username) && empty($error_password)){
    $password = md5($password);
    $sql = "INSERT INTO user VALUES('', '$name', '$phone', '$username', '$password')";
   $result = mysqli_query($link, $sql);
    if($result){
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("location: pofile.php");
    }else{
            //echo mysqli_error($link);
    }
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
</head>
<body>
    <?php include_once 'menu.php'; ?>
    <div class="container-fluid mt-3">
    <div class="row">
    <div class="col-md-6 offset-md-3">
        <fieldset class="border border-primary p-2 px-4 pb-4" style="border-radius: 8px;">
            <legend class="float-none w-auto p-2 h5 fw-bold">ຟອມປ້ອນຂໍ້ມູນລົງທະບຽນ</legend>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="mb-3">
            <label for="name">ຊື່ ແລະ ນາມສະກຸນ:</label>
            <input type="text" class="form-control" id="name" placeholder="ປ້ອນຊື່ ແລະ ນາມສະກຸນ" name="name" required value="<?= @$name ?>">
            </div>
         
            <div class="mb-3">
            <label for="phone">ເບີໂທ:</label>
            <input type="text" class="form-control" id="phone" placeholder="ປ້ອນເບີໂທ:" name="phone" required value="<?= @$phone ?>">
            </div>

            <div class="mb-3">
            <label for="username">ບັນຊີເຂົ້າໃຊ້:</label>
            <input type="text" class="form-control" id="username" placeholder="ປ້ອນບັນຊີເຂົ້າໃຊ້:" name="username" required value="<?= @$username ?>">
            <div class="form-control-feedback">
            <div class="text-danger align-middle">
                <?= @$error_username ?>
            </div>
            </div>
            </div>

            <div class="mb-3">
            <label for="password" class="form-label">ລະຫັດຜ່ານ:</label>
            <input type="password" class="form-control" id="password" placeholder="ປ້ອນລະຫັດຜ່ານ" name="password" required>
            <div class="form-control-feedback">
            <div class="text-danger align-middle">
                <?= @$error_password ?>
            </div>
            </div>
            </div>

            <div class="mb-3">
            <label for="con_password" class="form-label">ຢືນຢັນລະຫັດຜ່ານ:</label>
            <input type="password" class="form-control" id="con_password" placeholder="ປ້ອນລະຫັດຜ່ານອີກຄັ້ງ" name="con_password" required>
            </div>

            <button type="submit" name="register" class="btn btn-primary" style="width: 110px; border-radius: 8px;"><i class="fas fa-plus-circle"></i>&nbsp;ລົງທະບຽນ</button>
            <button type="reset" class="btn btn-warning" style="width: 110px; border-radius: 8px;"><i class="fas fa-sync-alt"></i>&nbsp;ຍົກເລີກ</button>
            </form>

        </fieldset>
    </div>
    </div>
    </div>
</body>
</html>