<div class="container p-3">
<p class="pagetitle">Játékaink</p>
<h1>Válassz egy tesztet kérlek!</h1>
	<form id="english-test-form" method="GET" action="">
		<label for="englishtest"><b>Kérlek válassz játékot:</b></label>
		<select name="englishtest" id="englishtest">
			<option value="default">-- Válassz --</option>
			<option value="game1">Szókincs teszt</option>
			<option value="game2">Kiegészítős teszt</option>
			<option value="game3">Nyelvhelyességi teszt</option>
            <option value="game4">Szókirakó</option>
		</select>
		<button type="submit" class="btn btn-info" name="opengame" value="Submit">Megnyitás</button>
	</form>
 <?php
    $game = $_GET['englishtest'] ?? $game = "default";
    $default = '<div class="text-dark">
    <h3>A tesztekről egy kis infó:</h3>
    <p>Minden teszt egy külön játéknak minősűl.<br>
    A kiértékeléskor csakis az aktuálisan játszott játékban elért pontszámot látod.
    <br>Amikor véget ér egy játék a pontok nullázódnak.
    <br>Jó szórakozást és jó tanulást kívánunk!</p></div>'; // egy alapszöveg amikor még nincs kiválasztva játék!
        if($game == "default")
        {
            echo $default;
        }

		// Szókincs játék
        if ($game == 'game1')
        { 
			echo '<div class="text-dark game">
            <h2>Szókincs teszt</h2>';
    if ($_SESSION['admin'] == true)
    {echo '<a class="btn btn-primary" href="page/games/szokincsadd.php" title="Új szavak hozzáadása">Új szavak Hozzáadás</a>';}
    include_once('games/szokincs.php');
        echo '</div>';
		}
        
        // Kiegészítős játék
        elseif ($game == 'game2') {
            echo '<div class="text-dark game">
            <h2>Kiegészítős teszt</h2>';
            include_once('games/englishtest1.php');
            echo '</div>';		
        }
        
        //Nyelvtan játék
        elseif ($game == 'game3') {
            echo '<div class="text-dark game">
            <h2>Nyelvhelyességi teszt</h2>';
            include_once('games/englishtest2.php');
            echo '</div>'; 
        }

            //Szókirakó
            elseif ($game == 'game4') {
            echo '<div class="text-dark game">
                <h2>Szókirakó</h2>';
                include_once('games/englishtest3.php');
                echo '</div>'; 
            }
?> 

<script>
// Az english-test-form formot keresi meg az ID alapján
const form = document.getElementById("english-test-form");

// Eseménykezelőt ad hozzá az űrlap elküldéséhez
form.addEventListener("submit", function(event) {

  // Az esemény alapértelmezett viselkedését megakadályozza (az oldal frissítése)
  event.preventDefault();

  // Az englishtest elem értékét kéri le az űrlapból
  const game = document.getElementById("englishtest").value;

  // Az url változóba egy útvonalat generál, amely az aktuális oldalt jelöli meg és hozzáadja az englishtest értékét
  const url = `index.php?page=tesztek&englishtest=${game}`;

  // Átirányítja a böngészőt az url változóban meghatározott címre
  window.location.href = url;
});
</script>
</div>