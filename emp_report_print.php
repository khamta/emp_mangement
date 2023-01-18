<?php
include_once 'login_check.php';
include_once 'Laokip_read.php';
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
    <style>
        table {
            border-collapse: collapse;
        }

        td,
        th,
        tr {
            border: 1px black solid;
            height: 35px;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-3">
        <div class="text-center">
            <img src="image/123.jpg" width="100px" alt="ຮູບກາຊາດ"><br>
            ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ<br>
            ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນະຖາວອນ
            <p>----------<?php for ($i = 0; $i <= 5; $i++) echo '<i class="far fa-star"></i>'; ?>----------</p>

        </div>
        <div class="row">
            <div class="col-6">
                ຊື່ບໍລິສັດ:.................<br>
                ທີ່ຢູ່:....................<br>
                ເບີໂທ:..................<br>
            </div>
            <div class="col-6 text-end">
                ເລກທີ:.......................<br>
                ທີ່......................, ວັນທີ່...............<br>
            </div>
        </div>
        <p class="text-center fw-bold h5">ລາຍງານຂໍ້ມູນພະນັກງານ</p>
        <table class="table table-hover table-bordered w-100">
            <thead class="bg-dark text-black text-center">
                <tr>
                    <th>ລະຫັດ</th>
                    <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                    <th>ເພດ</th>
                    <th>ເງິນເດືອນ</th>
                    <th>ເງິນອຸດໜູນ</th>
                    <th>ລາຍຮັບ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $department = "";
                $sum = 0;
                $sql = "SELECT e.emp_ID, e.emp_name, e.gender, d.name AS department, s.salary, e.incentive, s.salary+e.incentive AS total "
                    . " FROM emp e JOIN dept d ON e.d_ID = d.d_ID JOIN salary s ON e.grade = s.grade $where ORDER BY department ASC, total DESC";
                $result = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    //ສະແດງຊື່ຂອງພະແນກ ແລະ ຜົນບວກທັງໝົດເງິນເດືອນ ບວກ ເງິນອຸດອຸດໝູນ ຂອງພະແນກນັ້້ນ
                    if (strcmp($department, $row['department']) !== 0) {
                        $department = $row['department'];
                        $sql1 = "SELECT sum(s.salary+e.incentive) FROM emp e JOIN dept d ON e.d_ID=d.d_ID JOIN salary s ON e.grade=s.grade "
                            . " WHERE d.name='$department'";
                        $result1 = mysqli_query($link, $sql1);
                        $row1 = mysqli_fetch_array($result1);
                ?>
                        <tr>
                            <td colspan="5" class="fw-bold text-success" style="background-color: #D9D9D9;"><?php echo "$department: " . LakLao($row1[0]) ?></td>
                            <td class="fw-bold text-success text-end" style="background-color: #D9D9D9;"><?= number_format($row1[0]) ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $row['emp_ID']; ?></td>
                        <td><?php echo $row['emp_name']; ?></td>
                        <td class="text-center"><?php echo $row['gender']; ?></td>
                        <td class="text-end"><?php echo number_format($row['salary']); ?></td>
                        <td class="text-end"><?php echo number_format($row['incentive']); ?></td>
                        <td class="text-end"><?php echo number_format($row['total']); ?></td>
                    </tr>
                <?php
                    $sum += $row['total'];
                }
                ?>
                <tr>

                    <td colspan="5" class="fw-bold bg-secondary text-black">ລວມທັງໝົດ:&nbsp;&nbsp;<?= LakLao($sum) ?></td>
                    <td class="fw-bold bg-secondary text-black text-end"><?= number_format($sum) ?></td>

                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-3 fw-bold text-end">ຜູ້ອຳນວຍການ</div>
            <div class="col-3"></div>
            <div class="col-3"></div>
            <div class="col-3 fw-bold">ຜູ້ສະຫຼຸບລາຍງານ</div>

        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        window.onafterprint = window.close;
        window.print();
    });
</script>