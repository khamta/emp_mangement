<?php
include_once 'login_check.php';
include_once 'laokip_read.php';

// Filter the excel data 
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

//set timezone
date_default_timezone_set('Asia/Bangkok');
// Column names 
$fields = array('ລະຫັດ', 'ຊື່ ແລະ ນາມສະກຸນ', 'ເພດ', 'ເງິນເດືອນ', 'ເງິນອຸດໜູນ', 'ລາຍຮັບລວມ', 'ພະແນກ');
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n";

if ($_GET['department'] !== "") {
    $fileName = "employee_".$_GET['department']."_" . date('Y-m-d-H-i-s') . ".xls"; //File name

    $sql = "SELECT e.emp_ID, e.emp_name, e.gender, d.name AS department, s.salary, e.incentive, s.salary + e.incentive AS total, d.name AS department "
    . " FROM emp e JOIN dept d ON e.d_ID = d.d_ID JOIN salary s ON e.grade = s.grade WHERE d.d_ID = '" . $_GET['department'] . "' ORDER BY total DESC";
} else {
    $fileName = "employee_All". date('Y-m-d-H-i-s') . ".xls"; //File name

    $sql = "SELECT e.emp_ID, e.emp_name, e.gender, d.name AS department, s.salary, e.incentive, s.salary + e.incentive AS total, d.name AS department "
    . " FROM emp e JOIN dept d ON e.d_ID = d.d_ID JOIN salary s ON e.grade = s.grade  ORDER BY department ASC, total DESC";
}

$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $lineData = array($row['emp_ID'], $row['emp_name'], $row['gender'], $row['salary'], $row['incentive'], $row['total'], $row['department']);
    array_walk($lineData, 'filterData');
    $excelData .= implode("\t", array_values($lineData)) . "\n";
}

// Headers for download 
header('Content-Type: application/xls');
header("Content-Disposition: attachment; filename=\"$fileName\"");

// Render excel data 
print chr(255) . chr(254) . mb_convert_encoding($excelData, 'UTF-16LE', 'UTF-8');

exit;