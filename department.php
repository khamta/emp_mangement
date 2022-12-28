<?php
include_once 'login_check.php';
include_once 'function/function.php';
$dno = $dept_name = $location = $incentive = $error_id = "";
if (isset($_POST['btnAdd'])) {
    $dno = data_input($_POST['dno']);
    $dept_name = data_input($_POST['dept_name']);
    $location = data_input($_POST['location']);
    $incentive = str_replace(",", "", data_input($_POST['incentive']));
    //ກວດສອບລະຫັດຊ້ຳ
    $sql = "SELECT * FROM dept WHERE d_ID = '$dno'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
        $error_id = "ລະຫັດນີ້ມີຢູ່ແລ້ວ!";
    } else {
        $sql = "INSERT INTO dept VALUES('$dno', '$dept_name', '$location', '$incentive')";
        $result = mysqli_query($link, $sql);
        if ($result == true) {
            $dno = $dept_name = $location = $incentive = $message_ok = "";
            $message_ok = '<script>swal("ສຳເລັດ", "ເພີ່ມຂໍ້ມູນສຳເລັດ", "success", {button: "ຕົກລົງ"});</script>';
        } else {
            echo mysqli_error($link);
        }
    }
} elseif (@$_GET['action'] == 'edit') {
    $dno = $_GET['dno'];
    $sql = "SELECT *FROM dept WHERE d_ID = '$dno'";

    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $dno = $row['d_ID'];
        $dept_name =  $row['name'];
        $location =  $row['loc'];
        $incentive =  $row['incentive'];
    }
} elseif (isset($_POST['btnedit'])) {
    $dno = data_input($_POST['dno']);
    $dept_name = data_input($_POST['dept_name']);
    $location = data_input($_POST['location']);
    $incentive = str_replace(",", "", data_input($_POST['incentive']));

    $sql ="UPDATE dept SET name='$dept_name', loc='$location', incentive='$incentive' WHERE d_ID='$dno'";
    $result = mysqli_query($link, $sql);
    if ($result == true) {
        $dno = $dept_name = $location = $incentive = $message_ok = "";
        $message_ok = '<script>swal("ສຳເລັດ", "ແກ້ໄຂຂໍ້ມູນສຳເລັດ", "success", {button: "ຕົກລົງ"});</script>';
    } else {
        echo mysqli_error($link);
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
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/jquery.priceformat.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
</head>

<body>
    <?php include_once 'menu.php'; ?>
    <?= @$message_ok ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                <fieldset class="border border-primary p-2 px-4 pb-4 rounded-3">
                    <legend class="float-none w-auto p-2 h5 fw-bold">ຈັດການຂໍ້ມູນພະແນກ</legend>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="mb-3">
                            <label for="dno" class="form-label">ລະຫັດພະແນກ:</label>
                            <input type="text" class="form-control" id="dno" placeholder="ປ້ອນລະຫັດພະແນກ" name="dno" required value="<?= @$dno ?>" maxlength="6" <?php if (@$_GET['action'] == 'edit') echo 'readonly' ?>>
                            <div class="form-control-feedback">
                                <div class="text-danger">
                                    <?= @$error_id ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="dept_name" class="form-label">ຊື່ພະແນກ:</label>
                            <input type="text" class="form-control" id="dept_name" placeholder="ປ້ອນຊື່ພະແນກ" name="dept_name" required value="<?= @$dept_name ?>">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">ສະຖານທີ່:</label>
                            <input type="text" class="form-control" id="location" placeholder="ປ້ອນຊື່ສະຖານທີ່" name="location" required value="<?= @$location ?>">
                        </div>
                        <div class="mb-3">
                            <label for="incentive" class="form-label">ເງິນອຸດໜູນ:</label>
                            <input type="text" class="form-control" id="incentive" placeholder="ປ້ອນເງິນອຸດໜູນ" name="incentive" required value="<?= @$incentive ?>">
                        </div>
                        <?php
                        if (@$_GET['action'] == 'edit') {
                            echo '<button type="submit" name="btnedit" class="btn btn-info" style="width: 100px; border-radius: 8px;"><i class="fas fa-edit"></i>&nbsp;&nbsp;ແກ້ໄຂ</button>';
                        } else {
                            echo '<button type="submit" name="btnAdd" class="btn btn-primary" style="width: 100px; border-radius: 8px;"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;ເພີ່ມ</button>';
                        }
                        ?>

                        <button type="submit" name="btnreset" class="btn btn-warning" style="width: 100px; border-radius: 8px;"><i class="fas fa-sync-alt"></i>&nbsp;&nbsp;ຍົກເລີກ</button>
                    </form>
                </fieldset>
            </div>
            <div class="col-md-8">
                <table id="example" class="table table-hover table-bordered" style="width:100%">
                    <thead class="bg-success text-white text-center">
                        <tr>
                            <th>ລະຫັດ</th>
                            <th>ພະແນກ</th>
                            <th>ສະຖານທີ່</th>
                            <th>ເງິນອຸດໜູນ</th>
                            <th>ອັອບຊັ່ນ</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM dept";
                        $result = mysqli_query($link, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                            <tr>
                                <td><?= $row['d_ID'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['loc'] ?></td>
                                <td class="text-end"><?= number_format($row['incentive']) ?></td>
                                <td class="text-center" style="width: 80px;">
                                    <a href="department.php?action=edit&dno=<?= $row['d_ID'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="ແກ້ໄຂ"><i class="fas fa-edit"></i></a>
                                    <a href="#" onclick="deletedata(<?php echo '\'' . $row['d_ID'] . '\''; ?>)" data-bs-toggle="tooltip" data-bs-placement="left" title="ລືບຂໍ້ມູນ"><i class="fas fa-trash-alt text-danger"></i></a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#example').DataTable();

        $('#incentive').priceFormat({
            prefix: '',
            thousandsSeparator: ',',
            centsLimit: 0
        });
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
     //ສ້າງຟັງຊັນແຈ້ງເຕືອນລືບຂໍ້ມູນ
     function deletedata(id) {
        swal({
                title: "ເຈົ້າຕ້ອງການລືບແທ້ ຫຼື ບໍ່?",
                text: "ຂໍ້ມູນລະຫັດ " + id + ", ເມື່ອລືບຈະບໍ່ສາມາດກູ້ຂໍ້ມູນຄືນໄດ້!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ['ຍົກເລີກ', 'ຕົກລົງ']
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "dept_delete.php",
                        method: "post",
                        data: {
                            dno: id
                        },
                        success: function(data) {
                            if (data) {
                                //alert(data); //ເພື່ອກວດສອບຂໍ້ຜິດພາດເວລາທົດສອບ
                                swal("ຜິດພາດ", "ບໍ່ສາມາດລືບຂໍ້ມູນນີ້ໄດ້ ເນື່ອງຈາກມີພະນັກງານສັງກັດໃນພະແນກນີ້ຢູ່!", "error", {
                                    button: "ຕົກລົງ",
                                });
                            } else {
                                swal("ສໍາເລັດ", "ຂໍ້ມູນຖືກລືບອອກຈາກຖານຂໍ້ມູນແລ້ວ", "success", {
                                    button: "ຕົກລົງ",
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 2000); //2000 = 2ວິນາທີ
                            }
                        }
                    });

                } else {
                    swal("ຂໍ້ມູນຂອງທ່ານຍັງປອດໄພ!", {
                        button: "ຕົກລົງ",
                    });
                }
            });
    }


    /* ບໍ່ໃຫ້ມັນຊັບມິດຄືນ*/
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    };
</script>