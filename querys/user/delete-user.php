<?php
session_start();
include('../utilities/check-session.php');
include('../utilities/db.php');

$password = $_GET['password'];
getDB();
$str_query = "SELECT nomUsuari, contrasenya FROM usuari WHERE id=" . $_SESSION['user_id'];
$query = mysqli_query($con, $str_query);

while ($row = mysqli_fetch_array($query)) {
    if (!password_verify($password, $row['contrasenya'])) {
        closeDB();
        $_SESSION['delete'] = 1; // DELETE wasn't successful
        header('Location: ../../profile.php?idProfile=' . $_SESSION['user_id']);
        exit();
    }
    $str_query2 = "DELETE FROM `usuari` WHERE id=" . $_SESSION['user_id'];
    $query2 = mysqli_query($con, $str_query2);
    closeDB();
    $_SESSION['delete'] = 0; // DELETE was successful
    $_SESSION['deleteName'] = $row['nomUsuari'];
    header('Location: ../../login.php');
    exit();
}
closeDB();
?>