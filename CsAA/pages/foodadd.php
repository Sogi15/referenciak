<?php
include('../res/config/server.php');
if (!isset($_SESSION['email']) || $_SESSION['rank'] > '2') {
	header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <title>C$-A-A Kasszarendszer</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link rel="shortcut icon" href="https://t31556852.p.clickup-attachments.com/t31556852/e8898ffe-ec8b-4d31-9aaa-f80c66de2a16_medium.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="../res/css/reglogin.css">
</head>
<body>
    <div id="page">
<header>
    <img src="https://t31556852.p.clickup-attachments.com/t31556852/e8898ffe-ec8b-4d31-9aaa-f80c66de2a16_medium.png" alt="C$AA" title="C$AA Kassza"><br>
  </header>
  <form method="post" enctype="multipart/form-data" action="foodadd.php">
    <?php include('../res/config/errors.php'); ?>
    <div class="input-group">
      <label>Étel neve:</label>
      <input type="text" name="foodname">
    </div>
    <div class="input-group">
      <label>Hozzávalók:</label>
      <input type="text" name="ingredients">
    </div>
    <div class="input-group">
      <label>Ár (Forint):</label>
      <input type="number" name="price" value="1" minvalue="1" maxvalue="30000">
    </div>
    <div class="input-group">
    <label>Státusz:</label>
    <select name="status">
    <option value="0">Elérhető</option>
    <option value="1">Inaktív</option>
    </select>
    </div>
    <div class="input-group">
      <label>Kép:</label>
      <input type="file" name="image">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" title="Hozzáadás" name="foodadd">Hozzáadás</button>
      <button type="submit" class="btn" title="Vissza" name="foodback">Vissza</button>
    </div>
</form>
</div>
</body>
</html>