<?php

if (isset($_POST['send-comment-submit'])) {
    require '../dbh.inc.php';
    session_start();
$username = $_SESSION['username'];
$comment = $_POST['comment'];
$id = $_POST['id'];
$day = date("Y-m-d");
$hour = date("H:i:s");
$date_comment = $day ." a las ". $hour;
$sql = "INSERT INTO comments_post (post_id, user_commentary, commentary, date_comment) 
            VALUES ('$id', '$username', '$comment', '$date_comment')";
        $result = mysqli_query($conn, $sql);
        
        header('Location: ../../html/post/read-more.php?id='.$id.'');

} else {
    header('Location: ../../index.php');
}