<?php

// A szavak tömbje, amelyeket ki fogunk választani véletlenszerűen
$szavak = array();
$errors = array();
if (!isset($_SESSION['helyes_valaszok'])) {
    $_SESSION['helyes_valaszok'] = 0;
}
if (!isset($_SESSION['helytelen_valaszok'])) {
    $_SESSION['helytelen_valaszok'] = 0;
}
$filelink = "res/szokincs.txt"; // fájl neve
    $data = fopen($filelink, "r"); //fájl olvasása
    if ($data)
    {
        while (($line = fgets($data)) !== false) {
            $text = explode("#",$line);  // sor hozzáadása a tömbhöz
            $szavak[trim($text[0])] = trim($text[1]);
        }
        fclose($data);  // fájl bezárása
    }
// Ellenőrző változók
$helyes_valaszok = 0;
$helytelen_valaszok = 0;
// Ha beküldik a választ
if (isset($_POST['szokincsjatek'])) {
    $magyar = $_POST["magyar_szo"];
    $angol = $_POST["angol_szo"];
    if (empty($angol)) { array_push($errors, "Nem írtál be semmit!"); }
if(count($errors) == 0)
{
  // Ellenőrizni kell, hogy helyes-e a válasz
  if (isset($szavak[$magyar]) && strtolower($szavak[$magyar]) == strtolower($angol)) {
    $_SESSION["helyes_valaszok"]++;
  } else {
    $_SESSION["helytelen_valaszok"]++;
  }
}
}

// Véletlenszerűen kiválasztunk egy szót a tömbből
$magyar_szo = array_rand($szavak);

?>
<p class="h4">Írja be a(z) <strong><u><?php echo $magyar_szo; ?></u></strong> szót angolul:</p>
<form method="POST" id="szokincs">
    <input type="hidden" name="magyar_szo" value="<?php echo $magyar_szo; ?>">
    <?php include('config/errors.php'); ?>
    <label for="angol_szo">Angol szó:</label>
    <input type="text" id="angol_szo" name="angol_szo" required>
    <br><br>
    <input type="submit" class='btn btn-warning' value="Ellenőrzés" name="szokincsjatek">
</form>
<?php
$endgame = false;
// Ha a játék véget ért, akkor töröljük az eredményeket
if ($_SESSION["helyes_valaszok"] + $_SESSION["helytelen_valaszok"] == 6) {
    $endgamehelyes = $_SESSION["helyes_valaszok"];
    $endgamehelytelen = $_SESSION["helytelen_valaszok"];
    $_SESSION["helyes_valaszok"] = 0;
    $_SESSION["helytelen_valaszok"] = 0;
    $endgame = true;
}
// Jelenítsük meg az eredményeket
    // Kiírjuk a statisztikát
    if($endgame)
    {
      C_Answers($endgamehelyes,$endgamehelytelen,1);
    }
?>