<?php
/*
blogDisp() - display all blogs from the db on the home page!
blogDispId() - display blogs based on ID
blogAdd() - add blogs
blogEdit() - edit blog
blogDelete() - delete blog
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

function blogDispId(){
    $mysqli = new mysqli("localhost","root","","boss");
    $uid = $_SESSION['uid'];
    $query = "select * from posts where username ='".$uid."'";
    $requests = $mysqli -> query($query);
    if(empty($requests)){
        pageMsg("You got no blog post till now! Why dont you try writing one? Click on 'Add' on the top-right corner!");
    }
    else {
        while ($row=mysqli_fetch_array($requests)) {
            $blog_id=$row['id'];
            $blog_title=$row['title'];
            $blog_short=$row['short'];
            $blog_created=$row['created_at'];
            echo '
            <section>
                <div class="w3-container w3-light-green w3-card-4 w3-margin w3-round-large">
                    <h2 style="display: inline;">'.$blog_title.' </h2><h5 style="display: inline;"> created on '.$blog_created.'</h5>
                    <h5>'.$blog_short.'</h5>
                    <a href= "article.php?id='.$blog_id.'"  class="w3-btn w3-green w3-margin">View</a>
                    <a href= "blogpanel.php?w=edit&id='.$blog_id.'"  class="w3-btn w3-green w3-margin">Edit</a>
                    <a href= "blogpanel.php?w=delete&id='.$blog_id.'"  class="w3-btn w3-green w3-margin">Delete</a>
                </div>
            </section>
            ';
        }
    }
}

function blogAdd(){
    $mysqli = new mysqli("localhost","root","","boss");
    $uid = $_SESSION['uid'];
    ?>
    <section>
        <div class="w3-container " style="margin-top:1%">
			<div class="w3-card-4 w3-round-xxlarge w3-sand w3-center" style="margin-left:10%; margin-right:10%">
 				<h4>Add your new blog post!</h4>
 				<form class="w3-container" method="post" action=" ">
                    <h4 class="w3-left w3-margin-left">Title</h4>
                        <input class="w3-input w3-border w3-round-large" type="text" name="title" required>
                    <h4 class="w3-left w3-margin-left">Short Description</h4>
                        <input class="w3-input w3-border w3-round-large" type="text" name="short" required>
                    <h4 class="w3-left w3-margin-left">Main Content</h4>
                        <textarea class="w3-input w3-border w3-round-large" type="textarea" name="content" required></textarea>
    				<input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="Make Post" name="insertPost">
                 </form>
            </div>
        </div>
    </section>
    <?php
    $title = $short = $description = "";
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if( isset( $_POST['insertPost'] ) ){
            $title = test_input($_POST["title"]);
            $short = test_input($_POST["short"]);
            $content = test_input($_POST["content"]);
            $query = 'select * from posts where title = "'.$title.'"';
            $requests = $mysqli -> query($query);
            if(mysqli_num_rows($requests)<=0){
                $current_date = date("Y-m-d");
                $query = 'insert into posts (title, body, username, short, created_at) values ("'.$title.'","'.$content.'","'.$uid.'","'.$short.'","'.$current_date.'")'; 
                $mysqli -> query($query);
                jsalert("Hi ".$uid.", Post Successfuly created!");
                jsloc("blogpanel.php?w=view"); }
            else {
                jsalert("Title should be unique!"); jsloc("index.php");
            }
        }
    }
}

function blogEdit($blogId){
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $blogId = test_input($blogId);
    $mysqli = new mysqli("localhost","root","","boss");
    $uid = $_SESSION['uid'];
    $query = 'select * from posts where id = "'.$blogId.'" and username = "'.$uid.'"';
    $requests = $mysqli -> query($query);   
    print_r($requests);
    $row=mysqli_fetch_array($requests); 
    if(empty($row)){
        jsloc("index.php");
    }
    echo '
    <section>
        <div class="w3-container " style="margin-top:1%">
			<div class="w3-card-4 w3-round-xxlarge w3-sand w3-center" style="margin-left:10%; margin-right:10%">
 				<h4>Edit your blog post!</h4>
 				<form class="w3-container" method="post" action=" ">
                    <h4 class="w3-left w3-margin-left">Title</h4>
                        <input class="w3-input w3-border w3-round-large" type="text" value="'.$row['title'].'" name="title" required>
                    <h4 class="w3-left w3-margin-left">Short Description</h4>
                        <input class="w3-input w3-border w3-round-large" type="text" value="'.$row['short'].'" name="short" required>
                    <h4 class="w3-left w3-margin-left">Main Content</h4>
                        <textarea class="w3-input w3-border w3-round-large" type="textarea" name="content" required>"'.$row['body'].'"</textarea>
    				<input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="Update Post" name="insertPost">
                 </form>
            </div>
        </div>
    </section>
    ';
    $title = $short = $description = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if( isset( $_POST['insertPost'] ) ){
            $title = test_input($_POST["title"]);
            $short = test_input($_POST["short"]);
            $content = test_input($_POST["content"]);
            $query = 'update posts set title="'.$title.'", body="'.$content.'", short="'.$short.'" where id='.$blogId.' and username="'.$uid.'"';
            $mysqli -> query($query);
            jsalert("Hi ".$uid.", Post Successfuly edited!");
            jsloc("blogpanel.php?w=view"); 
        }
    }
}
?>