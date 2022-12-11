<?php
session_start();
include('querys/utilities/check-session.php');
include('querys/utilities/db.php');
getDB();

$str_query = "SELECT id, nomPerfil, fotoPerfil, dataMax, counter FROM usuari
    JOIN (SELECT IF(idEmissor =" . $_SESSION['user_id'] . ", idReceptor, idEmissor) as personaInvolucrada, max(data) as dataMax, count(case when llegit=0 and idReceptor=" . $_SESSION['user_id'] . " then 1 end) as counter
    FROM missatge
    WHERE idReceptor = " . $_SESSION['user_id'] . " or idEmissor = " . $_SESSION['user_id'] . "
    GROUP BY personaInvolucrada) as missatges
    ON missatges.personaInvolucrada = usuari.id
    ORDER BY dataMax DESC;";
$query = mysqli_query($con, $str_query);
$id = 1;

while ($row = mysqli_fetch_array($query)) {
    $_SESSION['idPerfil' . $id] = $row['id'];
    $_SESSION['namePerfil' . $id] = $row['nomPerfil'];

    $_SESSION['dataMax' . $id] = $row['dataMax'];
    $_SESSION['counter' . $id] = $row['counter'];

    if (isset($row['fotoPerfil'])) {
        $_SESSION['photoPerfil' . $id] = $row['fotoPerfil'];
    } else {
        $_SESSION['photoPerfil' . $id] = "imgs/blank-profile.png";
    }

    $id += 1;
}
unset($_SESSION['namePerfil' . $id]);
closeDB();
