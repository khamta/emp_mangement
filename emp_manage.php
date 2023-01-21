<?php
include_once 'login_check.php';

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
    <style>
        .active2 {
            background: black;
            border-radius: 10px;
        }
        .active22 {
            background: lightgrey;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php include_once 'menu.php'; ?>

    <div class="container-fluid mt-3">
        <div class="alert alert-success alert-dismissible text-center">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>ຈັດການຂໍ້ມູນພະນັກງານ</strong>
        </div>
        <p class="d-flex justify-content-end">
            <a href="emp_add.php" class="btn btn-success text-white">
                <i class="fas fa-plus-circle"></i>&nbsp;ເພີ່ມຂໍ້ມູນ</a>
        </p>
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="bg-dark text-center text-white">
                <tr>
                    <th style="width: 200px;">ລະຫັດພະນັກງານ</th>
                    <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                    <th>ເພດ</th>
                    <th>ພະແນກ</th>
                    <th>ອັອບຊັ່ນ</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT e.emp_ID, e.emp_name, e.gender, d.name FROM emp e JOIN dept d ON e.d_ID = d.d_ID";
                $result = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_assoc($result)) {

                ?>
                    <tr>

                        <td class="text-center"><?= $row['emp_ID'] ?></td>
                        <td><?= $row['emp_name'] ?></td>
                        <td class="text-center"><?= $row['gender'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td class="text-center" style="width: 100px;">
                            <a href="#" onclick="viewdata(<?php echo '\'' . $row['emp_ID'] . '\''; ?>)" data-bs-toggle="tooltip" data-bs-placement="left" title="ກວດສອບຂໍ້ມູນ"><i class="fas fa-eye"></i></a>
                            <a href="emp_edit.php?emp_ID=<?= $row['emp_ID'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="ແກ້ໄຂ"><i class="fas fa-edit"></i></a>
                            <a href="#" onclick="deletedata(<?php echo '\'' . $row['emp_ID'] . '\''; ?>)" data-bs-toggle="tooltip" data-bs-placement="left" title="ລືບຂໍ້ມູນ"><i class="fas fa-trash-alt text-danger"></i></a>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- The Modal ສະແດງລາຍລະອຽດຂໍ້ມູນພະນັກງານ -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ລາຍລະອຽດຂໍ້ມູນພະນັກງານ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="employee_detail">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ປິດ</button>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    function viewdata(id) {
        /*ກົດທີ່ ສະແດງລາຍລະອຽດ */
        $.ajax({
            url: "emp_view.php",
            method: "post",
            data: {
                empno: id
            },
            success: function(data) {
                $('#employee_detail').html(data);
                $('#myModal').modal("show");
            }
        });
    };
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
                        url: "emp_delete.php",
                        method: "post",
                        data: {
                            empno: id
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

</script>