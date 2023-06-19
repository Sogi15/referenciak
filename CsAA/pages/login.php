<?php include('../res/config/server.php'); ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="https://t31556852.p.clickup-attachments.com/t31556852/e8898ffe-ec8b-4d31-9aaa-f80c66de2a16_medium.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../res/css/reglogin.css">
    <title>C$-A-A Kasszarendszer</title>
</head>
<body>
    <div id="page">
    <header>
    <img src="https://t31556852.p.clickup-attachments.com/t31556852/e8898ffe-ec8b-4d31-9aaa-f80c66de2a16_medium.png" alt="C$-A-A" title="C$-A-A Kassza"><br>
  </header>
    <form method="post" action="login.php">
    <?php include('../res/config/errors.php'); ?>
  	<div class="input-group">
  		<label>E-Mail</label>
  		<input type="text" name="email">
  	</div>
  	<div class="input-group">
  		<label>Jelszó</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" name="login_user">Bejelentkezés</button>
  	</div>
  </form>
    </div>
</body>
</html>