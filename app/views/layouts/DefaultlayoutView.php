<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $_title ?? "Blogosphere" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="180x180" href="./public/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./public/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./public/favicon/favicon-16x16.png">
    <link rel="manifest" href="./public/favicon/site.webmanifest">
    <link rel="stylesheet"  href="./public/css/style.css">
</head>
<body>
<!-- Bloc Header-->
<header>
    <nav class="navbar navbar-expand-lg" style="background-color: #3C4245">
        <div class="container-fluid p-3">
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) { ?>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center fs-2" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto gap-4">
                    <li class="nav-item">
                        <a class="nav-link text-monospace text-light" href="/singleuser&id=1">My home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-monospace text-light" href="/post">Blogo-space</a>
                    </li>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link text-monospace text-light" href="/post&create">Write an article</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link text-monospace text-light" href="/login">Logout</a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link bg-success text-monospace text-light rounded">Hello <?= $_SESSION['username'] ?></div>
                    </li>
                </ul>
            </div>
                <?php
            }
            ?>
        </div>
    </nav>
</header>

<!-- End Bloc Header-->

<!-- Bloc Content -->

<main role="main">
    <?= $pageContent ?? '' ?>
</main>

<!-- End Bloc Content -->

<!-- Bloc Footer-->

<hr>
<div class="my-5">
    <footer>
        <div class="text-center p-3 text-light" style="background-color: #3C4245;">
            Blogorama | © 2023 Copyright:
            <a class="text-light text-decoration-none fw-bold" href="https://killianfilatre.fr">Killian Filâtre </a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                | You are
                <a class="text-light text-decoration-none fw-bold" href="/homeadministrator">Administrator </a>
            <?php
                }
            ?>
        </div>
        <!-- Copyright -->
    </footer>
</div>

<!-- End Bloc Footer-->

<script src="https://kit.fontawesome.com/18e2e0bb4c.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>
</html>