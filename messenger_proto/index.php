<?php
include('server.php');
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
}
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="js.js"></script>
    <title>Üdvözöllek: <?php echo $_SESSION['username']; ?></title>
</head>
<body>
<table>
<tr>
<th colspan="3">
<h2>Üzenetek</h2>
</th>
</tr>
<tr>
    <td colspan="3" id="mess">
        <?php include_once('messages.php'); ?>
        <?php include('errors.php'); ?>
</td>
</tr>
<tr>
    <td class="left" id="logout"><a href="index.php?logout=1" title="Kilépés">Kijelentkezés (<b><?php echo $_SESSION['username'] ?></b>)</a></td>
    <td class="top" id="message"><form method="post" action="index.php"><input type="text" name="message"></td>
    <td class="right" id="submitbutton"><button type="submit" class="btn" name="sendmessage">Küldés</button></form></td>
</tr>
</table>
</body>
</html>