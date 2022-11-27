<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
} else {
    $_SESSION['inputText'] = $_GET['text'];
    if ($_GET['historyId'] == -1) {
        unset($_SESSION['selectedHistoryId']);
        unset($_SESSION['selectedHistoryName']);
    } else {
        $_SESSION['selectedHistoryId'] = $_GET['historyId'];
        $_SESSION['selectedHistoryName'] = $_GET['historyName'];
    }
    header('Location: home.php');
    exit;
}
