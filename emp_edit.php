<?php

include_once 'login_check.php';
include_once 'function/function.php';
//ຮັບຄ່າຈາກຟອມຖ້າມີການກົດປຸ່ມຊື່ btnAdd
//ຮັບຄ່າທີ່ສົ່ງມາກັບ URL
$empno = $_GET['emp_ID'];
$sql = "SELECT *FROM emp WHERE emp_ID='$empno'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$empno = $row['emp_ID'];
$empname = $row['emp_name'];
$gender = $row['gender'];
$date_birth = $row['dateOfBirth'];
$address = strip_tags($row['address']); //ບໍ່ໃຫ້ສະແດງ tag ຂອງ html
$incentive = $row['incentive'];
$language = $row['language'];
$file_image = is_numeric($row['picture']) ? "avatar_img.png" : $row['picture'];
$salary = $row['grade'];
$department = $row['d_ID'];
// ຖ້າວ່າມີການກົດປຸ່ມ btnAdd
if (isset($_POST['btnEdit'])) {
    $empno = data_input($_POST['empno']);
    $empname = data_input($_POST['empname']);
    $gender = $_POST['gender'];
    $date_birth = $_POST['date_birth'];
    $address = nl2br(trim(stripcslashes($_POST['address']))); //nl2br ເປັນຄຳສັ່ງໃຫ້ລົງແຖວໃນຖານຂໍ້ມູນເມືອກົດເອັນເຕີ່ລົງແຖວໃນ textarea
    // ຮັບຂໍ້ມູນປະເພດໄຟຮູບພາບ
    $file_image = $_FILES['file_image']['name'];
    $file_tmp = $_FILES['file_image']['tmp_name'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];

    $incentive = str_replace(",", "", $_POST['incentive']);
    $language = implode(",", $_POST['language']);
// ຖ້າບໍ່ເລືອກຮູບພາບໃໝ່
if(empty($file_image)){
    $sql = "UPDATE emp SET emp_name='$empname', gender='$gender', dateOfBirth='$date_birth', address='$address',
    d_ID='$department', grade='$salary', incentive='$incentive', language='$language' WHERE emp_ID='$empno'";

    if (mysqli_query($link, $sql)) {
       header("location: emp_manage.php");
    } else {
        echo mysqli_error($link);
    }
}else{
    $old_picture = $_POST['old_picture'];
    unlink("image/$old_picture");

    $file_image = round(round(microtime(true))).$file_image;
    move_uploaded_file($file_tmp, "image/".$file_image);

    $sql = "UPDATE emp SET emp_name='$empname', gender='$gender', dateOfBirth='$date_birth', address='$address', picture='$file_image',
    d_ID='$department', grade='$salary', incentive='$incentive', language='$language' WHERE emp_ID='$empno'";
    if (mysqli_query($link, $sql)) {
        header("location: emp_manage.php");
     } else {
         echo mysqli_error($link);
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
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/jquery.priceformat.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        #img-upload {
            width: 150px;
            height: 185px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php include_once 'menu.php'; ?>
    <?= @$message_error ?>
    <?= @$message_ok ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <span class="d-flex justify-content-end">
                    <a href="emp_manage.php" class="btn btn-secondary"><i class="fas fa-address-card"></i>&nbsp;ສະແດງຂໍ້ມຸນ</a>
                </span>
                <div class="card">
                    <div class="card-header bg-info text-white h5">ເພີ່ມຂໍ້ມູນພະນັກງານ</div>
                    <div class="card-body ">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- ລະຫັດພະນັກງານ -->
                                            <div class="mb-3">
                                                <label for="empno" class="form-label">ລະຫັດພະນັກງານ:</label>
                                                <input type="text" class="form-control" id="empno" placeholder="ປ້ອນລະຫັດພະນັກງານ" name="empno" required value="<?= @$empno ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- ຊື່ພະນັກງານ -->
                                            <div class="mb-3">
                                                <label for="empname" class="form-label">ຊື່ພະນັກງານ:</label>
                                                <input type="text" class="form-control" id="empname" placeholder="ປ້ອນຊື່ພະນັກງານ" name="empname" required value="<?= @$empname ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- ເພດ-->
                                            <fieldset>
                                                <p>ເພດ</p>
                                                <div class="form-check-inline">
                                                    <input type="radio" class="form-check-input" id="gender1" name="gender" value="ຊາຍ" <?php if (@$gender == "" || @$gender == "ຊາຍ") echo 'checked'; ?>> ຊາຍ
                                                    <label class="form-check-label" for="gender1"></label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input type="radio" class="form-check-input" id="gender2" name="gender" value="ຍິງ" <?php if (@$gender == "" || @$gender == "ຍິງ") echo 'checked'; ?>> ຍິງ
                                                    <label class="form-check-label" for="gender2"></label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- ວັນເດືອນປີເກີດ -->
                                            <div class="mb-3">
                                                <label for="date_birth" class="form-label">ວັນ, ເດືອນ, ປີເກີດ:</label>
                                                <input type="date" class="form-control" id="date_birth" name="date_birth" required value="<?= @$date_birth ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <!-- ທີ່ຢູ່ -->
                                            <div class="mb-3">
                                                <label for="address">ທີ່ຢູ່:</label>
                                                <textarea class="form-control" rows="5" id="address" name="address"><?= strip_tags(@$address) ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- ຮູບ ແລະ ພະແນກ -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- ຮູບ -->
                                            <div style="text-align: center">
                                                <img id='img-upload' />
                                                <div id="temp_img">
                                                    <img src="image/<?= $file_image ?>" alt="" width="150px" height="180px" />
                                                </div>
                                                <!--ເລືອກຮູບພາບ-->
                                                <br>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <span class="btn btn-info btn-file">
                                                            ເລືອກຮູບ<input type="file" id="imgInp" name="file_image" accept="image/*">
                                                        </span>
                                                    </span>
                                                    <input type="text" class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <!-- ພະແນກ -->
                                            <div class="mb-3">
                                                <label for="department" class="form-label">ພະແນກ</label>
                                                <select class="form-select" name="department" id="department" required="true">
                                                    <option value="">---ເລືອກພະແນກ---</option>
                                                    <?php
                                                    $sql = "SELECT d_ID, name FROM dept";
                                                    $result = mysqli_query($link, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                        <option value="<?= $row['d_ID'] ?>" <?php if (@$department == $row['d_ID']) echo 'selected'; ?>><?= $row['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- ຂັ້ນເງິນເດືອນ -->
                                    <div class="mb-3">
                                        <label for="salary" class="form-label">ຂັ້ນເງິນເດືອນ</label>
                                        <select class="form-select" name="salary" id="salary" required="true">
                                            <option value="">---ເລືອກຂັ້ນເງິນເດືອນ---</option>
                                            <?php
                                            $sql = "SELECT grade, salary FROM salary";
                                            $result = mysqli_query($link, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <option value="<?= $row['grade'] ?>" <?php if (@$salary == $row['grade']) echo 'selected'; ?>><?= $row['grade'] . " = " . number_format($row['salary']) ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- ເງິນອຸດໜູນ -->
                                    <div class="mb-3">
                                        <label for="incentive" class="form-label">ເງິນອຸດໜູນ</label>
                                        <input type="text" class="form-control" name="incentive" id="incentive" placeholder="ປ້ອນເງິນອຸດໜູນ" value="<?= @$incentive ?>" min="0">
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <!-- ພາສາຕ່າງປະເທດ -->
                                    <fieldset>
                                        <p>ພາສາຕ່າງປະເທດ</p>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="language[]" value="ອັງກິດ" <?php if (strpos(@$language, "ອັງກິດ") !== FALSE) echo 'checked'; ?>>
                                            <label class="form-check-label">ອັງກິດ</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="language[]" value="ຈີນ" <?php if (strpos(@$language, "ຈີນ") !== FALSE) echo 'checked'; ?>>
                                            <label class="form-check-label">ຈີນ</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="language[]" value="ຫວຽດ" <?php if (strpos(@$language, "ຫວຽດ") !== FALSE) echo 'checked'; ?>>
                                            <label class="form-check-label">ຫວຽດນາມ</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="language[]" value="ຝຣັ່ງ" <?php if (strpos(@$language, "ຝຣັ່ງ") !== FALSE) echo 'checked'; ?>>
                                            <label class="form-check-label">ຝຣັ່ງ</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="language[]" value="ອຶ່ນໆ..." <?php if (strpos(@$language, "ອຶ່ນໆ...") !== FALSE) echo 'checked'; ?>>
                                            <label class="form-check-label">ອຶ່ນໆ...</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-12 text-center">
                                    <!-- ປຸ່ມ -->
                                    <button type="submit" name="btnEdit" class="btn btn-info" style="width: 110px; border-radius: 20px;">ແກ້ໄຂ</button>
                                    <a href="emp_manage.php" class="btn btn-warning" style="width: 110px; border-radius: 20px;">ຍົກເລີກ</a>
                                    <!--ສົ່ງຊື່ໄຟລ໌ຮູບເກົ່າໄປນໍາແຕ່ບໍ່ໃຫ້ສະແດງ-->
                                    <input type="hidden" name="old_picture" value="<?= $file_image ?>">
                                    <p></p>
                                </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        /*ເລືອກຮູບພາບ*/
        $('#img-upload').hide();
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
            $('#temp_img').hide(); /*ໃຫ້ເຊືອງເມືອເລືອກຮູບ*/
            $('#img-upload').show();
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log)
                    alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
        /*ສິ້ນສຸດເລືອກຮູບ*/

        /*ແຍກຈຸດຫຼັກພັນ....*/
        $('#incentive').priceFormat({
            prefix: '',
            thounsandsSeparator: ',',
            centsLimit: 0
        });

    });
    /*ບໍ່ໃຫ້ມັນຊັບມິດຄືນ*/
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>