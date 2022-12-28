<?php
include_once 'connect_db.php';
if (isset($_POST['empno'])) {
    $empno = $_POST['empno'];
    $output = '';
    $sql = "SELECT e.emp_ID, e.emp_name, e.gender, e.dateOfBirth, year(curdate())-year(e.dateOfBirth) AS age, e.address,
 e.picture, d.name, s.salary, e.incentive, s.salary+e.incentive AS total, e.language 
 FROM emp e JOIN dept d ON e.d_ID=d.d_ID JOIN salary s ON e.grade=s.grade WHERE e.emp_ID='$empno'";
 $result = mysqli_query($link,$sql);
 while ($row = mysqli_fetch_assoc($result)) {
    $picture = is_numeric($row['picture']) ? "avatar_img.png" : $row['picture'];
    $output .= '<p style="text-align: center">';

    $output .= '<img src="image/' . $picture . ' " alt="ຮູບພະນັກງານ" width="150px" height="200px"  class="img-thumbnail">';
    $output .= ' </p>';
    $output .= "<table>";
    $output .= "<tr><td>ລະຫັດພະນັກງານ: </td><td>" . $row['emp_ID'] . "</td></tr>";
    $output .= "<tr><td>ຊື່ ແລະ ນາມສະກຸນ: </td><td>" . $row['emp_name'] . "</td></tr>";
    $output .= "<tr><td>ເພດ: </td><td>" . $row['gender'] . "</td></tr>";
    $output .= "<tr><td>ວັນ, ເດືອນ, ປີເກີດ: </td><td>" . date('d / m / Y', strtotime($row['dateOfBirth'])) . "</td></tr>";
    $output .= "<tr><td>ອາຍຸ: </td><td>" . $row['age'] . " ປີ" . "</td></tr>";
    $output .= "<tr><td>ທີ່ຢູ່: </td><td>" . $row['address'] . "</td></tr>";
    $output .= "<tr><td>ພະແນກ: </td><td>" . $row['name'] . "</td></tr>";
    $output .= "<tr><td>ເງິນເດືອນ: </td><td>" . number_format($row['salary']) . " ກີບ</td></tr>";
    $output .= "<tr><td>ເງິນອຸດໜູນ: </td><td>" . number_format($row['incentive']) . " ກີບ</td></tr>";
    $output .= "<tr><td>ລາຍຮັບລວມ: </td><td>" . number_format($row['total']) . " ກີບ</td></tr>";
    $output .= "<tr><td>ພາສາຕ່າງປະເທດ: </td><td>" . $row['language'] . "</td></tr>";
    $output .= "</table>";
}

echo $output;
}
