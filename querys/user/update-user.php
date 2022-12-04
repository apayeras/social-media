<?php
session_start();
include('../utilities/check-session.php');
include('../utilities/db.php');
getDB();

// If photo link if found insert photo link, otherwise insert null
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
closeDB();

header('Location: ../../profile.php?idProfile=' . $_SESSION['user_id']);
exit;
?>