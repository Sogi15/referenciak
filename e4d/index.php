<?php
if (isset($_GET['page'])) 
{
  $page = $_GET['page']; 
}
else 
{
  $page = "home";
}
include('config/server.php');
if (!isset($_SESSION['email'])) {
header('Location: page/login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header('Location: page/login.php');
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English 4 Dummies</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="res/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="res/logo.png" type="image/x-icon">
</head>
<body class="bg-image" 
     style="background-image: url('res/logo.png');
            background-position: middle-top;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;"
            >
    <div class="container page">
        <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php" title="Főoldalra"><b class="h2">English 4 Dummies</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">&#9776;</span>
        </button>
        <div class="collapse navbar-collapse" 
            id="navbarNavAltMarkup">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ml-auto">
            <li class="nav-item">
            <a class="nav-link active js-scroll-trigger" 
                href="index.php?page=tesztek">Tesztek</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" 
                href="index.php?page=alapfok">Alapfok</a>
            </li>

            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" 
                href="index.php?page=kozepfok">Középfok</a>
            </li>

            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" 
                href="index.php?page=felsofok">Felsőfok</a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger"  href="index.php?logout=1">Kijelentkezés</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <article>
         <?php pageContent($page); ?>
    </article>
    <footer class="text-center text-lg-start container-fluid mb-2">
  <div class="text-center p-3">
    © 2023 Szunyogh Attila
  </div>
</footer>
    </div>
</body>
</html>