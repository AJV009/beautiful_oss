<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function exequery($query,...$qargs){
    
    $mysqli = new mysqli("localhost","xeon","xeonsql01","boss");
    if(empty($qargs[0])) return $mysqli -> query($query);
    else {
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param(...$qargs);
        $stmt->execute();
        if(preg_match("#select#i",$query)) return $stmt->get_result();
    }
}