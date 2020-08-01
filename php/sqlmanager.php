<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function exequery($query,...$qargs){
    $mysqli = new mysqli("localhost","root","","boss");
    if(empty($qargs[0])) return $mysqli -> query($query);
    else {
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param(...$qargs);
        $stmt->execute();
        if(preg_match("(?i)#select#",$query)) return $stmt->get_result();
    }
}