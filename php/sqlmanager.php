<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function exequery($query,...$qargs){
    $cred_store = file_get_contents('./cred.json');
    $creds = json_decode($cred_store,true);
    $mysqli = new mysqli($creds["host"], $creds["user"], $creds["pass"], "boss");
    if(empty($qargs[0])) return $mysqli -> query($query);
    else {
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param(...$qargs);
        $stmt->execute();
        if(preg_match("#select#i",$query)) return $stmt->get_result();
    }
}