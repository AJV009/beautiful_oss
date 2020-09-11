<?php
include_once 'php/sessionmanager.php';
include_once 'php/pagesetup.php';
include_once 'php/blogpost.php';
indexCheck();
pageHead('Home');
blogDisp();
pageFoot();
