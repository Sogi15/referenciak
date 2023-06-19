<?php
include('../res/config/server.php');
if (!isset($_SESSION['email']) || $_SESSION['rank'] > '2') {
	header('Location: login.php');
	}
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
    $sql = "SELECT food.name, food.id, food.ingredients, food.price, fimg.data, food.status FROM food JOIN fimg ON food.id = fimg.id";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $f_id[] = $row['id'];
        $f_name[] = $row['name'];
      }
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
  <form method="post" action="foodedit.php">
  <?php include('../res/config/errors.php'); ?>
        <div class="input-group">
      <label>Válassz ételt:</label>
      <select name="cfood">
        <?php foreach ($f_id as $key => $value) {
          echo '<option value="'.$value.'">'.$f_name[$key].'</option>';
        } ?>
    </select>
    </div>
    <div class="input-group">
      <label>Válassz:</label>
      <select name="cdoit">
        <option value="edit">Szerkesztés</option>
        <option value="delete">Törlés</option>
    </select>
    </div>
    <div class="input-group">
      <button type="submit" class="btn" title="Vissza" name="fedit_next">Tovább</button>
      <button type="submit" class="btn" title="Vissza" name="foodback">Vissza</button>
    </div>
    <?php
         $show = "none";
         $dshow = "none";
    if(isset($_POST['fedit_next'])){
        $choosenid = mysqli_real_escape_string($db, $_POST['cfood']);
        $choosendo = mysqli_real_escape_string($db, $_POST['cdoit']);
        if ($choosendo == "edit")
        {
            $show = "block";
            $sql = "SELECT food.name, food.id, food.ingredients, food.price, fimg.data, food.status FROM food JOIN fimg ON food.id = fimg.id WHERE food.id LIKE '$choosenid'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $e_id = $row['id'];
                $e_name = $row['name'];
                $e_ing = $row['ingredients'];
                $e_price = $row['price'];
                $e_status = $row['status'];
              }
            }
        }
        else {
            $dshow = "block";
            $sql = "SELECT food.name, food.id, food.ingredients, food.price, fimg.data, food.status FROM food JOIN fimg ON food.id = fimg.id WHERE food.id LIKE '$choosenid'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $e_id = $row['id'];
                $e_name = $row['name'];
              }
            }
        }

    }
    ?>
    </form>
    <form method="post" action="foodedit.php" enctype="multipart/form-data" style="display: <?php echo $show; ?>;">
    <div class="input-group">
      <label>ID:</label>
      <input type="text" name="id" value="<?php echo $e_id; ?>" readonly>
    </div>
    <div class="input-group">
      <label>Étel neve:</label>
      <input type="text" name="foodname" value="<?php echo $e_name; ?>">
    </div>
    <div class="input-group">
      <label>Hozzávalók:</label>
      <input type="text" name="ingredients" value="<?php echo $e_ing; ?>">
    </div>
    <div class="input-group">
      <label>Ár (Forint):</label>
      <input type="number" name="price" value="<?php echo $e_price; ?>" minvalue="1" maxvalue="30000">
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
    <label>Új kép: (csak ha új képet töltesz fel akkor legyen igen!)</label>
    <select name="newimg">
    <option value="0">Nem</option>
    <option value="1">Igen</option>
    </select>
    </div>
    <div class="input-group">
      <button type="submit" class="btn" title="Mentés" name="foodedit">Mentés</button>
    </div>
</form>
<form method="post" action="foodedit.php" enctype="multipart/form-data" style="display: <?php echo $dshow; ?>;">
<div class="input-group" style="display:none;">
      <label>ID:</label>
      <input type="text" name="id" value="<?php echo $e_id; ?>" readonly>
    </div>
<div class="input-group">
    <label>Biztos törölni szeretnéd a következőt: <?php echo $e_name; ?>?</label>
    <select name="food_del">
    <option value="0">Nem</option>
    <option value="1">Igen</option>
    </select>
    </div>
    <button type="submit" class="btn" title="Törlés" name="fooddelete">Törlés</button>
</form>

</div>
</body>
</html>