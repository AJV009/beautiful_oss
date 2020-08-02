<?php
$token=0;
function anticsrf($flag=3){
    if ($flag==0 & !isset($_SESSION['token'])) { $_SESSION['token'] = bin2hex(random_bytes(32));
        $GLOBALS['token'] = $_SESSION['token']; }
    if ($flag==1 & hash_equals($_SESSION['token'], $_POST['token']) ) return TRUE;
    else return FALSE;
    if ($flag==2) { $_SESSION['token'] = bin2hex(random_bytes(32));
        $GLOBALS['token'] = $_SESSION['token']; }
}
?>