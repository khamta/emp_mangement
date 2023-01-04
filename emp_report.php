<?php
include_once 'login_check.php';
$department = "";
$where = "";
if (isset($_GET['department'])) {
    $department = $_GET['department'];
    $where = empty($department) ? " " : "where d.d_ID = '$department'";
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
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <link rel="icon" href="image/002.jpg">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include_once 'menu.php'; ?>

    <div class="container-fluid mt-3">
        <div class="alert alert-success alert-dismissible text-center">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>ລາຍງານຂໍ້ມູນພະນັກງານ</strong>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <div class="row">
                <div class="col-md-2 offset-md-2 text-end">ເລືອກພິມລາຍງານພະແນກ</div>
                <div class="col-md-4">
                    <select class="form-select" name="department" onchange="form.submit()">
                        <option value="">-----ເລືອກພະແນກ-----</option>
                        <?php
                        $sql = "SELECT d_ID, name from dept ORDER BY name ASC";
                        $result = mysqli_query($link, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?= $row["d_ID"] ?>" <?php if ($row["d_ID"] == $department) 
                            echo 'selected' ?>><?= $row["name"] ?></option>';
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
</body>

</html>