<?php
// 404-es hiba oldal
if (isset($_POST['404_back'])) {
    header('location: index.php?page=home');
}
?>
<h1 class="text-danger text-center" style="font-size: 10vw;">404</h1>
<p class="text-center fs-2">Az oldal nem található<br>Kérlek lépj vissza a főoldalra!</p>
<form method="post">
    <input type="submit" value="Vissza" class="btn btn-outline-danger fs-2" name="404_back"
        style="display: block; margin: 0vw auto;">
</form>
<br>