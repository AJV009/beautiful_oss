<?php
include_once 'php/sessionmanager.php';
sessionConfig();
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
    blogDelete($_GET['id']);
} else blogDispId();
pageFoot();
?>