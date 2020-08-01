<?php
include_once 'php/sessionmanager.php';
sessionConfig();
include_once 'php/pagesetup.php';
include_once 'php/blogpost.php';
pageHead('Home');
blogDisp();
pageFoot();