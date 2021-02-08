<?php
session_start();
if (isset($_SESSION['userId'])) {

    if ($_SESSION['Block'] == 1) {
        header("Location: banned.php");
        die();
    } else { }
}


//$_SESSION['userUid'] = $row['uidUsers'];
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="descripcion de la pagina">
    <meta name="keyword" contenet="palabras claves">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogGames</title>
    <link rel="shortcut icon" href="img/games.ico" type="image/x-icon">
    <!--CSS-->
    <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/MDB/mdb.css">
    <link rel="stylesheet" href="css/style.css">
    <!--FontAwesome-->
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <!--Scripts-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap/bootstrap.bundle.js"></script>
    <script src="js/bootstrap/bootstrap.js"></script>



</head>

<body>
    <!--Carousel Wrapper-->
    <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
        <!--Indicators-->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-2" data-slide-to="1"></li>
            <li data-target="#carousel-example-2" data-slide-to="2"></li>
        </ol>
        <!--/.Indicators-->
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="view">
                    <img class="d-block w-100" src="img/Barra/3.gif" alt="First slide">
                    <div class="mask rgba-black-strong d-none d-md-block"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive">CS:GO</h3>
                    <p>Es el cuarto juego de la saga Counter-Strike, sin contar Counter-Strike: Online.</p>
                </div>
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="img/Barra/1.gif" alt="Second slide">
                    <div class="mask rgba-black-strong d-none d-md-block"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive">League Of Legends</h3>
                    <p>Es un videojuego del juego de género Videojuego multijugador de arena de batalla en línea y deporte electrónico.</p>
                </div>
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="img/Barra/2.gif" alt="Third slide">
                    <div class="mask rgba-black-strong d-none d-md-block"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive">Rocket League</h3>
                    <p>Es un videojuego que combina el fútbol con los vehículos.</p>
                </div>
            </div>
        </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <!--/.Controls-->
    </div>


    <!--Navegador-->
    <nav style="background-color: #6351ce;" class="mb-1 navbar sticky-top navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">BlogGames</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Principio
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="CounterStrikeGlobalOffensive.php">CS:GO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="LeagueOfLegends.php">League of Legends</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="RocketLeague.php">Rocket League</a>
                </li>
                <?php
                if (isset($_SESSION['userId'])) { }
                ?>


            </ul>
            <!-- REGISTRADO O SIN REGISTRAR-->
            <?php
            if (isset($_SESSION['userId'])) {
                echo '<ul class="navbar-nav ml-auto nav-flex-icons">';
                if ($_SESSION['UserType'] == "Admin" || $_SESSION['UserType'] == "Writer") {
                    echo '<li class="nav-item">
                            <a href="user/writer/add-post.php" class="btn btn-outline-white btn-sm">Crear un Post</a>
                        </li>';
                }
                echo '<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i><span style="padding-left: 10px; text-transform: capitalize;">' . $_SESSION['username'] . '</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">';
                if ($_SESSION['UserType'] == "Admin") {
                    echo ' <a class="dropdown-item" href="admin-panel/panel.php">Panel de Administrador</a>';
                }
                echo ' <a class="dropdown-item" href="#">Configuración</a>
                    <a class="dropdown-item" href="includes/logout.inc.php">Cerrar Sesion</a>
                </div>
            </li>
        </ul>';
            } else {
                echo '<ul class="navbar-nav ml-auto nav-flex-icons white-text">
                <li class="list-inline-item">
                  <a href="signup.php" class="btn btn-outline-white btn-sm">¡Registrate!</a>
                </li>
              </ul>';
            }
            ?>
        </div>
    </nav>
    <!--/.Navbar -->