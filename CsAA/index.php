<?php
include "res/config/server.php";
include "res/config/config.php";
$id = $_SESSION["id"];
$workstartedM = $_SESSION["startworkM"];
$workstartedH = $_SESSION["startworkH"];
if (!isset($_SESSION['email'])) {
header('Location: pages/login.php');
}
$rank = $_SESSION['rank'];
if (isset($_GET['logout'])) {
    $query = "SELECT workedtime FROM user_details WHERE userid='$id'";
    $endworkM = date("i");
    $endworkH = date("H");
    $endwork = ($endworkH*60) + $endworkM;
    $workstart = ($workstartedH*60) + $workstartedM;
    $workedtime = $workstart - $endwork;
    $results = mysqli_query($db, $query);
    if ($results->num_rows > 0) {
        while($row = $results->fetch_assoc()) {
          $oldtime = $row["workedtime"];
          if($workedtime < 0)
          {
              $workedtime = $workedtime * -1;
          }
          $worktime = $oldtime + $workedtime;
          $query = "UPDATE `user_details` SET `workedtime` = '$worktime' WHERE `user_details`.`userid` = '$id'";
          if ($db->query($query) === TRUE)
          {
          session_destroy();
          unset($_SESSION['email']);
          header('Location: pages/login.php');
          }
        }
      }
}
if (isset($_GET['page'])) 
{
  $page = $_GET['page']; 
}
else 
{
  $page = "home";
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="https://t31556852.p.clickup-attachments.com/t31556852/e8898ffe-ec8b-4d31-9aaa-f80c66de2a16_medium.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="res/css/style.css">
    <title>C$-A-A Kasszarendszer</title>
    <script src="res/js/clock.js" type="text/javascript"></script>
</head>
<body>
    <div id="page">
        <main>
<header>
    <h1>C<span class="lgreen">$</span>-A-A Kasszarendszer</h1>
</header>
<div id="content">
<nav>
    <div id="menu" class="mnone">
    <ul>
        <li  id="fhome">
            <img src="https://t31556852.p.clickup-attachments.com/t31556852/e8898ffe-ec8b-4d31-9aaa-f80c66de2a16_medium.png" alt="C$-A-A Kasszarendszer" Title="C$-A-A Logó">
        </li>
        <li>
            <a href="index.php?page=home" title="Főoldalra lépés">Főoldal</a>
        </li>
        <li>
            <a href="index.php?page=user" title="Profil megtekintése">Profil</a>
        </li>
        <li>
            <a href="index.php?page=workday" title="Beosztásod lekérdezése">Munkarend</a>
        </li>
        <li>
            <a href="index.php?page=contact" title="Vezetőség elérhetősége">Elérhetőségek</a>
        </li>
        <li>
            <a href="index.php?page=story" title="Az étterem története">Történet</a>
        </li>
        <li>
            <a href="index.php?page=food" title="Ételek adatai">Étlap</a>
        </li>
        <?php 
        if($rank <= 2)
        {
        echo '<li>
        <a href="index.php?page=workers" title="Dolgozók listája">Dolgozók</a>
        </li>';
        }
        ?>
        <li>
            <a href="index.php?logout=1" title="Kijelentkezés a fiókból">Kijelentkezés</a>
        </li>
        <li>
            <p id="time"></p>
        </li>
</ul>
</div>
<div class="mdis">
    <table id="mobilmenu">
        <tr>
            <td><a href="index.php?page=home" title="Főoldalra lépés">Főoldal</a></td>
            <td><a href="index.php?page=user" title="Profil megtekintése">Profil</a></td>
            <td><a href="index.php?page=workday" title="Beosztásod lekérdezése">Munkarend</a></td>
            <?php
                    if($rank <= 2)
                    {
                        echo '<td><a href="index.php?page=workers" title="Dolgozók listája">Dolgozók</a></td>';
                        $colspan_m = 4;
                    }
                    else {
                        echo '<td rowspan="2"><a href="index.php?logout=1" title="Kijelentkezés a fiókból">Kijelentkezés</a></td>';
                        $colspan_m = 4;
                    }
            ?>
        </tr>
        <tr>
            <td><a href="index.php?page=contact" title="Vezetőség elérhetősége">Elérhetőségek</a></td>
            <td><a href="index.php?page=story" title="Az étterem története">Történet</a></td>
            <td><a href="index.php?page=food" title="Ételek adatai">Étlap</a></td>
            <?php 
            if($rank <= 2) {
            echo '<td><a href="index.php?logout=1" title="Kijelentkezés a fiókból">Kijelentkezés</a></td>';}
            ?> 
        </tr>
        <tr>
            <td colspan="<?php echo $colspan_m; ?>"><p id="time_m"></p></td>
        </tr>
    </table>
    </div>
</nav>
<article>
    <?php pageContent($page); ?>
</article>
</div>
<footer>
    C<span class="lgreen">$</span>-A-A kft. ©
</footer>
</main>
</div>
</body>
</html>