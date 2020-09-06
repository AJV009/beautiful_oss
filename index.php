<?php
error_reporting(0);
include_once 'php/sessionmanager.php';
include_once 'php/pagesetup.php';
include_once 'php/blogpost.php';
if(isset($_COOKIE['life'])) $_SESSION['uid'] = $_COOKIE['life'];
pageHead('Home');
blogDisp();
pageFoot();