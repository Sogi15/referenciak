<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Bejelentkezés - Chat</title>
</head>
<body id="login">
  <form method="post" action="login.php">
      <div id="loginform">
  <?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Felhasználónév</label><br>
  		<input type="text" name="username">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Bejelentkezés</button>
  	</div>
</div>
  </form>
</body>
</html>