<?php
error_reporting(0);
include_once 'php/sessionmanager.php';
include_once 'php/pagesetup.php';
include_once 'php/blogpost.php';
include_once 'php/sqlmanager.php';
anticsrf(0);
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
    // $query = 'delete from posts where id='.$blogId.' AND username='.$uid.' ';
    exequery('delete from posts where id=? and username=?','ss',$blogId,$uid);
    phploc("blogpanel.php?w=view");
} else blogDispId();
pageFoot();