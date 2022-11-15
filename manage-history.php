<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
include('querys/db.php');
getDB();

$str_query = "INSERT INTO `historia`(`nom`, `foto`, `privada`, `idUsuari`) VALUES ('".$_GET["historyName"]."','".$_GET["historyPhoto"]."',".$_GET["privacity"]."," .$_SESSION["user_id"].")";
$query = mysqli_query($con, $str_query);

header('Location: profile.php?idProfile='.$_SESSION['user_id']);
exit;
closeDB();
