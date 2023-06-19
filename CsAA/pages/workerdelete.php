<?php
include('../res/config/server.php');
if (!isset($_SESSION['email']) || $_SESSION['rank'] > '2') {
	header('Location: login.php');
	}
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
    $sql = "SELECT * FROM users JOIN user_details ON users.id = user_details.userid WHERE users.id NOT LIKE 3 AND users.id NOT LIKE 20 AND users.id NOT LIKE 19";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $w_id[] = $row['id'];
        $w_name[] = $row['lastname'].' '.$row['firstname'];
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
  <form method="post" action="workerdelete.php">
  <?php include('../res/config/errors.php'); ?>
        <div class="input-group">
      <label>Válassz Munkást:</label>
      <select name="cworker">
        <?php foreach ($w_id as $key => $value) {
          echo '<option value="'.$value.'">'.$w_name[$key].'</option>';
        } ?>
    </select>
    </div>
    <div class="input-group">
      <label>Válassz:</label>
      <select name="cdoit">
        <option value="details">Adatok lekérdezése</option>
        <option value="delete">Törlés</option>
    </select>
    </div>
    <div class="input-group">
      <button type="submit" class="btn" title="Vissza" name="wedit_next">Tovább</button>
      <button type="submit" class="btn" title="Vissza" name="regback">Vissza</button>
    </div>
    <?php
         $show = "none";
         $dshow = "none";
    if(isset($_POST['wedit_next'])){
        $choosenid = mysqli_real_escape_string($db, $_POST['cworker']);
        $choosendo = mysqli_real_escape_string($db, $_POST['cdoit']);
        if ($choosendo == "details")
        {
            $show = "block";
            $sql = "SELECT * FROM users JOIN user_details ON users.id = user_details.userid WHERE users.id LIKE '$choosenid'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $wo_email = $row['email'];
                $wo_id = $row['id'];
                $wo_travel = $row['travel'];
                $wo_name = $row['lastname'].' '.$row['firstname'];
                $wo_date = $row['age'];
                $timenow = new DateTime('now');
                $age_now = new DateTime($row['age']);
                $age = $timenow->diff($age_now);
                $wo_age = ''.$age->y;
                $wo_rank = $row['rank'];
                $wo_city = $row['irsz'].' '.$row['city'];
                $wo_adoszam = $row['adoszam'];
                $wo_wtime = round($row['workedtime']/60);
                switch ($wo_travel)
                {
                    case '0': $wo_tra = "Helyi"; break;
                    case '1': $wo_tra = "Bejárós"; break;                   
                }
              }
            }
        }
        else {
            $dshow = "block";
            $sql = "SELECT * FROM users JOIN user_details ON users.id = user_details.userid WHERE users.id LIKE '$choosenid'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $wo_id = $row['id'];
                $wo_name = $row['lastname'].' '.$row['firstname'];
              }
            }
        }

    }
    ?>
    </form>
    <form method="post" action="workerdelete.php" style="display: <?php echo $show; ?>;">
      <div class="input-group">
  	  <label>Azonosító:</label>
  	  <input type="text" value="<?php echo $wo_id; ?>" readonly>
  	</div>
      <div class="input-group">
  	  <label>E-Mail:</label>
  	  <input type="email" value="<?php echo $wo_email; ?>" readonly>
  	</div>
  	<div class="input-group">
  	  <label>Név:</label>
  	  <input type="text" value="<?php echo $wo_name; ?>" readonly>
  	</div>
	  <div class="input-group">
  	  <label>Kor:</label>
  	  <input type="text" value="<?php echo $wo_date.' ('.$wo_age.' éves)'; ?>" readonly>
  	</div>
  	<div class="input-group">
  	  <label>Lakhely:</label>
  	  <input type="text"  value="<?php echo $wo_city; ?>" readonly>
  	</div>
	  <div class="input-group">
  	  <label>Adóazonosító:</label>
  	  <input type="text" value="<?php echo $wo_adoszam; ?>" readonly>
  	</div>
<div class="input-group">
  	  <label>Bejárás:</label>
    <input type="text" value="<?php echo $wo_tra; ?>" readonly>
</div>
<div class="input-group">
  	  <label>Dolgozott idő:</label>
  	  <input type="text" value="<?php echo $wo_wtime; ?> Óra" readonly>
  	</div>
</form>
<form method="post" action="workerdelete.php" style="display: <?php echo $dshow; ?>;">
<div class="input-group" style="display:none;">
      <label>ID:</label>
      <input type="text" name="id" value="<?php echo $wo_id; ?>" readonly>
    </div>
<div class="input-group">
    <label>Biztos elbocsátod a következő dolgozót: <?php echo $wo_name; ?>?</label>
    <select name="worker_del">
    <option value="0">Nem</option>
    <option value="1">Igen</option>
    </select>
    </div>
    <button type="submit" class="btn" title="Kirúgás" name="wo_delete">Elbocsátás</button>
</form>

</div>
</body>
</html>