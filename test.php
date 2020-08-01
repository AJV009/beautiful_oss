<?php
function exequery($query,...$qargs){
    $mysqli = new mysqli("localhost","root","","boss");
    if(empty($qargs[0])) return $mysqli -> query($query);
    else {
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param(...$qargs);
        $stmt->execute();
        if(preg_match("#select#i",$query)) return $stmt->get_result();
    }
}
$title="Testing101";
$content="AKDNFLjasnadjnfjiqwenfjiadnflkasfkfmwemf";
$uid="AJV009";
$short="This is crazy";
$current_date = date("Y-m-d");
exequery("insert into posts (title, body, username, short, created_at) values (?,?,?,?,?)",'sssss',$title,$content,$uid,$short,$current_date);
?>