<?php
// ha nem egy minimum 1-2 (tulaj/üzletvezető van bejelentkezve s valamilyen formában erre az oldalra lép akkor login.php-re vezeti) 
if (!isset($_SESSION['email']) || $_SESSION['rank'] > '2') {
	header('Location: login.php');
	}
$rank = $_SESSION['rank'];
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
$query = "SELECT * FROM users JOIN user_details ON users.id=user_details.userid ORDER BY user_details.rank ASC"; //adatok kiolvasása
$results = mysqli_query($db, $query);
if ($results->num_rows > 0) {
    while($row = $results->fetch_assoc()) {
        $w_id[] = $row['id'];
        $w_email[] = $row['email'];
        $w_name[] = $row['lastname'].' '.$row['firstname'];
        $w_rank[] = $row['rank'];
        $w_age[] = $row['age'];
        $w_travel[] = $row['travel'];
        $w_city[] = $row['irsz'].' '.$row['city'];
        $w_ado[] = $row['adoszam'];
    }
}
foreach ($w_travel as $key => $value) {
    if ($value == 1) // kiíráshoz egy if elágazás ha bejárós és ha nem mit írjon ki.
{
    $travel_w[$key] = "Bejárós";
}
else {
    $travel_w[$key] = "Helyi";
}
}
$timenow = new DateTime('now');
foreach ($w_age as $key => $value) {
    $age_now[$key] = new DateTime($value);
    $age[$key] = $timenow->diff($age_now[$key]);
    $age_w[$key] = ''.$age[$key]->y;
}

?>
<div id="workers">
<h1 class="h1">Dolgozók</h1>
<p>Minden dolgozó adata. Lehetőség van új munkások hozzáadására, illetve meglévő munkások törlésére.
<br>A munkások a saját profiljaikat szerkeszthetik.
<br>Biztonsági okokból a vezetők nem tehetik meg, hogy a munkások adatait módosítsák.</p>
<table class="mnone">
<?php
// rank korlátozás, hogy csak bizonyos emberek adhassanak/törölhessenek embereket
if($rank <= 2)
{
echo '<tr><td colspan="7" class="buttontd mnone"><a href="pages/register.php" title="Új dolgozó regisztrálása">Új dolgozó hozzáadása</a></td></tr>
<tr><td colspan="7" class="buttontd mnone"><a href="pages/workerdelete.php" title="Egy dolgozó elbocsájtása">Dolgozó törlése</a></td></tr>';
}
?>
<tr>
    <th class="id" title="Azonosító">ID</th>
    <th title="Név" class="name">Név</th>
    <th title="Életkor" class="age">Kor</th>
    <th title="E-mail" class="email">E-Mail</th>
    <th title="Lakhely (Város)" class="city">Lakhely</th>
    <th title="Utazás" class="travel">Bejárás</th>
    <th title="Beosztás" class="rank">Beosztás</th>
</tr>
<form action="workers.php" method="post">
<?php
// adatok kiírása az átadott változók alapján
foreach ($w_id as $key => $value) {
    echo '<tr><td class="id"><input type="text" value="'.$value.'" name="w_userid" readonly></td>
    <td class="name">'.$w_name[$key].'</td>
    <td class="age" title="'.$age_w[$key].' Éves">'.$w_age[$key].'</td>
    <td class="email">'.$w_email[$key].'</td>
    <td class="city">'.$w_city[$key].'</td>
    <td class="travel">'.$travel_w[$key].'</td>
    <td class="rank">';Rank_Array($w_rank[$key],1);echo '</td></tr>';
}
?>
</form>
</table>

<table class="mdis">
<tr>
    <th class="id" title="Azonosító">ID</th>
    <th title="Név" class="name">Név</th>
    <th title="Lakhely (Város)" class="city">Lakhely</th>
    <th title="Beosztás">Beosztás</th>
</tr>
<form action="workers.php" method="post">
<?php
foreach ($w_id as $key => $value) {
    echo '<tr><td class="id"><input type="text" value="'.$value.'" name="w_userid" readonly></td>
    <td class="name">'.$w_name[$key].'</td>
    <td class="city">'.$w_city[$key].'</td>
    <td>';Rank_Array($w_rank[$key],1);
    echo '</td></tr>';
}
?>
</form>
</table>
</div>