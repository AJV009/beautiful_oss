<?php
session_start();
$token=0;
print($token."<br>");
function anticsrf(...$args){
    if ($args[0]==0 && !isset($_SESSION['token'])) { $_SESSION['token'] = bin2hex(random_bytes(32));
        $GLOBALS['token'] = $_SESSION['token'];}
    else if ($args[0]==1 && $args[1]==$_SESSION['token'] ) {return TRUE; unset($_SESSION['token']); }
    else if ($args[0]==2) { $_SESSION['token'] = bin2hex(random_bytes(32));
        $GLOBALS['token'] = $_SESSION['token']; print($GLOBALS['token']."<br>");}
        else return FALSE;
}
anticsrf(0);
anticsrf(1, $token);
?>