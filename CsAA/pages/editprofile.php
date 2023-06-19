<?php
include('../res/config/server.php');
include('../res/config/config.php');
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
// ha nincs bejelentkezve akkor login.php 
if (!isset($_SESSION['email'])) {
	header('Location: login.php');
	}
	// szerkesztéshez szükséges adatok kiolvasása session változókból illetve az adatbázisból
$id = $_SESSION['id'];
$email = $_SESSION['email'];
    $query = "SELECT * FROM user_details WHERE userid='$id'";
    $result = $db->query($query);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $age = $row["age"];
        $adoszam = $row["adoszam"];
        $irsz = $row["irsz"];
        $city = $row["city"];
        $travel = $row["travel"];
      }
    };

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
  <form method="post" action="editprofile.php">
  	<?php include('../res/config/errors.php'); ?>
      <div class="input-group" style="display:none;">
  	  <label>ID:</label>
  	  <input type="text" name="id" value="<?php echo $id; ?>" readonly>
  	</div>
      <div class="input-group">
  	  <label>E-Mail:</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>" readonly>
  	</div>
  	<div class="input-group">
  	  <label>Keresztnév:</label>
  	  <input type="text" name="fname" value="<?php echo $firstname; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Vezetéknév:</label>
  	  <input type="text" name="lname" value="<?php echo $lastname; ?>">
  	</div>
	  <div class="input-group">
  	  <label>Születési idő:</label>
  	  <input type="date" name="age"  value="<?php echo $age; ?>">
  	</div>
	  <div class="input-group">
  	  <label>Irányítószám:</label>
  	  <input type="text" name="irsz" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4"  value="<?php echo $irsz; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Lakhely:</label>
  	  <input type="text" name="city"  value="<?php echo $city; ?>">
  	</div>
	  <div class="input-group">
  	  <label>Adóazonosító:</label>
  	  <input type="text" name="adoszam" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10"  value="<?php echo $adoszam; ?>">
  	</div>
<div class="input-group">
  	  <label>Bejárás:</label>
  	  <select name="travel">
        <?php Travel_details($travel); ?>
        </select>
</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" title="Mentés" name="editprofile_save">Mentés</button>
	<button type="submit" class="btn" title="Vissza a Profil odalra!" name="editback">Vissza</button>
  	</div>
  </form>
</div>
</body>
</html>