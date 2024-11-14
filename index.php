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
    <title>Instagram</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .container {
            background-color: #f9f9f9;
        }
        .custom {
            background: linear-gradient(135deg, #6a0dad, #87cefa);
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

    </style>
</head>
<body>
    <!--Contenedor principal de BS5-->
    <div class="container">
        <!-- Grey with black text -->
        <nav class="navbar navbar-expand-sm bg-secondary navbar-dark fixed-top">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="index.php">
                            <img src="music.png" alt = "Tienda Logo" style="width: 40px;" class="rounded-pill">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">Acerca de</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item">
                    <span class="navbar-text text-white me-3">Hola, <?php echo $_SESSION['nombre']; ?>!</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Cerrar Sesión</a>
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
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Provident a ut blanditiis odit voluptatibus magnam incidunt ea rerum! Id sequi quisquam enim totam labore. Quae ratione suscipit perspiciatis aperiam porro.</p>
        <p>Commodi deserunt itaque quasi ratione ullam odit laboriosam ab, corporis dicta ad ipsum non saepe optio sapiente deleniti officia alias mollitia repellendus eius at obcaecati ex et tempore. Sit, quibusdam!</p>
        <p>Maiores animi, sed alias, vitae iusto quia id autem expedita officiis nihil magnam deserunt deleniti provident dolores. Non vero itaque nisi asperiores, quos officiis laborum magnam blanditiis libero, eum doloremque!</p>
        <p>Saepe quia earum officia neque, vero harum minima blanditiis voluptas ex, eveniet cumque? Consequuntur accusamus quis deserunt optio reprehenderit, ex fuga quae nam provident hic consectetur laboriosam officia dolore nobis?</p>
        <p>Omnis repellat maiores vitae ex officiis nesciunt? Suscipit sunt eum ea natus quos reiciendis sint a at, nulla praesentium nobis vitae excepturi sit inventore aliquid autem atque dolorum ut. Consequatur!</p>
        <p>Dignissimos autem odit delectus animi et, placeat consequuntur numquam facere dicta minima quidem officia enim sapiente alias, consequatur aperiam a accusamus quos voluptates minus quod. Hic corrupti tenetur praesentium? Facilis.</p>
        <p>Dicta, aperiam nesciunt repellat totam recusandae molestias debitis aliquam omnis, iusto nemo quidem aut placeat pariatur asperiores labore, aliquid a eaque eum sit accusantium temporibus quod architecto quae id. Voluptatibus?</p>
        <p>Vitae eius porro, velit natus quasi ipsum magni reprehenderit delectus consequatur incidunt debitis rerum minus? Tenetur nam impedit mollitia, quibusdam sit libero ea, excepturi illo adipisci reprehenderit nostrum molestiae aperiam?</p>
        <p>Quasi saepe officiis aliquam consequatur autem, porro, illum incidunt ut pariatur repellat architecto magni libero est facere placeat accusantium molestiae laborum eum ipsam deleniti. Praesentium a soluta ipsa fugiat nostrum?</p>
        <p>Temporibus saepe nam fugiat odio odit voluptatem laudantium perspiciatis adipisci facilis, consequatur illo hic aperiam corporis minus quibusdam. Et laborum fuga inventore ullam minima dignissimos sequi molestiae necessitatibus vitae laboriosam.</p>


    </div>
    
</body>
</html>