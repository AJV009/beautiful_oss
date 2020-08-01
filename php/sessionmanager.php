<?php
session_start();
function sessionConfig(){
    if(!isset($_SESSION['ip'])) $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    if ($_SESSION['ip'] !== $_SERVER['REMOTE_ADDR']) {
        sessionClear(); $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    }
}
function sessionClear(){ session_unset(); session_destroy(); }
function sessionCheck(){ if(!isset($_SESSION['uid'])) jsloc('index.php'); }