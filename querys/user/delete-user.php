<?php
session_start();
include('../utilities/check-session.php');
include('../utilities/db.php');

$password = $_GET['password'];
getDB();
$str_query = "SELECT contrasenya FROM usuari WHERE id=" . $_SESSION['user_id'];
$query = mysqli_query($con, $str_query);

while ($row = mysqli_fetch_array($query)) {
    if (!password_verify($password, $row['contrasenya'])) {
        closeDB();
        header('Location: ../../profile.php?idProfile=' . $_SESSION['user_id']);
        exit();
    }
    $str_query2 = "DELETE FROM `usuari` WHERE id=" . $_SESSION['user_id'];
    $query2 = mysqli_query($con, $str_query2);
    closeDB();
    session_destroy();
    header('Location: ../../login.php');
    exit();
}
closeDB();
?>