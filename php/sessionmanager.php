<?php
session_start();
function sessionClear(){ session_unset(); session_destroy(); }
function sessionCheck(){ if(!isset($_SESSION['uid'])) phploc('index.php'); }
function sessionTime(){
    $time = time();
    if(isset($_SESSION['lastact']) && ($time-$_SESSION['lastact'])>1800) {
        session_unset();}
    $_SESSION['lastact'] = $time;
}
sessionTime();
function ck_set() {
    
}
function ck_unset() {

}