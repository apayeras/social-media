<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
include('querys/db.php');
$password = $_GET['password'];
getDB();
$str_query = "SELECT contrasenya FROM usuari WHERE id=" . $_SESSION['user_id'];
$query = mysqli_query($con, $str_query);

while ($row = mysqli_fetch_array($query)) {
    if (!password_verify($password, $row['contrasenya'])) {
        header('Location: profile.php?idProfile=' . $_SESSION['user_id']);
        exit();
    }
    $str_query2 = "DELETE FROM `usuari` WHERE id=" . $_SESSION['user_id'];
    $query2 = mysqli_query($con, $str_query2);
    session_destroy();
    header('Location: login.html');
    exit();
}
