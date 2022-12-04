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

echo "";
if ($result !== FALSE and $_GET["photo"] != "") {
    $photo = "`fotoPerfil`=\"" . $_GET["photo"] . "\"";
} else {
    $photo = "`fotoPerfil`= null";
}

if ($_GET['description'] == "") {
    $description = "`descripcio`= null";
} else {
    $description = "`descripcio`=\"" . $_GET['description'] . "\"";
}

if ($_GET['name'] == "") {
    $name = "`nomPerfil`= null";
} else {
    $name = "`nomPerfil`=\"" . $_GET['name'] . "\"";
}

$str_query = "UPDATE usuari SET " . $name . ", " . $description . ", " . $photo . " 
    WHERE usuari.id = " . $_SESSION['user_id'];

echo $str_query;
$query = mysqli_query($con, $str_query);
closeDB();

header('Location: ../../profile.php?idProfile=' . $_SESSION['user_id']);
exit;
?>