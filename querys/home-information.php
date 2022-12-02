<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
} else {
    include('db.php');
    include('querys/gets.php');
    getDB();

    get_profile_card($con, $_SESSION['user_id']);
    get_personal_histories($con, $_SESSION['user_id'], $_SESSION['user_id']);
    get_all_users($con, $_SESSION['user_id']);

    if (!isset($_SESSION['changeSuggestedFollows'])) {

        get_suggeted_follows($con, $_SESSION['user_id']);
    } else {
        unset($_SESSION['changeSuggestedFollows']);
    }

    get_home_publications($con, $_SESSION['user_id']);
    get_num_messages($con, $_SESSION['user_id']);

    closeDB();
}
