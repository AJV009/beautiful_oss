<?php
include_once 'php/sessionmanager.php';
sessionConfig();
error_reporting(0);
include_once 'php/pagesetup.php';
include_once 'php/blogpost.php';
include_once 'php/sqlmanager.php';
sessionCheck();
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
    $uid = $_SESSION['uid'];
    $blogId = test_input($blogId);
    $uid = $_SESSION['uid'];
    // $query = 'delete from posts where id='.$blogId.' AND username='.$uid.' ';
    $query = 'delete from posts where id='.$blogId.' ';
    $GLOBALS['mysqli'] -> query($query);
    jsalert("Hi ".$uid.", Post Successfuly deleted!");
    jsloc("blogpanel.php?w=view");
} else blogDispId();
pageFoot();
?>