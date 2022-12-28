<?php
include_once 'connect_db.php';
$grade = $_POST['grade'];
$sql = "DELETE FROM salary WHERE grade='$grade'";
mysqli_query($link, $sql);