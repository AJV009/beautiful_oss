<?php
session_start();
if(isset($_COOKIE['bosstime'])) $_SESSION['uid'] = $_COOKIE['bosstime'];
if(isset($_SESSION['lastact']) AND time() - $_SESSION['lastact'] > 9000) {
    sessionClear();
    phploc('index.php');
} else $_SESSION['lastact'] = time();

function sessionClear(){
    session_unset(); session_destroy();
    setcookie("bosstime","",time()-31556926);
    unset($_COOKIE['life']);
    unset($_COOKIE['bosstime']);
}
function sessionCheck(){ if(!isset($_SESSION['uid'])) phploc('index.php'); }
