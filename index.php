<?php
require 'includes/Header&Footer/header.php';
?>


<section class="my-5">

    <!-- Introducion -->
    <h2 class="h1-responsive font-weight-bold text-center my-5" style="padding-top:20px;">Posts Recientes</h2>
    <!-- Section description -->
    <p class="text-center w-responsive mx-auto mb-5">Aquí podras encontrar los ultimos 5 posts de todo el Blog</p>

    <?php
    include("includes/show-post.inc.php");
    ?>



   




</section>



<?php
require 'includes/Header&Footer/footer.php';
?>