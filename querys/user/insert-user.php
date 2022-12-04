<?php
session_start();
include('../db.php');
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    getDB();

    $str_query = "SELECT * FROM usuari WHERE nomUsuari='" . $username . "'";
    $query = mysqli_query($con, $str_query);

    if ($query->num_rows > 0) {
        $_SESSION['register'] = 0; // User already exists
        header("Location: ../../register.php");
    }

    if ($query->num_rows == 0) {
        $str_query = "INSERT INTO usuari(nomUsuari,nomPerfil,contrasenya,email) VALUES (\"$username\",\"$username\",\"$password_hash\",\"$email\")";
        $query = mysqli_query($con, $str_query);

        if (!$query) {
            $_SESSION['register'] = 2; // Something went wrong
            header("Location: ../../register.php");
        }

        $_SESSION['user_id'] = mysqli_insert_id($con);
        header('Location: ../../home.php');
        exit;
    }
    closeDB();
}
?>