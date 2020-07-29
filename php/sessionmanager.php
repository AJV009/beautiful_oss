<?php
session_start();
function sessionConfig(){
    if (!isset($_SESSION['canary'])) {
        session_regenerate_id(true);
        $_SESSION['canary'] = [
            'birth' => time(),
            'IP' => $_SERVER['REMOTE_ADDR']
        ];
    }
    if ($_SESSION['canary']['IP'] !== $_SERVER['REMOTE_ADDR']) {
        session_regenerate_id(true);
        foreach (array_keys($_SESSION) as $key) {
            unset($_SESSION[$key]);
        }
        $_SESSION['canary'] = [
            'birth' => time(),
            'IP' => $_SERVER['REMOTE_ADDR']
        ];
    }
    // Regenerate session ID every 1hr:
    if ($_SESSION['canary']['birth'] < time() - 3600) {
        session_regenerate_id(true);
        $_SESSION['canary']['birth'] = time();
    }
}

function sessionClear(){
    foreach (array_keys($_SESSION) as $key) {
        unset($_SESSION[$key]);
    }
}
?>