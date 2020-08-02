<?php
session_start();
function sessionClear(){ session_unset(); session_destroy(); }
function sessionCheck(){ if(!isset($_SESSION['uid'])) jsloc('index.php'); }
function sesLoggedIn(){
    $_SESSION['logtime'] = time();
    $_SESSION['']

}