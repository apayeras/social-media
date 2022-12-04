<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
include('querys/db.php');
getDB();

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $_GET["photo"]);
curl_setopt($ch, CURLOPT_NOBODY, 1);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);
if ($result !== FALSE) {
    $photo = $_GET["photo"];
} else {
    $photo = null;
}

$str_query = "UPDATE usuari SET `nomPerfil`='" . $_GET['name'] . "',`descripcio`='" . $_GET['description'] . "',`fotoPerfil`='" . $photo . "' 
    WHERE usuari.id = " . $_SESSION['user_id'];
$query = mysqli_query($con, $str_query);

header('Location: profile.php?idProfile=' . $_SESSION['user_id']);
exit;
closeDB();
