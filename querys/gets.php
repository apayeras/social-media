<?php
function get_profile_card($con, $user)
{
    $str_query = "SELECT nomPerfil, descripcio, fotoPerfil, numSeguidors, numSeguits, numPosts from usuari
        JOIN (select count(idSeguidor) as numSeguidors from seguidors WHERE seguidors.idSeguit = " . $user . ") as q1
        JOIN (select count(idSeguit) as numSeguits from seguidors WHERE seguidors.idSeguidor = " . $user . ") as q2
        JOIN (select count(publicacio.id) as numPosts from publicacio WHERE publicacio.idUsuari = " . $user . ") as q3
        WHERE usuari.id = " . $user . ";";

    $query = mysqli_query($con, $str_query);

    while ($row = mysqli_fetch_array($query)) {
        $_SESSION['nomPerfil'] = $row['nomPerfil'];

        if (isset($row['descripcio'])) {
            $_SESSION['descripcio'] = $row['descripcio'];
        } else {
            $_SESSION['descripcio'] = "Add new description";
        }

        if (isset($row['fotoPerfil'])) {
            $_SESSION['fotoPerfil'] = $row['fotoPerfil'];
        } else {
            $_SESSION['fotoPerfil'] = "https://iio.azcast.arizona.edu/sites/default/files/profile-blank-whitebg.png";
        }

        $_SESSION['numSeguidors'] = $row['numSeguidors'];
        $_SESSION['numSeguits'] = $row['numSeguits'];
        $_SESSION['numPosts'] = $row['numPosts'];
    }
}

function get_num_messages($con, $user)
{
    $str_query = "select count(id) as numMissatges from missatge where llegit=false and idReceptor=" . $user;

    $query = mysqli_query($con, $str_query);

    while ($row = mysqli_fetch_array($query)) {
        if ($row['numMissatges'] == 0) {
            unset($_SESSION['numMissatges']);
        } else {
            $_SESSION['numMissatges'] = $row['numMissatges'];
        }
    }
}

function get_suggeted_follows($con, $user)
{
    $str_query = "select id, nomUsuari, nomPerfil, fotoPerfil from usuari
            where usuari.id NOT IN (select idSeguit from seguidors WHERE idSeguidor=" . $user . ") and usuari.id != " . $user . "
            order by rand()
            limit 4";

    $query = mysqli_query($con, $str_query);

    unset($_SESSION['button1']);
    unset($_SESSION['button2']);
    unset($_SESSION['button3']);
    unset($_SESSION['button4']);
    $id = 1;

    while ($row = mysqli_fetch_array($query)) {
        $_SESSION['button' . $id] = $row['id'];

        $_SESSION['nomUsuari' . $id] = $row['nomUsuari'];
        $_SESSION['nomPerfil' . $id] = $row['nomPerfil'];
        $_SESSION['followButton' . $id] = "Seguir";

        if (isset($row['fotoPerfil'])) {
            $_SESSION['fotoPerfil' . $id] = $row['fotoPerfil'];
        } else {
            $_SESSION['fotoPerfil' . $id] = "https://iio.azcast.arizona.edu/sites/default/files/profile-blank-whitebg.png";
        }

        $id += 1;
    }
}

function get_follow_information($con, $user, $main_user)
{
    $str_query = "select seguidors.idSeguidor from seguidors where idSeguidor = " . $main_user . " and idSeguit = " . $user;

    $query = mysqli_query($con, $str_query);
    $_SESSION['mainFollowButton'] = 'Seguir';
    while ($row = mysqli_fetch_array($query)) {
        $_SESSION['mainFollowButton'] = 'Deixar de seguir';
    }
}

function get_personal_histories($con, $user, $main_user){
    $str_query = "SELECT `id`, `nom`, `foto` FROM `historia` 
    WHERE historia.idUsuari = ".$user."  AND 
    (historia.privada = 0 OR 
    ".$user." = ".$main_user." OR 
    (SELECT COUNT(idSeguidor) FROM seguidors WHERE seguidors.idSeguidor = ".$main_user." AND seguidors.idSeguit = ".$user."));";

    $query = mysqli_query($con, $str_query);

    $id = 1;
    while ($row = mysqli_fetch_array($query)) {
        $_SESSION['history' . $id] = $row['id'];
        $_SESSION['historyName' . $id] = $row['nom'];
        $_SESSION['historyPhoto' . $id] = $row['foto'];
        
        $id += 1;
    }
    unset($_SESSION['history'.$id]);
}

function get_user_publications($con, $user){
    $str_query = "SELECT publicacio.id, `text`, `foto`, `nomUsuari` FROM `publicacio` 
    JOIN usuari
    ON usuari.id = publicacio.idUsuari WHERE idUsuari = ".$user." and idHistoria is null or ''";
    $query = mysqli_query($con, $str_query);

    $id = 1;
    while ($row = mysqli_fetch_array($query)) {
        $_SESSION['publication' . $id] = $row['id'];
        $_SESSION['publicationText' . $id] = $row['text'];
        $_SESSION['publicationPhoto' . $id] = $row['foto'];
        $_SESSION['publicationUser' . $id] = $row['nomUsuari'];
        
        $id += 1;
    }
    unset($_SESSION['publication'.$id]);
}