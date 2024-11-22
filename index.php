<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Epsylone</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .container {
            background-color: #f9f9f9;
        }
        .custom {
            background: linear-gradient(135deg, #8B4513, #D2B48C);
            color: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; 
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }

        h2 {
            text-align: center;
        }
        h3 {
            text-align: center;
        }

        .image {
            -moz-transition: opacity 0.25s ease-in-out;
            -webkit-transition: opacity 0.25s ease-in-out;
            -ms-transition: opacity 0.25s ease-in-out;
            transition: opacity 0.25s ease-in-out;
            display: inline-block;
            border: solid 6px #ebebeb !important;
        }

        .image:hover {
            opacity: 0.9;
        }

        .image img {
            display: block;
            width: 100%;
        }

        .image.fit {
            display: block;
            width: 100%;
        }

        .image.featured {
            display: block;
            width: 100%;
            margin: 0 0 3.5em 0;
        }

        .image.left {
            float: left;
            margin: 0 1.5em 1.5em 0;
            position: relative;
            top: 0.5em;
        }

        .image.centered {
            display: block;
            margin: 0 0 2em 0;
        }

        .image.centered img {
            margin: 0 auto;
            width: auto;
        }

        .navbar {
            background-color: #8f8787;
        }
        .btn-custom {
            background-color: #8B4513;
            color: white;
            border: none;
            padding: 8px 15px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #6a3e19;
        }
    </style>
</head>
<body>
    <!--Contenedor principal de BS5-->
    <class="container">
        <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="index.php">
                            <img src="music.png" alt = "Tienda Logo" style="width: 40px;" class="rounded-pill">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Shop</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="guitar.php">Guitars</a></li>
                            <li><a class="dropdown-item" href="piano.php">Pianos</a></li>
                            <li><a class="dropdown-item" href="drums.php">Drums</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item">
                    <span class="navbar-text text-white me-3">Hello, <?php echo $_SESSION['nombre']; ?>!</span>
                </li>
                <form class="d-flex" action="buscar.php" method="GET">
                    <input class="form-control me-2" type="text" name="nombre" placeholder="Search">
                    <button class="btn btn-custom" type="submit">Search</button>
                </form>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Close Session</a>
                </li>
                </ul>
            </div>
        </nav>
        <br><br><br>
        <div class = "custom">
            <h1>EPSYLONE</h1>
        </div>
        <br><br>
        <h2>Espylone: Where every note begins.</h2>
        <h3>Your destination for quality musical instruments and inspiration.</h3><br><br>
        <!-- Features -->   
        <section id="features">
            <div class="container">
                <header>
                    <h2>Take a look at our <strong>featured products</strong> !</h2>
                </header>
                <div class="row aln-center">
                    <div class="col-4 col-6-medium col-12-small">
                        <!-- Feature -->
                        <section>
                            <a href="guitar.php" class="image featured .img-fluid"><img src="pic01.jpg" alt=""></a>
                            <header>
                                <h3>Guitar/Bass</h3>
                            </header>
                            <p><strong>Guitar & Bass:</strong> iconic sound, timeless design, and unmatched quality for every musician.</p>
                        </section>
                    </div>

                    <div class="col-4 col-6-medium col-12-small">
                        <!-- Feature -->
                        <section>
                            <a href="piano.php" class="image featured .img-fluid"><img src="pic02.jpg" alt=""></a>
                            <header>
                                <h3>Piano</h3>
                            </header>
                            <p><strong>Yamaha Pianos:</strong> elegant craftsmanship, exceptional tone, and performance for all musicians.</p>
                        </section>
                    </div>

                    <div class="col-4 col-6-medium col-12-small">
                        <!-- Feature -->
                            <section>
                                <a href="drums.php" class="image featured"><img src="pic03.jpg" alt="" /></a>
                                <header>
                                    <h3>Drums</h3>
                                </header>
                                <p><strong>Drums</strong> versatile sound, solid build, and unbeatable value for every player.</p>
                            </section>
                    </div>
                </div>
            </div>
        </section><br><br><br>

    </div>
    
</body>
</html>
