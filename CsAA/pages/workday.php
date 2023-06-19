<div id="workday">
<h1 class="h1">Munkarend</h1>
<br>
<p><b>Fontos!</b> Minden hétköznap kötelező munkanap van, ezért minden hétvégén, azaz <u>Szombaton</u> és <u>Vasárnap</u> nincs munka, ezáltal azokon a napokon kapják meg az emberek a pihenő napokat! <br>
A naptár színekkel jelzi a különböző napok tulajdonságát (<a href="#naptarsnipet" title="Ugrás a magyarázathoz">Lásd a naptár alatt!</a>)<br>
Ha bármiféle kérdésed lenne kérlek fordulj a műszakvezetőhöz! - <a href="index.php?page=contact" title="Vezetőség elérhetősége">Elérhetőségek</a></p>
<table>
<tr>
<!-- Tábláza címe (aktuális hónap) -->
    <th id="month" colspan="7"><?php Honapok(0); ?></th> 
</tr>
<tr>
<th>Hétfő</th>
<th>Kedd</th>
<th>Szerda</th>
<th>Csütörtök</th>
<th>Péntek</th>
<th>Szombat</th>
<th>Vasárnap</th>
</tr>
<tbody>
<tr>
<?php 
  

$numDay = date('d'); // mai nap (dátum formátumban pld nem Péntek hanem 13)
$numMonth = date('m');  // aktuális hónap száma 1-12
$numYear = date('Y'); // aktuális év
$firstDay = mktime(0,0,0,$numMonth,1,$numYear); // megadja az aktuális év és hónap első napját
$daysInMonth = cal_days_in_month(0, $numMonth, $numYear); // az aktuális évben a hónapok napszáma (főképp február miatt fontos)
$dayOfWeek = date('w', $firstDay) -1; // a hét napja
$weekend = false; // true/false, hogy hétvége vagy sem
if(0 != $dayOfWeek) { echo '<td class="empty" colspan="'.$dayOfWeek.'" title="'.Honapok(3).'">'.Honapok(3).'</td>'; } //Ha olyan hónap van ahol nem az első nap hétfő vagy hétközepén kezdődik a hónap akkor az előző napokat egy előző hónap nevével tölti ki a táblázatban.
for($i=1;$i<=$daysInMonth;$i++) { //ciklus a cellák legenerálásához (hónap napjai alapján)
if (Napok($i) == "Szombat" || Napok($i) == "Vasárnap") {$weekend = true;} else {$weekend = false;} //ha hétvége akkor weekend változó érvényesül ha nem akkor nem
if($i == $numDay) { //ha a ciklusváltozó egyenlő a mai nappal akkor egyedi cella kerül kiírásra
  echo '<td id="today" title="'.Napok($i).'">'; }
else if ($i < $numDay) { //ha a c.v. kisebb mint a mai nap akkor az elmúlt napok is egyedi cella stílust kapnak. 
  if ($weekend == true) { //ha az adott nap hétvége akkor egyedi css kivéve ha a mai nap akkor a mai nap stílusa érvényesül.
    echo '<td class="weekend" title="'.Napok($i).'">'; }
  else {
  echo '<td class="dayoff" title="'.Napok($i).'">'; }
}
else {
  if ($weekend == true) { // else ágban azok a napok kerülnek amik még a jövőben vannak ezek is egyedi stílussal rendelkeznek itt is ellenőrizzük a hétvégét.
    echo '<td class="weekend" title="'.Napok($i).'">'; }
  else {
  echo '<td title="'.Napok($i).'">'; }
}
echo $i.'</td>'; // a napok számának a kiírása
if(date('w', mktime(0,0,0,$numMonth, $i, $numYear)) == 0) { // ez az if végzi a tr mezők létrehozását az aktuális hónap kezdőnapjához mérten
echo '</tr><tr>';
}
}
switch ($dayOfWeek) 
{ // attól függően hanyadik napon kezdődik a hónap (1-7) a colspan beállítása a td-ben
  case '0': $colspan = 4; break;
  case '1': $colspan = 3; break;
  case '2': $colspan = 2; break;
  case '3': $colspan = 1; break;
}
if ($dayOfWeek < 4) // a fentebb említett colspan elvégzése a td-ben ha a hét napjai kisebb, mint 4, a 0 érték az első napot jelöli
{
echo '<td class="empty" colspan="'.$colspan.'" title="'.Honapok(4).'">'.Honapok(4).'</td>'; 
}
?>
</tr>
</tbody>
</table>
<p id="naptarjelek">Jelmagyarázat</p>
<div id="jelmagyarazat_naptar">
  <table id="naptarsnipet">
    <tr>
      <td id="today">1</td><td class="text">Az aktuális napot jelöli (Ma)</td>
    </tr>
    <tr>
      <td>1</td><td class="text">Az elkövetkezendő napokat jelöli (Holnap stb.. csak hétköznap)</td>
    </tr>
    <tr>
      <td class="weekend">1</td><td class="text">Minden hétvégi nap (Szombat, Vasárnap)</td>
    </tr>
    <tr>
      <td class="dayoff">1</td><td class="text">Az elmúlt napokat jelöli (Tegnap stb..)</td>
    </tr>
    <tr>
      <td class="empty">Jan</td><td class="text">Az elmúlt/következő hónapot jelöli (Január stb..)</td>
    </tr>
</table>
</div>
</div>