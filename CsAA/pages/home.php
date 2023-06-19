<?php
// session változók az adatok leírásához (kártyához lentebb)
$id = $_SESSION["id"];
$age = $_SESSION["age"];
$ageyear = $_SESSION["ageyear"];
$rank = $_SESSION["rank"];
$user = $_SESSION['name'];

$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
$query = "SELECT * FROM user_details ORDER BY userid DESC LIMIT 1"; //adatok kiolvasása
$results = mysqli_query($db, $query);
if ($results->num_rows > 0) {
    while($row = $results->fetch_assoc()) {
        $newfname = $row['firstname'];
        $newname = $row['lastname'].' '.$row['firstname'];
    }
}
header('Content-Type: text/html; charset=utf-8');
?>
<div id="home">
<h1 class="h1">Üdvözöllek: <a href="index.php?page=user" id="user" title="<?php $user; ?>"><?php echo $user ?></a></h1>
<div class="card">
    <div id="details">
    <div id="avatar">
    <img src="https://t31556852.p.clickup-attachments.com/t31556852/e8898ffe-ec8b-4d31-9aaa-f80c66de2a16_medium.png" alt="C$AA Kasszarendszer" Title="C$AA Logó">
    </div>
    <div id="name"><p><?php echo $user.' #'.$id; ?><br><span><b>Kor:</b> <?php echo $age.' ('.$ageyear.')'; ?></span><br><span><b>Beosztás:</b> <?php Rank_Array($rank,1); ?></span></p>
</div>
</div>
<div id="merch">
<p>C<span class="lgreenfilter">$</span>-A-A Kasszarendszer</p>
</div>
</div>
<h2>Legújabb dolgozónk...</h2>
<p>Üdvözöljük legújabb tagunkat! <b><?php echo $newname; ?></b> nemrég kezdte pályafutását a mi kis cégünknél.<br>
<b><?php echo $newfname; ?></b> egy kiváló munkás, reméljük hamar beilleszkedik a mi kis közösségünkbe.<br>
Ha esetleg találkoznál vele, a cég nevébe is kérjük üdvözöld csapatunk új tagját! - <b>Sz.A.</b></p>
<h2>Új promóciós ételünk...</h2>
<div id="promofood">
<?php
$idcheck = "SELECT id FROM food";
$result = $db->query($idcheck);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $promo_id[] = $row['id'];
    }
}

$foodid = $promo_id[array_rand($promo_id)];
$sql = "SELECT food.name, food.price, fimg.data FROM food JOIN fimg ON food.id = fimg.id WHERE status LIKE 0 AND food.id LIKE $foodid";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<table><tr>
        <td id="imgleft"><img src="data:image/png;base64,'.base64_encode( $row['data'] ).'"/></td>
        <td id="textright"><h3>Próbáltad már?</h3> Eszméletlen finom és eszméletlen kívánatos!<br>
        Legújabb promóciónkban csak <b>'.$row['price'].' FT</b> áron kóstolhatod meg a következő ételünket: <b>'.$row['name'].'</b><br>Jó étvágyat hozzá! - <b>Sz.A.<b></td>
        </tr></table>';
    }
}
else{
    echo '<p>Jelenleg nincs promóciós ételünk!</p>';
}
?>
</div>
</div>