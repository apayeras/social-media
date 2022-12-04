<?php
session_start();
include('../utilities/db.php');
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    getDB();
    $str_query = "SELECT id, contrasenya FROM usuari WHERE nomUsuari=\"$username\"";
    $query = mysqli_query($con, $str_query);

    if (mysqli_num_rows($query) == 0) {
        $_SESSION['login'] = 0;
        header("Location: ../../login.php");
    }

    while ($row = mysqli_fetch_array($query)) {
        if (password_verify($password, $row['contrasenya'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: ../../home.php");
            exit();
        }
        $_SESSION['login'] = 0;
        header("Location: ../../login.php");
    }
}
?>
