<?php
// oldalak betöltéséhez a function (404 ha nem található a file)
function pageContent($page)
{
    if (file_exists("res/php/" . $page . ".php")) {
        include_once("res/php/" . $page . ".php");
    } else {
        include_once("res/php/404.php");
    }
    ;
}
;
?>