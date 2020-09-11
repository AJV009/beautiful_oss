<?php
session_start();
error_reporting(0);
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

include_once 'php/sqlmanager.php';

if (isset($_COOKIE['bosstime']) AND isset($_COOKIE['remembering'])) {
    $requests = exequery('select log from users where username = ?', 's', $_COOKIE['bosstime']);
    $row = mysqli_fetch_array($requests);
    if ($row[0] == $_COOKIE['remembering']) $_SESSION['uid'] = $_COOKIE['bosstime'];
}

if (isset($_SESSION['lastact']) and time() - $_SESSION['lastact'] > 9000) {
    sessionClear();
    phploc('index.php');
} else $_SESSION['lastact'] = time();

if (isset($_SESSION['uid'])) {
    $requests = exequery('select type from users where username = ?', 's', $_SESSION['uid']);
    $row = mysqli_fetch_array($requests);
    if ($row[0] == 'admin') $_SESSION['admin'] = $_SESSION['uid'];
}

function indexCheck()
{
    if (isset($_COOKIE['life'])) {
        $_SESSION['uid'] = $_COOKIE['life'];
        setcookie("life", "", time() - 31556926);
        unset($_COOKIE['life']);
        setcookie('remembering', bin2hex(random_bytes(50)), time() + 31556926);
        exequery('update users set log=? where username=?', "ss", $_COOKIE['remembering'], $_SESSION['uid']);
    }

}

function sessionClear()
{
    session_unset();
    session_destroy();
    session_regenerate_id(true);
    setcookie("bosstime", "", time() - 31556926);
    setcookie("remembering", "", time() - 31556926);
    setcookie("life", "", time() - 31556926);
    unset($_COOKIE['life']);
    unset($_COOKIE['remembering']);
    unset($_COOKIE['bosstime']);
    session_start();
}
function sessionCheck()
{
    if (!isset($_SESSION['uid'])) phploc('index.php');
}
