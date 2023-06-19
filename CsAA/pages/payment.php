<?php

$bonus = $_SESSION["salary"]*$_SESSION["bonus"]; // bonus érték megkapása órabér * hány havi órabért kap rangtól függően.
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
$id = $_SESSION["id"]; //azonosito lekérés
$salary = $_SESSION["salary"]; //rang alapján fizetés lekérés az adatbázisból
$query = "SELECT workedtime FROM user_details WHERE userid='$id'"; //dolgozott óra kiolvasás
$results = mysqli_query($db, $query);
if ($results->num_rows > 0) {
    while($row = $results->fetch_assoc()) {
      $workedtime = $row["workedtime"];
    }
    $workedtime = $workedtime / 60; //az adatbázs percben méri a dolgozott órát ezért osztva 60-al
    $workedtime = number_format($workedtime, 2); //ha több mint 2 tizedes jegy jönne ki pld 1,333 akkor 2re korlátozás azaz 1.33
}
if($_SESSION['travel'] == 1)
{
  // üzenet és érték adás ha az illető nem helyi lakos esetünkben Debreceni
 $travelmsg = "Vidéki bej. tám.";
 $travelbonus = 10000;
}
else {
  $travelmsg = '<span style="color:white">-</span>';
  $travelbonus = $szjamsg;
}

?>
<h1 class="h1">Bérjegyzék</h1>
<div id="paymentpaper">
  <table><tr>
  <td id="paperleft">
    <table><tr><td style="width:100%;display:inline-flex;"><img src="https://t31556852.p.clickup-attachments.com/t31556852/e8898ffe-ec8b-4d31-9aaa-f80c66de2a16_medium.png" alt="C$-A-A Kassza" title="C$-A-A"><p id="papermerch">C<span class="lgreen">$</span>-A-A Kasszarendszer</p><br></td></tr>
  <tr><td colspan="2" id="ceg_adatok"><p>4032 Debrecen Jerikó utca 17.</p></td></tr>
<tr><td colspan="2"><h2 id="payment_name"><?php echo $_SESSION['name']; ?></h2></td></tr>
<tr><td colspan="2"><p id="payment_city"><?php echo $_SESSION['irsz'].' '.$_SESSION['city']; ?></p></td></tr>
<tr><td colspan="2"><br><p id="payment_adoa">Adóazonosító: <?php echo $_SESSION['adoszam']; ?></p></td></tr>
</table>
</td>
<td id="paperright">
  <!-- random számok generálása a hivatalos papírok számainak legenárálására --> 
<h2>Bérjegyzék <?php Honapok(1); ?></h2>
  <table><tr><td><p><b>Bérszámf. ID</b></p></td><td><p><?php echo rand('00000001','99999999');  ?></p></td></tr>
  <tr><td><p><b>HRIS ID</b></p></td><td><p><?php echo 'E'.rand('00000001','99999999'); ?></p></td></tr>
  <tr><td><p><b>Időszak</b></p></td><td><p><?php Honapok(5); ?></p></td></tr>
  <tr><td><p><b>Utalás dátuma</b></p></td><td><p><?php Honapok(6); ?></p></td></tr>
  <tr><td><p><b>Költséghely</b></p></td><td><p><?php echo rand('000001','999999'); ?></p></td></tr>
  <tr><td><p><b>Vállalat</b></p></td><td><p>C$-A-A Kasszarendszer</p></td></tr>
  <tr><td><p><b>Szem. csop.</b></p></td><td><p>Normál - Fizikai órabéres</p></td></tr>
</table>
</td>
</tr>
<tr>
  <td id="stats_1">
  <table class="border">
  <?php
  $wage = $workedtime*$salary; //fizetés kiszámolás 
  $mpotlek = round($workedtime/12,2); //műszakpótlék kiszámítása. Nem hivatalos ez csak saját ötlet.
  $ofizu = round(($wage+($mpotlek*$salary/2.5)+$bonus+$travelbonus),0); // az egész fizetés kiszámolása
  $tb = round($ofizu*0.185,0); //tb járulék kiszámolása
// az aktuális törvény szerint ha az illető 25 év alatti nem kell szja-t fizetni ha viszont korosabb akkor a bérpapíron ez is fel van tűntetve
if($_SESSION['ageyear'] >= 25)
{
  $adoalapkedv = '<span style="color:white">-</span>';
  $adoalaposszeg = $adoalapkedv;
  $szjamsg = "SZJA";
  $szja = round(($wage+($mpotlek*$salary/2.5)+$bonus)*0.15,0);
}
else {
  $adoalapkedv = "Adóalap kedv.-re eső adó";
  $adoalaposszeg = round(($wage+($mpotlek*$salary/2.5)+$bonus)*0.15,0);
  $szjamsg = '<span style="color:white">-</span>';
  $szja = 0;
}
$tbszja = round($tb+$szja,0);
$szocho = round($ofizu*0.13,0); // szochó kiszámítása
$netto = round($ofizu-$tbszja,0); // netto fizetés kiszámítása

?>
    <tr class="p_gray border"><td class="p_w50 border">Alap Juttatás</td><td colspan="2" class="p_txright p_w50 border"><?php echo $_SESSION["salary"]; ?> Ft</td></tr>
  <tr class="p_gray border"><td class="p_w50 border">Ált. munkarend óra</td><td colspan="2" class="p_txright p_w50 border">0.00</td></tr>
  <tr class="p_gray border"><td colspan="3" class="p_txcenter border"><b>Juttatások</b></td></tr>
  <tr class="p_gray border"><td class="p_w50 border"> Részletezés</td><td class="p_txcenter p_w25 border">Egység</td><td class="p_txright p_w25 border">Összeg</td></tr>
 <tr class="no_border"><td class="p_w50 no_border">Órabéresek időbére</td><td class="p_txcenter p_w25 no_border"><?php echo $workedtime; ?></td><td class="p_txright p_w25 no_border"><?php echo $wage; ?></td></tr>
 <tr class="no_border"><td class="p_w50 no_border">Fizetett szabadság tény ó</td><td class="p_txcenter p_w25 no_border">0</td><td class="p_txright p_w25 no_border">0</td></tr>
 <tr class="no_border"><td class="p_w50 no_border">Műszakpótlék IT</td><td class="p_txcenter p_w25 no_border"><?php echo $mpotlek; ?></td><td class="p_txright p_w25 no_border"><?php echo round($mpotlek*$salary/2.5,0); ?></td></tr>
 <tr class="no_border"><td class="p_w50 no_border">Jutalom</td><td colspan="2" class="p_txright p_w25 no_border"><?php echo $bonus; ?></td></tr>
 <tr class="no_border"><td class="p_w50 no_border"><?php echo $travelmsg; ?></td><td colspan="2" class="p_txright p_w25 no_border"><?php echo $travelbonus; ?></td></tr>
 <tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
<tr class="p_gray border"><td class="p_w50 border">Összesen</td><td colspan="2" class="p_txright p_w50 border"><?php echo $ofizu; ?></td></tr> 
<tr class="p_gray border"><td colspan="3" class="p_txcenter border"><b>Béren kívüli juttatások</b></td></tr>
<tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
<tr class="p_gray border"><td class="p_w50 border">Összesen</td><td colspan="2" class="p_txright p_w50 border">0</td></tr> 
</table>
</td>
<td id="stats_2">
<table class="border">
    <tr class="p_gray border"><td class="p_w50 border">Ledolgozott órák</td><td colspan="2" class="p_txright p_w50 border"><?php echo $workedtime; ?></td></tr>
  <tr class="p_gray border"><td class="p_w50 border">Elszámolt órák</td><td colspan="2" class="p_txright p_w50 border"><?php echo $workedtime; ?></td></tr>
  <tr class="p_gray border"><td colspan="3" class="p_txcenter border"><b>Levonások</b></td></tr>
  <tr class="p_gray border"><td class="p_w50 border"> Részletezés</td><td colspan="2" class="p_txright p_w25 border">Összeg</td></tr>
 <tr class="no_border"><td class="p_w50 no_border">TB járulék</td><td colspan="2" class="p_txright p_w25 no_border"><?php echo $tb; ?></td></tr>
<tr class="no_border"><td class="no_border p_w50"><?php echo $szjamsg; ?></td><td class="no_border p_txright p_w25" colspan="2"><?php echo $szja; ?></td></tr>
<tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
<tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
<tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
<tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
<tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
<tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
<tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
<tr class="p_gray border"><td class="p_w50 border">Összesen</td><td colspan="2" class="p_txright p_w50 border"><?php echo $tbszja; ?></td></tr> 
</table>
</td>
</tr>
<tr>
<td id="stats_3">
<table class="border">
  <tr class="p_gray border"><td colspan="3" class="p_txcenter border"><b>Utalások</b></td></tr>
  <tr class="p_gray border"><td class="p_w50 border">Bankkulcs</td><td class="p_txcenter p_w25 border">Bankszámlaszám</td><td class="p_txright p_w25 border">Összeg</td></tr>
  <tr class="no_border"><td class="p_w25 no_border"><?php echo rand('00000001','99999999'); ?></td><td class="p_txcenter p_w50 no_border"><?php echo rand('00000001','99999999').'-'.rand('00000001','99999999'); ?></td><td class="p_txright p_w25 no_border"><?php echo $netto; ?></td></tr>
  <tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
  <tr class="p_gray border"><td class="p_w50 border">Összesen</td><td colspan="2" class="p_txright p_w50 border"><?php echo $netto; ?></td></tr> 
</table>
</td>
<td id="stats_4">
<table class="border">
  <tr class="p_gray border"><td colspan="3" class="p_txcenter border"><b>Nettó fizetés</b></td></tr>
  <tr class="p_gray border"><td class="p_w50 border">Bankkulcs</td><td colspan="2" class="p_txright p_w25 border">Összeg</td></tr>
  <tr class="no_border"><td class="p_w25 no_border">Átutalás</td><td colspan="2" class="p_txright p_w25 no_border"><?php echo $netto; ?></td></tr>
  <tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
  <tr class="p_gray border"><td class="p_w50 border">Összesen</td><td colspan="2" class="p_txright p_w50 border"><?php echo $netto; ?></td></tr> 
</table>
</td>
</tr>
<tr>
<td id="stats_5">
<table class="border">
<tr class="p_gray border"><td colspan="3" class="p_txcenter border"><b>Munkáltatói hozzájárulás</b></td></tr>
<tr class="p_gray border"><td class="p_w50 border">Részletezés</td><td colspan="2" class="p_txright p_w25 border">Összeg</td></tr>
<tr class="no_border"><td class="p_w25 no_border">Red.MA.Szoc.hj.adó alap</td><td colspan="2" class="p_txright p_w25 no_border"><?php echo $ofizu; ?></td></tr>
<tr class="no_border"><td class="p_w25 no_border">MA.Szoc.hj.adó</td><td colspan="2" class="p_txright p_w25 no_border"><?php echo $szocho; ?></td></tr>
<tr class="no_border"><td class="p_w25 no_border">Igényb. &#60;25 adóa.kedv.</td><td colspan="2" class="p_txright p_w25 no_border"><?php echo $ofizu; ?></td></tr>
<tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
</table>
</td>
<td id="stats_6">
<table class="border">
<tr class="p_gray border"><td colspan="3" class="p_txcenter border"><b>Információk</b></td></tr>
<tr class="p_gray border"><td class="p_w50 border">Részletezés</td><td colspan="2" class="p_txright p_w25 border">Összeg</td></tr>
<tr class="no_border"><td class="p_w25 no_border">Havi adóalap</td><td colspan="2" class="p_txright p_w25 no_border"><?php echo $ofizu; ?></td></tr>
<tr class="no_border"><td class="p_w25 no_border">Kumulált adóalap</td><td colspan="2" class="p_txright p_w25 no_border"><?php echo $ofizu; ?></td></tr>
<tr class="no_border"><td class="p_w25 no_border"><?php echo $adoalapkedv; ?></td><td colspan="2" class="p_txright p_w25 no_border"><?php echo $adoalaposszeg; ?></td></tr>
<tr class="no_border"><td class="no_border" colspan="3" style="color:white">-</td></tr>
</table>
</td>
</tr>
</table>
</div>
