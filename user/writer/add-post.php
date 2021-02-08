<?php
session_start();
if (isset($_SESSION['userId'])) {

    if (($_SESSION['Block']) == 1) {
        header("Location: ../../banned.php");
        die();
    } else if (($_SESSION['UserType']) == "Admin" || ($_SESSION['UserType']) == "Writer") { } else {
        header("Location: ../../index.php");
    }
} else {
    header("Location: ../../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BlogGames - Agregar un Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../../css/bootstrap/MDB/mdb.css">
    <link rel="shortcut icon" href="../../img/games.ico" type="image/x-icon">

    <link rel="stylesheet" href="../../css/writer.css">
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <script src="../../js/jquery-3.3.1.min.js"></script>

    <!--Script Editor de Texto-->
    <script src="../../js/tinymce/js/tinymce/tinymce.js"></script>
    <script>
        tinymce.init({
            selector: "#contenido",
            height: 500,
            width: 600,
            statusbar: false,
            menubar: false,
            language: "es",
            plugins: ["advlist autolink autosave link image lists charmap preview hr anchor spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"],
            toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | cut copy paste | bullist numlist | outdent indent | undo redo | link unlink image media | preview | forecolor backcolor | formatselect",
            toolbar3: "subscript superscript | emoticons",
            toolbar_items_size: 'small',
            content_css: ['//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css', '//www.tinymce.com/css/codepen.min.css']
        });
    </script>

</head>

<body>

    <div class="new-post">
        <div class="atras" id="atras">

            <span><a href="../../index.php">Volver al Indice</a></span>

        </div>

        <!--Inicio sesión-->
        <div class="formulario">
            <form action="../../includes/post/new-post.inc.php" method="post" enctype="multipart/form-data">

                <h2>Agregar un Nuevo Post</h2>
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'error') {
                        echo '<br/><p class="alert alert-warning text-center" role="alert">Error al insertar los datos en la Base de Datos.</p>';
                    }
                    if ($_GET['error'] == 'emptyfields') {
                        echo '<br/><p class="alert alert-warning text-center" role="alert">No dejes campos sin rellenar.</p>';
                    }
                    if ($_GET['error'] == 'notimage') {
                        echo '<br/><p class="alert alert-warning text-center" role="alert">La imagen introducida no tiene un buen formato.</p>';
                    }
                } else if (isset($_GET['succesfully'])) {
                    if ($_GET['succesfully'] == 'created') {
                        echo '<br/><p class="alert alert-success text-center" role="alert">Se ha creado el Post correctamente.</p>';
                    }
                }
                ?>
                <label for="title">Introduce un Título</label>
                <input type="text" name="title" placeholder="Título del Post">

                <label for="description">Descripción del Post</label>
                <textarea name="description" placeholder="Introduce una descripción del Post..."></textarea>

                <label>Subir imágen</label>
                <br>
                <input type="file" name="image">
                <br>
                <br>

                <label for="category">Categoría</label>
                <select name="category">
                    <option value="Rocket League">Rocket League</option>
                    <option value="CounterStrike:GlobalOffensive">CounterStrike:GlobalOffensive</option>
                    <option value="League Of Legends">League Of Legends</option>

                </select>


                <label for="content">Contenido Completo Del Post</label>
                <textarea name="content" id="contenido"></textarea>
                <br>

                <input type="submit" value="Agregar Post" name="new-post-submit">
            </form>


        </div>


    </div>
    </form>

    </div>
    </div>

    <script>
        document.getElementById("atras").onclick = function() {
            window.location.href = "../../index.php";
        };
    </script>
</body>

</html>