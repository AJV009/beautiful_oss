<?php
function anticsrf(...$args){
    if ($args[0]==0 and !isset($_SESSION['token'])) { $_SESSION['token'] = bin2hex(random_bytes(32));
        return $_SESSION['token'];}
    else if ($args[0]==1 and $args[1]==$_SESSION['token'] ) {return TRUE; }
    else if ($args[0]==2) { $_SESSION['token'] = bin2hex(random_bytes(32));
        return $_SESSION['token'];}
        else return FALSE;
}
