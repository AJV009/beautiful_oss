<?php
session_start();
// error_reporting(0);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

include_once 'php/sqlmanager.php';

if (isset($_SESSION['lastact']) and time() - $_SESSION['lastact'] > 9000) {
    sessionClear();
    phploc('index.php');
} else $_SESSION['lastact'] = time();

if (isset($_COOKIE['remembering'])) {
    $requests = exequery('select log, username from users where log = ?', 's', $_COOKIE['remembering']);
    if (mysqli_num_rows($requests) > 0) {
        $row = mysqli_fetch_array($requests);
        if (password_verify($row["log"],$_COOKIE['remembering'])){
            $_SESSION['uid'] = $row["username"];
            $_COOKIE['remembering'] = password_hash($row["log"], PASSWORD_ARGON2ID);
        }
        unset($row);
    }
}

if (isset($_SESSION['uid'])) {
    $requests = exequery('select type from users where username = ?', 's', $_SESSION['uid']);
    $row = mysqli_fetch_array($requests);
    if ($row[0] == 'admin') $_SESSION['admin'] = $_SESSION['uid'];
}

function rememberMe()
{
    $keygen = bin2hex(random_bytes(mt_rand(5,10))) . $_SESSION['uid'] . bin2hex(random_bytes(mt_rand(1,5)));
    $key = password_hash($keygen, PASSWORD_ARGON2ID); 
    setcookie('remembering', $key, time() + 31556926);
    exequery('update users set log=? where username=?', "ss", $keygen, $_SESSION['uid']);
    unset($keygen);
}

function sessionClear()
{
    session_unset();
    session_destroy();
    setcookie("remembering", "", time() - 31556926);
    unset($_COOKIE['remembering']);
    session_start();
}
function sessionCheck()
{
    if (!isset($_SESSION['uid'])) phploc('index.php');
}
