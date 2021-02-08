<!-- Dejar un Comentario -->
<div class="card-header border-0 font-weight-bold">Dejar un Comentario</div>
<?php
if (isset($_SESSION['Verified'])) {
    if ($_SESSION['Verified'] == 1) {
        echo '
               
        <form action="../../includes/post/commentary-post.inc.php" method="post" class="px-1 mt-4">
             <div class="form-group">
            <label for="replyFormComment">Tu Comentario</label>
            <textarea class="form-control" name="comment" id="replyFormComment" rows="5"></textarea>

            <div class="text-center mt-4">
                <input class="btn btn-primary btn-md" type="submit" value="Comentar" name="send-comment-submit">
            </div>
            <input type="hidden" name="id" value="' . $_GET['id'] . '">
            </div>        
            </form>';
    } else{
        ?>
        <div class="alert alert-warning center">Tu cuenta no esta verificada.</div>
    <?php
    }
} else {
    ?>

    <div class="alert alert-warning center">Regístrate para escribir comentarios.</div>
<?php
}
?>



<?php

$id = $_GET["id"];
$sql = "SELECT * FROM comments_post WHERE post_id='$id' ORDER BY id_commentary DESC";
$result = $conn->query($sql);
echo'<!-- Card header -->
        <div class="card-header border-0 font-weight-bold">Hay <b>'.mysqli_num_rows($result).'</b> comentarios</div>';
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $user_comment = $row["user_commentary"];
        $commentary = $row["commentary"];
        $date = $row["date_comment"];

        echo '<div class="media d-block d-md-flex mt-4">

        <div class="media-body text-center text-md-left ml-md-3 ml-0">
            <h5 class="font-weight-bold mt-0">
                <p class="autor_comment"><span class="author">' . $user_comment . '</span> <span class="date">· '.$date.'</span</p>
            </h5>
           ' . $commentary . '
        </div>
    </div><br>';
    }
    
}else {
    ?>
    <div class="alert alert-info center">Sé el primero en Comentar.</div>
    <br>
<?php
}

?>