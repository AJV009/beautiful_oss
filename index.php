<?php
error_reporting(0);
include_once 'php/sessionmanager.php';
include_once 'php/pagesetup.php';
include_once 'php/blogpost.php';
pageHead('Home');
blogDisp();
pageFoot();