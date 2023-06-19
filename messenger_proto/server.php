<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
$errors = array();
// Bejelentkezés
if (isset($_POST['login_user'])) {
    $username = htmlspecialchars($_POST['username']);  
    if (empty($username)) {
        array_push($errors, "Nem írtál be semmit!");
    }
    if (count($errors) == 0) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "Sikeresen bejelentkeztél";
          header('location: index.php');
        }else {
            array_push($errors, "Rossz nevet adtál meg!");
        }
    }


if (isset($_POST['sendmessage']))
{
    $msg = htmlspecialchars($_POST['message']);
    if (empty($msg)) {
        array_push($errors, "Nem írtál be semmit!");
    }
    if (count($errors) == 0) {
    $time = '<span class="time">'.date("Y-m-d h:i:s").'</span> ';
    $name = '<span class="name">'.$_SESSION['username'].':</span> ';
    $message = '<span class="message">'.$msg.'</span><br>';
    $done = $time.$name.$message.PHP_EOL;;
    $myfile = fopen("messages.txt", "a");
    fwrite($myfile, $done);
    fclose($myfile);
}
}

?>