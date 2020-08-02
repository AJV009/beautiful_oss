<?php
$token=0;
function anticsrf($flag=3,$posttoken='0'){
    if ($flag==0 & !isset($_SESSION['token'])) { $_SESSION['token'] = bin2hex(random_bytes(32));
        $GLOBALS['token'] = $_SESSION['token']; }
    else if ($flag==1 & hash_equals($_SESSION['token'], $posttoken) ) {return TRUE; unset($_SESSION['token']); }
    else if ($flag==2) { $_SESSION['token'] = bin2hex(random_bytes(32));
        $GLOBALS['token'] = $_SESSION['token']; }
        else return FALSE;
}
?>