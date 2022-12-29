<?php
include_once 'connect_db.php';
$empno = $_POST['empno'];
$sql = "DELETE FROM emp WHERE emp_ID='$empno'";
mysqli_query($link, $sql);