<?php
include_once 'connect_db.php';
$dno = $_POST['dno'];
$sql = "DELETE FROM dept WHERE d_ID='$dno'";
mysqli_query($link, $sql);