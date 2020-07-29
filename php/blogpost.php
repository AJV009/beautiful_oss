<?php
/*
blogDisp() - display all blogs from the db on the home page!
*/
function blogDisp(){
    $mysqli = new mysqli("localhost","root","","boss");
    $query = "select * from posts order by id desc";
    $requests = $mysqli -> query($query);
    while ($row=mysqli_fetch_array($requests)) {
        $blog_id=$row['id'];
        $blog_title=$row['title'];
        $blog_author=$row['username'];
        $blog_short=$row['short'];
        $blog_created=$row['created_at'];
        echo '
        <section>
            <a href="article.php?id='.$blog_id.'">
            <div class="w3-container w3-blue w3-card-4 w3-margin w3-round-large">
                <h3 style="display: inline;">'.$blog_title.' </h3><h6 style="display: inline;"> by - '.$blog_author.' on '.$blog_created.'</h6>
                <h5>'.$blog_short.'</h5>
            </div>
            <a>
        </section>
        ';
    }
}
?>