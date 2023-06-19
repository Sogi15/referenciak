<?php 
header('Content-Type: text/html; charset=utf-8');
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
?>
<div id="food">
<h1 class="h1">Étlap</h1>
<?php 
if ($_SESSION['rank'] <= 2)
{
echo ' <div id="buttons" class="mnone">
<a href="pages/foodadd.php" title="Étel hozzáadása">Hozzáadás</a>
<a href="pages/foodedit.php" title="Étel Szerkesztése">Szerkesztés</a>
</div>';}
?>
<?php
echo '<table>
<tr>
<th>Fotó</th><th>Név</th><th>Hozzávalók</th><th>Ár</th></tr>';
$sql = "SELECT food.name, food.id, food.ingredients, food.price, fimg.data FROM food JOIN fimg ON food.id = fimg.id WHERE status LIKE 0";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<tr><td><img src="data:image/png;base64,'.base64_encode( $row['data'] ).'"/></td>
        <td>'.$row['name'].'</td>
        <td class="ing">'.$row['ingredients'].'</td>
        <td>'.$row['price'].' Ft</td></tr>';
    }
}
else{
    echo '<td colspan="5">Nincs elérhető adat!</td></tr>';
}
echo '</table>';
echo '<h2>Jelenleg nem elérhető ételek</h2>';
echo '<table id="inactive">
<tr>
<th>Fotó</th><th>Név</th><th>Hozzávalók</th><th>Ár</th></tr>';
$sql = "SELECT food.name, food.id, food.ingredients, food.price, fimg.data FROM food JOIN fimg ON food.id = fimg.id WHERE status LIKE 1";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<tr><td><img src="data:image/png;base64,'.base64_encode( $row['data'] ).'"/></td>
        <td>'.$row['name'].'</td>
        <td class="ing">'.$row['ingredients'].'</td>
        <td>'.$row['price'].' Ft</td></tr>';
    }
}
else{
    echo '<td colspan="5">Nincs elérhető adat!</td></tr>';
}
echo '</table>';
?>
</div>
