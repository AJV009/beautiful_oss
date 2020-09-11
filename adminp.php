<?php
include_once 'php/sessionmanager.php';
include_once 'php/pagesetup.php';
if(!isset($_SESSION['admin'])) phploc("index.php");
pageHead('Admin Home');
pageMsg("Your Super Special Admin Panel! ⚠️⚠️⚠️");
pageMsg("To edit or delete someone's post, you can just navigate to ' 📖 Read your articles' BUT do so with care! ⚠️⚠️⚠️");
// TODO: Update, Delete, Switch Right
// TODO: Delete Account option for the user
// TODO: Remove reduntant code, modularize it, make it more small
// TODO: Rewrite css from scratch, move local css modification into a different file
pageFoot();
