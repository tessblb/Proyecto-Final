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
    <div class="container">
        <!-- Grey with black text -->
        <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="index.php">
                            <img src="music.png" alt = "Tienda Logo" style="width: 40px;" class="rounded-pill">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
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
                        <a class="nav-link active" href="about.php">About</a>
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
        <br><br>
        <h2 class="my-5">About us</h2>
        <p><strong><i>ESLYONE: Where every note begins.</i></strong></p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum enim, minus repudiandae consequatur adipisci soluta consequuntur nisi dolores, in, mollitia ab odio tempore dicta repellendus porro molestias perspiciatis recusandae ex!</p>
        <p>Error amet officia distinctio quos recusandae velit incidunt placeat obcaecati pariatur ratione culpa, eligendi voluptas praesentium hic animi, natus necessitatibus, perspiciatis quae doloribus aut tempora accusantium corrupti ad. Eaque, sint.</p>
        <p>Nemo voluptatem, obcaecati facere ipsum iusto, quo maiores veniam reiciendis sed, architecto repellendus id qui autem aut repudiandae esse. Beatae saepe animi blanditiis atque ratione, explicabo eaque rerum adipisci tenetur!</p>
        <p>Temporibus nemo vitae debitis officia voluptates deserunt eos ipsam molestiae sit libero, eligendi, aliquid repellendus praesentium vel excepturi! Magni, molestias nihil obcaecati nam reprehenderit repellat quia ipsam recusandae accusantium sed.</p>
        <p>Eveniet numquam quia aliquid perferendis dicta unde labore autem qui incidunt aperiam sed quod illo dolorum, velit, quos impedit. Earum ad maiores molestiae aperiam corporis tempora qui odio iure explicabo?</p>
        <p>Molestiae iure quae, odit nisi optio quaerat tenetur! Iure voluptates dolores suscipit recusandae aperiam delectus natus, itaque odio consequuntur voluptate cumque libero dolorem excepturi placeat ipsum sint tempore. Eius, ducimus?</p>
        <p>Facere quaerat iure quia accusantium ipsam omnis non doloribus sit dignissimos amet! Deserunt corporis dolorum minus mollitia dignissimos vitae, harum eligendi temporibus debitis dicta nesciunt. Atque neque asperiores commodi reprehenderit?</p>
        <p>Explicabo similique, sed quasi beatae est necessitatibus expedita quaerat ipsam recusandae dolor odio quisquam impedit quis officia aspernatur dignissimos alias modi veniam nulla magni. Temporibus illo deleniti sit aliquid vel.</p>
        <p>Corrupti pariatur commodi dolorem doloribus sed est, eum nihil assumenda perspiciatis facere ex quidem corporis molestiae provident sequi rem, mollitia voluptatem aut accusamus et autem deserunt! Nihil aut distinctio quisquam!</p>
        <p>Iste, rem illum sed nisi nesciunt quaerat? Sit sed voluptatibus veniam quam, quaerat quae necessitatibus doloremque. Est hic aut totam commodi nemo quos explicabo distinctio quas labore, numquam praesentium dolorum!</p>
        <p>Minima dolorum, tempore cupiditate, eos ut numquam, impedit voluptatum omnis voluptatibus excepturi incidunt accusamus? Odit iure expedita molestias blanditiis nihil repellat numquam? Facere saepe consequuntur, dolores deleniti nesciunt aut tenetur?</p>
        <p>Temporibus impedit, maiores ab similique vitae quaerat aliquam minima, accusantium perferendis iste totam natus consequuntur rem doloremque. Natus, eveniet dolores unde aspernatur dolorem illum assumenda fugit harum amet, reiciendis similique?</p>
        <p>Reprehenderit, ut! Corrupti eum alias ullam necessitatibus expedita tenetur quam hic inventore dolore, tempora architecto excepturi deserunt placeat iste optio itaque nisi dolorum non! Ratione libero non blanditiis in itaque.</p>
        <p>Qui, maxime doloribus, adipisci quia similique illum aliquid, soluta quam nesciunt neque nulla harum vel magnam ut praesentium sint officia voluptate temporibus cum odit veritatis. Quia aut nam repudiandae ducimus?</p>
        <p>Sunt nisi, quas eligendi ex animi et molestiae, laudantium dolore provident praesentium sed minima at alias magni ipsam culpa doloremque, quidem laborum delectus saepe soluta sint corporis doloribus. Amet, est!</p>
        <p>Fuga odit praesentium consequuntur provident at pariatur, corporis saepe deleniti dolor molestias ex, eveniet aperiam harum quo obcaecati atque consequatur reiciendis accusantium assumenda explicabo. Voluptatem sit voluptatibus repudiandae at esse.</p>
        <p>Est ea voluptatem iste voluptatum vel dolores, consectetur sit nisi totam cum aliquid delectus pariatur obcaecati, natus expedita, impedit quo quibusdam laboriosam unde distinctio. Provident officiis placeat hic a sit.</p>
        <p>Perferendis iusto in architecto voluptatem? Vero asperiores similique aperiam ut vel quae recusandae nulla sed officiis deserunt veniam id saepe debitis reprehenderit, quibusdam iure, architecto exercitationem, repudiandae corporis repellat mollitia.</p>
        <p>Nihil dicta repellat doloribus, fugit deleniti error praesentium illo placeat itaque iste molestiae architecto quibusdam nemo neque maiores blanditiis. Cumque laboriosam quod magnam reiciendis commodi blanditiis vero voluptates, doloremque architecto.</p>
        <p>Enim dignissimos voluptatibus maiores ex rerum odio aliquam quod assumenda, voluptas accusantium sed modi atque aliquid sequi iusto obcaecati saepe. Itaque modi soluta possimus saepe aliquid necessitatibus provident. Culpa, exercitationem?</p>
    </div>
    
</body>
</html>