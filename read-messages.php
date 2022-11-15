<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
} else {
    $_SESSION['perfilSeleccionat'] = $_GET['idchat'];
    $_SESSION['nomSeleccionat'] = $_GET['nom'];
    $_SESSION['fotoSeleccionat'] = $_GET['foto'];
    $_SESSION['numMissatges'] -= $_GET['counter'];
    if ($_SESSION['numMissatges'] == 0) {
        unset($_SESSION['numMissatges']);
    }
    include('querys/db.php');
    getDB();
    $str_query = "UPDATE missatge SET missatge.llegit = true where missatge.idEmissor = " . $_SESSION['perfilSeleccionat'] . " and missatge.idReceptor = " . $_SESSION['user_id'] . ";";
    $query = mysqli_query($con, $str_query);

    $str_query = "select id, txt, if(idEmissor = " . $_SESSION['perfilSeleccionat'] . ", 'message', 'message own') as emissor, data from missatge 
    where missatge.idEmissor = " . $_SESSION['perfilSeleccionat'] . " and missatge.idReceptor = " . $_SESSION['user_id'] . "
    or missatge.idEmissor = " . $_SESSION['user_id'] . " and missatge.idReceptor = " . $_SESSION['perfilSeleccionat'] . " 
    order by missatge.data;";
    $query = mysqli_query($con, $str_query);

    $id = 1;
    while ($row = mysqli_fetch_array($query)) {
        $_SESSION['idMissatge' . $id] = $row['id'];
        $_SESSION['text' . $id] = $row['txt'];

        $_SESSION['emissor' . $id] = $row['emissor'];
        $_SESSION['data' . $id] = $row['data'];

        if (isset($row['fotoPerfil'])) {
            $_SESSION['fotoPerfil' . $id] = $row['fotoPerfil'];
        } else {
            $_SESSION['fotoPerfil' . $id] = "https://iio.azcast.arizona.edu/sites/default/files/profile-blank-whitebg.png";
        }

        $id += 1;
    }
    unset($_SESSION['idMissatge' . $id]);
    header('Location: chat.php');
    exit;
}
