<?php
require 'includes/Header&Footer/header_lol.php';
?>

<section class="my-5">

    <!-- Introducion -->
    <h2 class="h1-responsive font-weight-bold text-center my-5" style="padding-top:20px;">Todos los Posts de <b>League Of Legends</b></h2>
    <!-- Section description -->
    <p class="text-center w-responsive mx-auto mb-5">Aquí podras encontrar los posts relacionados con League Of Legends</p>

    <?php
    require 'includes/dbh.inc.php';


    $sql = "SELECT * FROM post WHERE category_post='League Of Legends' ORDER BY id_post DESC";
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
            echo '
        <!-- Divisor de Articulos-->
        <hr class="my-5">
        <!-- Empieza uno -->
<div class="row">

    <!-- Columna izquierda -->
    <div class="col-lg-5">

        <!-- Imagen -->
        <div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">
            <img class="img-fluid " src="img/Posts/' . $image_post . '" alt="' . $title_post . ' image">';
            if ($category_post == "Rocket League") {
                echo '<a href="html/post/read-more.php?id=' . $id_post . '">';
            } else if ($category_post == "CounterStrike:GlobalOffensive") {
                echo '<a href="html/post/read-more.php?id=' . $id_post . '">';
            } else if ($category_post == "League Of Legends") {
                echo '<a href="html/post/read-more.php?id=' . $id_post . '">';
            }
            echo ' 
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>

    </div>
    <!-- FIN Columna izquierda-->

    <!-- Columna DERECHA -->
    <div class="col-lg-7">

        <!-- Categoria -->';
            if ($category_post == "Rocket League") {
                echo '<a href="RocketLeague.php" class="green-text">';
            } else if ($category_post == "CounterStrike:GlobalOffensive") {
                echo '<a href="CounterStrikeGlobalOffensive.php" style="color: #FF8800;">';
            } else if ($category_post == "League Of Legends") {
                echo '<a href="LeagueOfLegends.php" style="color: #9933CC;">';
            }
            echo ' 
            <h6 class="font-weight-bold mb-3"></i>' . $category_post . '</h6>
        </a>
        <!-- Titulo -->
        <h3 class="font-weight-bold mb-3"><strong>' . $title_post . '</strong></h3>
        <!-- Descripción -->
        <p>' . $description_post . '</p>
        <!-- DATOS USUARIO -->
        <p>by <a><b style="text-transform: capitalize; font-weight: 600;">' . $author_post . '</b></a>, <i>' . $date_post . '</i></p>';
        $sql2 = "SELECT * FROM comments_post WHERE post_id='$id_post'";
        $result_comments = $conn->query($sql2);
        echo '<p class="comment_post">Tiene <span class="weight">' . mysqli_num_rows($result_comments) . '</span> comentarios.</p>';

        echo '<!-- Leer Mas -->';
            if ($category_post == "Rocket League") {
                echo '<a href="html/post/read-more.php?id=' . $id_post . '" class="btn btn-success btn-md">Leer más</a>';
            } else if ($category_post == "CounterStrike:GlobalOffensive") {
                echo '<a href="html/post/read-more.php?id=' . $id_post . '" class="btn btn-warning btn-md">Leer más</a>';
            } else if ($category_post == "League Of Legends") {
                echo '<a href="html/post/read-more.php?id=' . $id_post . '" class="btn btn-secondary btn-md">Leer más</a>';
            }

            echo '
        </div>
        <!-- FIN Columna DERECHA-->

        </div>
        <!-- final -->';
        }
    }

    ?>


</section>


<?php
require 'includes/Header&Footer/footer.php';
?>