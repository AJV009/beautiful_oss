<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$mysqli = new mysqli("localhost","root","","boss");
function exequery($query){
    $mysqli = new mysqli("localhost","root","","boss");
    // TODO: SQL Injection Safe Query Builder and executer.
}
?>