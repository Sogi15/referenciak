<?php
// változók a session adatok kiolvasásához bár nincs rá szükség, de így könnyebb átlátni.
$id = $_SESSION["id"];
$age = $_SESSION["age"];
$ageyear = $_SESSION["ageyear"];
$rank = $_SESSION["rank"];
$user = $_SESSION['name'];
$salary = $_SESSION['salary'];
$bonus = $_SESSION['bonus'];
$worktime = $_SESSION['workedtime'];
if ($_SESSION['travel'] == 1) // kiíráshoz egy if elágazás ha bejárós és ha nem mit írjon ki.
{
    $travel = "Bejárós (+10000 Forint / Hónap)";
    $travel_p = "Bejárós";
}
else {
    $travel = "Helyi";
    $travel_p = $travel;
}
?>
<h1 class="h1">Dolgozói profil</h1>
<div class="card left">
    <div id="details">
    <div id="avatar">
    <img src="https://t31556852.p.clickup-attachments.com/t31556852/e8898ffe-ec8b-4d31-9aaa-f80c66de2a16_medium.png" alt="C$-A-A Kasszarendszer" Title="C$-A-A Logó">
    </div>
    <!-- a kártyán belül az id/név/kor/ és beosztás kiírása az adatbázisból lekérdezett adatok alapján. -->
    <div id="name"><p><?php echo $user.' #'.$id; ?><br><span><b>Kor:</b> <?php echo $age.' ('.$ageyear.')'; ?></span><br><span><b>Beosztás:</b> <?php Rank_Array($rank,1); ?></span></p>
</div>
</div>
<div id="merch">
<p>C<span class="lgreenfilter">$</span>-A-A Kasszarendszer</p>
</div>
</div>
<div class="payment">
<p>
<a href="index.php?page=payment">Bérjegyzék</a><br>
<!-- fizetés / bonusz / dolgozott idő és utazás kiírása -->
    Órabér: <span><?php echo $salary; ?> Forint / Óra.</span><br>
    Bónusz: <span><?php echo $salary*$bonus; // az adatbázis a bonus alatt a hónapok számát tárolja tehát az órabére szorozva pld 1-el ha egyhavi rangonként változó. ?> Forint / Hónap</span><br>
    Bejárás: <span><?php echo $travel ?></span><br>
    Dolgozott Óra: <span><?php echo round($worktime/60,2); //azért 60al szorozva, mert az adatbázis a perceket menti el.  ?> Óra.</span>
</p>
</div>
<form action="pages/editprofile.php">
<button class="btn btncenter">Profil módosítás</button>
</form>

<div id="profile_p">
    <table class="border">
        <!-- bejelentkezett tag adatainak kiírása session változókkal. -->
        <tr class="border"><th class="border" colspan="2">Dolgozó adatai</th></tr>
        <tr class="border"><td class="border"><b>Név:</b></td><td class="border"><?php echo $_SESSION['name']; ?></td></tr>
        <tr class="border"><td class="border"><b>E-Mail:</b></td><td class="border"><?php echo $_SESSION['email']; ?></td></tr>
        <tr class="border"><td class="border"><b>Lakhely:</b></td><td class="border"><?php echo  $_SESSION['irsz'].' '.$_SESSION['city']; ?></td></tr>
        <tr class="border"><td class="border"><b>Adószám:</b></td><td class="border"><?php echo $_SESSION['adoszam']; ?></td></tr>        
        <tr class="border"><td class="border"><b>Születési idő:</b></td><td class="border"><?php echo $_SESSION['age']; ?></td></tr>
        <tr class="border"><td class="border"><b>Végzettség:</b></td><td class="border">Debreceni SZC Beregszászi Pál Technikum</td></tr>
        <tr class="border"><td class="border"><b>Beosztás:</b></td><td class="border"><?php Rank_Array($_SESSION['rank'],1) ?></td></tr>
        <tr class="border"><td class="border"><b>Bejárás:</b></td><td class="border"><?php echo $travel_p; ?></td></tr>

   </table>
</div>