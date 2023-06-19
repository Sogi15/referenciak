<?php
$done = false;
if ( isset($_FILES['image']['tmp_name']) ) {
    $mysqliHost = "localhost";
    $mysqliUsername = "root";
    $mysqliPassword = "";
    $mysqliDatabase = "images";
    $mysqli = new mysqli($mysqliHost,$mysqliUsername,$mysqliPassword,$mysqliDatabase);

    $binary = file_get_contents($_FILES['image']['tmp_name']);

    $finfo = new finfo(FILEINFO_MIME);
    $type = $finfo->file($_FILES['image']['tmp_name']);
    $mime = substr($type, 0, strpos($type, ';'));

    $query = "INSERT INTO `images` (`data`,`mime`,`name`) 
    VALUES('".$mysqli->real_escape_string($binary)."',
            '".$mysqli->real_escape_string($mime)."',
            '".$mysqli->real_escape_string($_FILES['image']['name'])."')";
    $mysqli->query($query);
    $done = true;
}

if ( isset($_GET['imageName']) ) {
    $mysqli = new mysqli($mysqliHost,$mysqliUsername,$mysqliPassword,$mysqliDatabase);

    $query = "SELECT `data`,`mime` FROM `images` WHERE `name`='".$mysqli->real_escape_string($_GET['imageName'])."'";
    $result = $mysql->query($query);


    if ( $result->num_rows ) {
        $assoc = $result->fetch_assoc();

        header('Content-type: '.$assoc['mime']);

        echo $assoc['data'];
    } else {
        header('HTTP/1.1 404 Not Found');
    }
}
if ($done)
{
    header('location: index.php');
}