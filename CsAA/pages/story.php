<?php
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
$idk = array(3,19,20); // adatbázisban található személyek id-je
foreach ($idk as $key => $value) {
    // ciklus az adatbázisból a személyek nevének a kiolvasására, hogy a leírásokban helyesen legyenek beírva a nevek
    $query = "SELECT lastname,firstname FROM user_details WHERE userid = $value";
    $results = mysqli_query($db, $query);
if ($results->num_rows > 0) {
    while($row = $results->fetch_assoc()) {
        $name[$key] = $row['lastname'].' '.$row['firstname'];
    }
}
}
// rank lekérése a $_session változóból.
$rank = $_SESSION['rank'];
?>
<h1 class="h1">Történet</h1>
<div id="story">
<ol>
    <li><a href="#bevezetes">Bevezetés</a></li>
    <li><a href="#restaurant">Az étterem története</a></li>
    <li><a href="#idea">Az ötlet története</a></li>
    <li><a href="#work">A megvalósítás története</a></li>
</ol>
<div id="storylinemerch">
<img src="https://t31556852.p.clickup-attachments.com/t31556852/e8898ffe-ec8b-4d31-9aaa-f80c66de2a16_medium.png" alt="C$-A-A Kasszarendszer" Title="C$-A-A Logó">
<div id="logostring" title="C$-A-A Logó">C<span class="lgreen">$</span>-A-A Kasszarendszer</div>
</div>

<h2 id="bevezetes">Bevezetés</h2>
<p>A <b>C<span class="lgreen">$</span>-A-A Kasszarendszer</b> lényege egy olyan letisztult alkalmazás, amely
segít az éttermek, jelen esetben gyorséttermek kasszagép szoftverének az üzemeltetésében. Az ötlet innen indult,
de erről majd a későbbiekben beszélünk! A weboldal ahol most ezt a kis leírást olvasod, a <b>Kasszarendszer</b> felhasználói felülete.
Röviden és tömören nézve a weblap azt a célt szolgálja, hogy itt tudják a tulajdonosok és üzletvezetők szerkeszteni a beosztást,
a dolgozókat (hozzáadni, elbocsátani, adatot módosítani stb..) és persze a bérpapírt is megkapjuk itt digitális formában.
Rangtól függetlenül, be tudsz jelentkezni az email címeddel és a kapott/választott jelszavaddal az oldalra. Persze beosztástól függ, milyen funkciókat érsz el a felületen belül.
Ez az oldal, leginkább az eddigi munkánk dokumentálását is szolgálja, digitalizált formában.<br>
<b>Figyelem!</b><br>
</p>
<h2 id="restaurant">Az étterem története</h2>
<p>A <b>C<span class="lgreen">$</span>-A-A</b> gyorsétteremlánc ötlete, három csapattag fejéből pattant ki.
A csapat: <b><?php echo $name[0]; ?></b>, <b>Csaba</b> és <b>Ákos</b>,
Itt jöhet a kérdés, de akkor miért <b>C<span class="lgreen">$</span>-A-A</b> és, miért nem <b>C<span class="lgreen">$</span>-Á-A</b>?
A kérdésre a válasz egyszerű, nézzük meg a két írásmód közti különbséget, azért a <b>C<span class="lgreen">$</span>-A-A</b> jobban hangzik nem?
Illetve nyomós indok, hogy az angol ABC-ben nincs ékezet, így az <b>Ákos</b> név az angoloknál <b>Akos</b> lenne. Persze tudjuk, hogy neveknél ez nem így van, de kezdőbetűknél előfordulhat.
Kanyarodjunk vissza az eredeti témánkhoz, a gyorsétteremlánc 2022 októberében került megalapításra és azóta is örömmel fogadja elkápráztatóan finom ételeivel a vendégeket!</p>
<h2 id="idea">Az ötlet története</h2>
<p>Az előző címkéknél nagyjából már leírtam, miről is szól az ötletünk,
    de azt hiszem érdemes megemlíteni azt is, hogy mivel a leggyakoribb projektmunkák a mozikról,
    webshopokról szól, így eléggé adta magát, hogy ez valamivel egyedibb. Mindent összevetve,
    az ötlet abból indult ki, hogy <b>Csaba</b> a projekt készítése alatt,
    egy gyorsétteremben dolgozott. Az ottani kassza szoftvere és rendszere nem túl megbízható.
    Ez csak az alkalmazás része a dolognak és ezt a gondolatot folytattuk azzal, hogy mi lenne
    ha webes felületen lenne a karbantartása a szoftver adatainak. Itt a weblapon tudnák a jogosultak
    alakítani, kik férnek hozzá a kassza szoftverhez stb. Végül egy saját éttermet is kitaláltunk a projekthez,
    ahol alkalmazzuk ezt a szoftvert és persze így a weboldal célja még tovább fejlődött. A tulajdonosok
    itt tudják szerkeszteni az étterem fontosabb dolgait, mint például a dolgozók adatait, az ételeket,
    és persze a bérpapír is itt kerül kimutatásra. Minden funkciót részletesebben leírok majd a megvalósításnál.</p>
<h2 id="work">A megvalósítás története</h2>
<p>Én <b><?php echo $name[0]; ?></b> szerkesztettem a weboldalt, dizájnoltam és fejlesztettem.
    Kezdjünk is bele talán a funkció leírásokba.<br>
    <b>1. Főoldal:</b> A Főoldal, minden weblap kulcsa. Egy üdvözlő oldal, ahol a bejelentkezésünk után láthatjuk a céges kártyánkat és az aktuális promóciós ételt, illetve az új dolgozókat.<br>
    <b>2. Profil:</b> Lehetőségünk van arra, hogy szerkesszük a profilunkat, illetve a bérjegyzékünket is itt tudjuk megtekínteni. Az órabérünk és a bónuszaink, valamint személyes adataink is itt láthatóak. A bérjegyzék érdekessége, hogy mindent levezetve kiadja nekünk a dolgozott órák alapján, hogy mennyi pénzt kerestünk az aktuális hónapban. A mai törvényeknek megfelelően, a 25 év alatti dolgozók béréből, nem vonjuk le a SZJA-t.<br>
    <b>3. Munkarend:</b> A naptár megmutatja, hogy mely napokon vagyunk kötelesek dolgozni, és mely napok szabadnapok. Az étterem dolgozói szerződése alapján, minden hétköznap munkának, minden hétvége szabadnapnak minősül.<br>
    <b>3. Elérhetőségek:</b> Ezen az oldalon tudod lekérni, a megfelelő illetékesek elérhetőségeit.<br>
    <b>3. Történet:</b> Jelenleg ezt az oldalt olvasod. Minden információ a projektről és az étteremről, illetve egy bemutatása az oldal működésének.<br>
    <b>3. Étlap:</b> Az oldalon megtalálható éttermünk étlapja, az elérhető és jelenleg inaktív ételeket mutatva, árakkal és az összetevőkkel együtt. 
    <?php if($rank <= 2) {echo 'Az illetékeseknek jogukban áll szerkeszteni, akár törölni vagy hozzáadni új ételeket.<br>';
    echo '<b>4. Dolgozók:</b> Lista azokról, akik a cégünknél aktívak jelenleg. Itt szerkesztheted az adataikat, alkamazhatsz új embereket vagy elbocsáthatod a dolgozókat.';}?>
    <b><br>4. Kijelentkezés:</b> Ha végeztél a műszakoddal, akkor fontos, hogy kijelentkezz az oldalról is, hiszen csak akkor számitanak a ledolgozott óráid, ha elfelejtesz kijelentkezni, mintha itt se lettél volna!
</p>
</div>
