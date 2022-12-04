<?php
session_start();
include('../utilities/check-session.php');
include('../utilities/db.php');
getDB();

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $_GET["historyPhoto"]);
curl_setopt($ch, CURLOPT_NOBODY, 1);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);
if ($result !== FALSE) {
    $photo = $_GET["historyPhoto"];
} else {
    $photo = null;
}

$str_query = "INSERT INTO `historia`(`nom`, `foto`, `privada`, `idUsuari`) 
    VALUES ('" . $_GET["historyName"] . "','" . $photo . "'," . $_GET["privacity"] . "," . $_SESSION["user_id"] . ")";
$query = mysqli_query($con, $str_query);
closeDB();

header('Location: ../../profile.php?idProfile=' . $_SESSION['user_id']);
exit;
?>