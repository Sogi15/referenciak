<?php
if (!isset($_SESSION['game4_t'])) {
    $_SESSION['game4_t'] = 0;
}
if (!isset($_SESSION['game4_f'])) {
    $_SESSION['game4_f'] = 0;
}
// A szavakat ebben a tömbben tároljuk
$szavak = array(
        "A tiny, fluffy animal that likes to eat carrots and hops around in fields." => "Rabbit",
        "A small, sweet fruit that comes in many colors and is often used in pies and jams." => "Strawberry",
        "A large, powerful animal with a trunk and tusks that lives in warm climates and uses its trunk to drink water and pick up food." => "Elephant",
        "A small, winged insect that feeds on nectar and can often be found near flowers." => "Butterfly",
        "A four-legged animal with a mane and a roar that lives in grasslands and is often called the king of the jungle." => "Lion",
        "A small, shiny object that is often worn on a finger and is given as a symbol of love or commitment." => "Ring",
        "A popular winter sport that involves sliding down a hill covered in snow on a long, narrow board." => "Skiing",
        "A small, colorful bird that can imitate the sounds of other animals and is often kept as a pet." => "Parrot",
        "A physical or virtual collection of objects and information that we have access to via the internet." => "Website",
        "A device or object used to measure time. It's usually found on the wall or on our wrists." => "Clock"
    );


    // Véletlenszerűen kiválasztunk egy szót a tömbből
$random_szo = $szavak[array_rand($szavak)];
// A szó betűit ebben a tömbben tároljuk
// Ellenőrző változók
$game4_t = 0;
$game4_f = 0;
// Az adott betűket felhasználó szókirakós játék
echo "<p class='h4'>A feladat: Találd ki mire gondolunk!</p>";
echo "<form method='POST' id='szokirako'>";
$leiras = array_search($random_szo, $szavak);
echo '<p class="h6"><i>"'.$leiras.'"</i></p>';
$betuk = str_split($random_szo);
echo '<input type="hidden" name="megoldas" value="'.$random_szo.'">';
foreach ($betuk as $betu) {
        echo "<input type='text' name='betu[]' maxlength='1' style='width:40px; margin:5px; text-transform:uppercase' onkeypress='return /[a-zA-Z]/i.test(event.key)' required>";
}
echo "<br><br><input type='submit' class='btn btn-warning' value='Ellenőrzés' name='englishtest3'></form>";

// Ellenőrizzük, hogy helyesen van-e kirakva a szó
if (isset($_POST['englishtest3'])) {
    $megoldas = strtoupper($_POST['megoldas']);
    $tippek = strtoupper(implode($_POST['betu']));
        if ($tippek == $megoldas) {
            $_SESSION["game4_t"]++;
        } else {
            $_SESSION["game4_f"]++;
        }
}
$endgame = false;
// Ha a játék véget ért, akkor töröljük az eredményeket
if ($_SESSION["game4_t"] + $_SESSION["game4_f"] == 4) {
    $endgamehelyes = $_SESSION["game4_t"];
    $endgamehelytelen = $_SESSION["game4_f"];
    $_SESSION["game4_t"] = 0;
    $_SESSION["game4_f"] = 0;
    $endgame = true;
}
// Jelenítsük meg az eredményeket
    if($endgame)
    {
      C_Answers($endgamehelyes,$endgamehelytelen,1);
    }
?>