<?php
include_once 'php/sessionmanager.php';
include_once 'php/pagesetup.php';
include_once 'php/blogpost.php';
include_once 'php/sqlmanager.php';
sessionCheck();
pageHead('Home');
$opt = $_GET['w'];
if ($opt == 'view') {
    blogDispId();
} else if ($opt == 'add') {
    blogAdd();
} else if ($opt == 'edit') {
    blogEdit($_GET['id']);
} else if ($opt == 'delete') {
    $blogId = $_GET['id'];
    $uid = $_SESSION['uid'];
    $blogId = test_input($blogId);
    // $query = 'delete from posts where id='.$blogId.' AND username='.$uid.' ';
    if (isset($_SESSION['admin'])) exequery('delete from posts where id=?', 's', $blogId);
    else exequery('delete from posts where id=? and username=?', 'ss', $blogId, $uid);
    phploc("blogpanel.php?w=view");
} else blogDispId();
pageFoot();
