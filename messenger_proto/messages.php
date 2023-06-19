<?php 
    $myfile = fopen("messages.txt", "r") or die("Unable to open file!");
    echo fread($myfile,filesize("messages.txt"));
    fclose($myfile);
?>