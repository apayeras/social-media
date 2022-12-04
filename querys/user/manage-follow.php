<?php
session_start();
include('../utilities/check-session.php');
include('../utilities/db.php');

getDB();
$_SESSION['changeSuggestedFollows'] = 'F';
$idButton = 0;

if (isset($_GET["idButton"])) {
    $idButton = $_GET["idButton"];
} else {
    $counter = 1;
    while (true) {
        if (isset($_SESSION['button' . $counter])) {
            if ($_SESSION['button' . $counter] == $_GET["idProfile"]) {
                $idButton = $counter;
                break;
            }
        } else {
            break;
        }
        $counter += 1;
    }
}

if (isset($_GET["follow"])) {
    if ($_GET["follow"] == "Seguir") {
        $str_query = "INSERT INTO seguidors VALUES (" . $_SESSION['user_id'] . ", " . $_GET["idProfile"] . ")";
        $_SESSION['followButton' . $idButton] = "Deixar de seguir";
    } else {
        $str_query = "DELETE FROM seguidors WHERE idSeguidor = " . $_SESSION['user_id'] . " and idSeguit = " . $_GET["idProfile"];
        $_SESSION['followButton' . $idButton] = "Seguir";
    }
    $query = mysqli_query($con, $str_query);
}
closeDB();
header('Location: ../../' . $_GET["location"]);
exit;
?>
