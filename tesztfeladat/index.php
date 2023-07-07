<?php
// forrás php-k behívása.
include_once('res/php/pageContent.php');
require('res/php/server.php');

// page változó az oldalak betöltéséhez.
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "home";
}
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EM Frontend + PHP feladat - Szunyogh Attila</title>
    <link rel="stylesheet" href="res/css/style.css">
    <link rel="stylesheet" href="res/bootstrap-5.3.0-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="res/img/favicon.png" type="image/x-icon">
</head>

<body class="bg-light">
    <div id="page">
        <div class="container-fluid p-0 m-0">
            <header class="image-container position-relative">
                <img src="res/img/header.jpeg" class="w-100" alt="Fejléc">
                <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column">
                    <h1 class="position-absolute text-white">Egy tetszőleges kérdőív</h1>
                    <p class="position-absolute  text-white">Előzetes kérdőív egy bizonyos szolgáltatás nyújtásához</p>
                </div>
            </header>
            <article>
                <div class="divbox">
                    <?php pageContent($page); // page oldal betöltése?>
                </div>
                <footer>
                    <p class="tx-def">
                        Suspendisse congue aliquam viverra. Integer ex ipsum, rutrum et gravida quis, tempor sed sem.
                        Maecenas sagittis ligula sed ultrices ultricies. Praesent id commodo orci, facilisis congue
                        tortor.
                        Donec feugiat mi in tincidunt cursus. Sed vitae diam vel eros cursus gravida. Proin tempor
                        accumsan
                        facilisis. Nam augue velit, pulvinar a lectus vitae, congue facilisis velit. Morbi commodo,
                        mauris
                        at suscipit auctor, lacus libero condimentum libero, vel maximus dui tortor in tortor. Nulla
                        laoreet
                        consectetur est, sit amet mollis justo. Suspendisse porta, elit et efficitur auctor, risus
                        mauris
                        tempus ipsum, at lobortis ex augue ut neque. Praesent eget est urna. Morbi efficitur enim urna,
                        id
                        tincidunt quam sodales nec.
                    </p>
                </footer>
            </article>
        </div>
    </div>
</body>
<script src="res/js/button.js"></script>
<script src="res/js/dragdrop.js"></script>
<script src="res/js/slider.js"></script>
<script src="res/bootstrap-5.3.0-dist/js/bootstrap.min.js"></script>

</html>