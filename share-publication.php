<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
include('querys/db.php');
getDB();

if (strlen($_GET["text"]) > 0) {
    $str_query = "INSERT INTO `publicacio`(`text`, `idUsuari`, `idHistoria`, `data`) 
    VALUES ('" . $_GET["text"] . "'," . $_SESSION["user_id"] . "," . $_GET["historyId"] . ", now())";

    $query = mysqli_query($con, $str_query);
}


header('Location: home-history.php?text=&historyId=-1');
exit;
closeDB();
