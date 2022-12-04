<?php
session_start();
include('../utilities/check-session.php');
include('../utilities/db.php');

getDB();
if (strlen($_GET["text"]) > 0) {
    $str_query = "INSERT INTO `publicacio`(`text`, `idUsuari`, `idHistoria`, `data`) 
    VALUES (\"" . $_GET['text'] . "\"," . $_SESSION['user_id'] . "," . $_GET['historyId'] . ", now())";
    echo $str_query;
    $query = mysqli_query($con, $str_query);
}
closeDB();
header('Location: ../auxiliar/home-history.php?text=&historyId=-1');
?>