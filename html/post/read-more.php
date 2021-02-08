<?php
require '../Header&Footer/header.php';
?>


<?php
require '../../includes/dbh.inc.php';

$id = $_GET["id"];
$sql = "SELECT * FROM post WHERE id_post='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {


    while ($row = $result->fetch_assoc()) {
        $id_post = $row["id_post"];
        $author_post = $row["author_post"];
        $date_post = $row["date_post"];
        $category_post = $row["category_post"];
        $title_post = $row["title_post"];
        $image_post = $row["image_post"];
        $description_post = $row["description_post"];
        $content_post = $row["content_post"];
        echo '<section class="my-5">

            <!-- Titulo -->
            <h2 class="h1-responsive font-weight-bold text-center my-5" style="padding-top:20px;">' . $title_post . '</h2>
            <!-- Imagen -->
            <img class="center-img rounded" width="500px "src="../../img/Posts/' . $image_post . '" alt="' . $title_post . ' image">
            <!-- Contenido -->
            <div class="content">
             ' . $content_post . '
             </div>
             <div class="autor">Creado por: <span>'.$author_post.'</span>, en el <i>'.$date_post.'</i> </br> Categoria: '.$category_post.'</div>
             
            ';
    }
}

?>
<hr class="my-5">
<br>
<?php 
require '../Header&Footer/commentary.php';
?>
</section>
<?php
require '../Header&Footer/footer.php';
?>