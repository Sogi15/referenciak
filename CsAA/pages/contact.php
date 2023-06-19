<h1 class="h1">Elérhetőségek</h1>
<div id="contactcard">
<?php
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
// adatok kiolvasás az adatbázisból az elérhetőségi kártyák legenerálásához
//csak a műszakvezető lehet a legkisebb rang hisz a tréner és dologzó nem számít olyan kezelőnek az oldalon aki befolyásolja a munkavégzést.
$query = "SELECT * FROM user_details JOIN users ON users.id = user_details.userid WHERE rank <= 3 ORDER BY rank";
$result = $db->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        //kiolvasás közben generálja a kártyát a főoldali sablon alapján
        $rank = $row["rank"];
        $name = $row["lastname"]." ".$row["firstname"];
        // a kor kiszámítása azáltal, hogy a mai dátumból kivonja a születési dátumot és vissza adja az évet.
        $timenow = new DateTime('now');
        $age_now = new DateTime($row["age"]);
        $age_diff = $timenow->diff($age_now);
        $age = ''.$age_diff->y;
        echo '<div class="card">
        <div id="details">
        <div id="avatar">
        <img src="https://t31556852.p.clickup-attachments.com/t31556852/e8898ffe-ec8b-4d31-9aaa-f80c66de2a16_medium.png" alt="C$AA Kasszarendszer" Title="C$AA Logó">
        </div>
        <div id="name"><p>'.
        $name.' #'.$row["id"].
       '<br><span><b>Kor: </b>'.
        $row["age"].' ('.$age.')
    </span><br><span><b>Beosztás: </b>';Rank_Array($rank,1);
echo '</span><br><span><a href="mailto:'.$row["email"].'">'.$row["email"].'</a></span></p>
    </div>
    </div>
    <div id="merch">
        <p>C<span class="lgreenfilter">$</span>-A-A Kasszarendszer</p>
    </div>
    </div><br>';
      }
}
?>
</div>