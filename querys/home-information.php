<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
} else {
    include('db.php');
    include('querys/gets.php');
    getDB();

    get_profile_card($con, $_SESSION['user_id']);

    if (!isset($_SESSION['changeSuggestedFollows'])) {

        get_suggeted_follows($con, $_SESSION['user_id']);
    } else {
        unset($_SESSION['changeSuggestedFollows']);
    }

    get_num_messages($con, $_SESSION['user_id']);

    closeDB();
}
