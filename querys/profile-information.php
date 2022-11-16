<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
} else {
    include('db.php');
    include('querys/gets.php');
    getDB();

    get_profile_card($con, $_SESSION['idProfile']);

    if (!isset($_SESSION['changeSuggestedFollows']) && $_SESSION['idProfile'] == $_SESSION['user_id']) {
        get_suggeted_follows($con, $_SESSION['user_id']);
    } else {
        unset($_SESSION['changeSuggestedFollows']);
    }

    if ($_SESSION['idProfile'] != $_SESSION['user_id']) {
        get_follow_information($con, $_SESSION['idProfile'], $_SESSION['user_id']);
    }

    get_num_messages($con, $_SESSION['user_id']);

    get_personal_histories($con, $_SESSION['idProfile'], $_SESSION['user_id']);

    closeDB();
}
