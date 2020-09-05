<?php
session_start();
function sessionClear(){
    session_unset(); session_destroy();
    setcookie("bosstime","",time()-31556926);
    unset($_COOKIE['timeboss']);
}
function sessionCheck(){ if(!isset($_SESSION['uid'])) phploc('index.php'); }
function sessionTime(){
    $time = time();
    if(isset($_SESSION['lastact']) && ($time-$_SESSION['lastact'])>1800) {
        session_unset();}
    $_SESSION['lastact'] = $time;
}
sessionTime();
function ck_check() {
    if(isset($_COOKIE['timeboss'])) $_SESSION['uid'] = $_COOKIE['timeboss'];
}
function ck_set() {
    setcookie("bosstime",$_SESSION['uid'],time()+31556926);
}