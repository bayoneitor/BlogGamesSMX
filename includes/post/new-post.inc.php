<?php
session_start();
require '../dbh.inc.php';
if (isset($_POST['new-post-submit'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $content = $_POST['content'];

    $name_image = $_FILES['image']['name'];
    $temporal_name = $_FILES['image']['tmp_name'];
    $type_archive = $_FILES['image']['type'];

    $destino = "../../img/Posts/" . $name_image;

    $time = date("Y-m-d");

    $username = $_SESSION['username'];

    if (empty($title) || empty($description) || empty($category) || empty($content) || empty($name_image)) {
        header("Location: ../../user/writer/add-post.php?error=emptyfields");
        exit();
    } else {
        if ($type_archive == "image/jpeg" || $type_archive == "image/jpg" || $type_archive == "image/png" || $type_archive == "image/gif") {
            move_uploaded_file($temporal_name, $destino);
        } else {
            header("Location: ../../user/writer/add-post.php?error=notimage");
            exit();
        }
        $sql = "INSERT INTO post (author_post, date_post, category_post, title_post, image_post, description_post, content_post) 
            VALUES ('$username', '$time', '$category', '$title', '$name_image', '$description', '$content' )";
        $result = mysqli_query($conn, $sql);
        
        header("Location: ../../user/writer/add-post.php?succesfully=created");
    }
} else {
    header('Location: ../../user/writer/add-post.php');
}
