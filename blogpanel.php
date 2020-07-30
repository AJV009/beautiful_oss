<?php
include_once 'php/sessionmanager.php';
sessionConfig();
error_reporting(0);
include_once 'php/pagesetup.php';
include_once 'php/blogpost.php';
pageHead('Home');
$opt = $_GET['w'];
if($opt=='view'){
    blogDispId();
} else if ($opt=='add') {
    blogAdd();
} else if ($opt=='edit') {
    blogEdit($_GET['id']);
} else if ($opt=='delete') {
    $blogId = $_GET['id'];
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uid = $_SESSION['uid'];
    $blogId = test_input($blogId);
    $mysqli = new mysqli("localhost","root","","boss");
    $uid = $_SESSION['uid'];
    // $query = 'delete from posts where id='.$blogId.' AND username='.$uid.' ';
    $query = 'delete from posts where id='.$blogId.' ';
    $mysqli -> query($query);
    jsalert("Hi ".$uid.", Post Successfuly deleted!");
    jsloc("blogpanel.php?w=view");
} else blogDispId();
pageFoot();
?>