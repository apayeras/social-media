<?php
include('querys/utilities/check-session.php');
include('querys/utilities/db.php');
include('querys/gets.php');

getDB();

get_profile_card($con, $_SESSION['idProfile']);
get_all_users($con, $_SESSION['user_id']);

if (!isset($_SESSION['changeSuggestedFollows']) && $_SESSION['idProfile'] == $_SESSION['user_id'] || isset($_SESSION['changeFromMessages'])) {
    get_suggeted_follows($con, $_SESSION['user_id']);
    unset($_SESSION['changeFromMessages']);
} else {
    unset($_SESSION['changeSuggestedFollows']);
}

if ($_SESSION['idProfile'] != $_SESSION['user_id']) {
    get_follow_information($con, $_SESSION['idProfile'], $_SESSION['user_id']);
}

get_num_messages($con, $_SESSION['user_id']);
if (isset($_SESSION['selectedHistory'])) {
    get_history_content($con, $_SESSION['idProfile'], $_SESSION['user_id'], $_SESSION['selectedHistory']);
    get_history_publications($con, $_SESSION['idProfile'], $_SESSION['selectedHistory']);
} else {
    get_personal_histories($con, $_SESSION['idProfile'], $_SESSION['user_id']);
    get_user_publications($con, $_SESSION['idProfile']);
}

closeDB();
?>
