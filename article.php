<?php
include_once 'php/sessionmanager.php';
include_once 'php/pagesetup.php';
include_once 'php/blogpost.php';
include_once 'php/sqlmanager.php';
if(!isset($_GET["id"])){ jsloc('index.php'); }
$blogid = $_GET["id"];
pageHead('Home');
$requests = exequery("select * from posts where id = ?",'s',$blogid);
while ($row=mysqli_fetch_array($requests)) {
    $blog_id=$row['id'];
    $blog_title=$row['title'];
    $blog_author=$row['username'];
    $blog_short=$row['short'];
    $blog_body=$row['body'];
    $blog_created=$row['created_at'];
    echo '
    <section>
        <div class="w3-container w3-yellow w3-card-4 w3-margin w3-round-large">
            <h2 style="display: inline;">🤖'.$blog_title.' </h2><h5 style="display: inline;"> by -📝'.$blog_author.' on 📅'.$blog_created.'</h5>
            <h5>🔰'.$blog_short.'</h5>
            <h4>📝'.$blog_body.'<h4>
        </div>
    </section>
    ';
}
pageMsg('Other Interesting Blogs 🗽');
blogDisp($blogid);
pageFoot();