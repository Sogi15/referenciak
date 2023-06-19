<?php
include('../res/config/server.php');
include('../res/config/config.php');
// ha nem egy minimum 1-2 (tulaj/üzletvezető van bejelentkezve s valamilyen formában erre az oldalra lép akkor login.php-re vezeti) 
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
    <img src="https://t31556852.p.clickup-attachments.com/t31556852/e8898ffe-ec8b-4d31-9aaa-f80c66de2a16_medium.png" alt="C$-A-A" title="C$-A-A Kassza"><br>
  </header>
  <form method="post" action="register.php">
  	<?php include('../res/config/errors.php'); ?>
  	<div class="input-group">
  	  <label>Keresztnév:</label>
  	  <input type="text" name="fname" placeholder="Keresztnév">
  	</div>
  	<div class="input-group">
  	  <label>Vezetéknév:</label>
  	  <input type="text" name="lname" placeholder="Vezetéknév">
  	</div>
	  <div class="input-group">
  	  <label>Születési idő:</label>
  	  <input type="date" name="age">
  	</div>
  	<div class="input-group">
  	  <label>Jelszó:</label>
  	  <input type="password" name="pass" placeholder="Jelszó">
  	</div>
  	<div class="input-group">
  	  <label>E-Mail:</label>
  	  <input type="email" name="email" placeholder="email@szolgáltató.hu">
  	</div>
	  <div class="input-group">
  	  <label>Irányítószám:</label>
	  <!-- oninputban korlátozás arra, hogy csak számokat adhasson meg hiába text mező. -->
  	  <input type="text" name="irsz" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" value="1000">
  	</div>
  	<div class="input-group">
  	  <label>Lakhely:</label>
  	  <input type="text" name="city" placeholder="Város/Falu">
  	</div>
	  <div class="input-group">
  	  <label>Adóazonosító:</label>
  	  <input type="text" name="adoszam" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" value="0000000000">
  	</div>
      <div class="input-group">
  	  <label>Beosztás:</label>
  	  <select name="rank">
        <?php Rank_Array($rank,0);  //rankok kiírása opcióként ?>
        </select>
</div>
<div class="input-group">
  	  <label>Bejárás:</label>
  	  <select name="travel">
        <?php Travel_details($travel); ?>
        </select>
</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" title="Regisztrálás" name="register">Regisztráció</button>
	<button type="submit" class="btn" title="Vissza a Főoldalra" name="regback">Vissza</button>
  	</div>
  </form>
</div>
</body>
</html>