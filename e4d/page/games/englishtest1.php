<?php
  $errors = array();
  $endgame = false;
// Ellenőrizzük, hogy a form elküldésekor lett-e bejegyzés
if (isset($_POST['englishtest1'])) {
    $correct_answers = array();
    $incorrect_answers = array();

  // Ellenőrizzük, hogy a formból elküldött adatok tartalmazzák-e a helyes válaszokat
  if(empty($_POST["q1"])) { array_push($errors, "Első kérdésre nem adtál választ!");}
  if(empty($_POST["q2"])) { array_push($errors, "Második kérdésre nem adtál választ!");}
  if(empty($_POST["q3"])) { array_push($errors, "Harmadik kérdésre nem adtál választ!");}
  if(empty($_POST["q4"])) { array_push($errors, "Negyedik kérdésre nem adtál választ!");}
  if(empty($_POST["q5"])) { array_push($errors, "Ötödik kérdésre nem adtál választ!");}
  if(empty($_POST["q6"])) { array_push($errors, "Hatodik kérdésre nem adtál választ!");}
  if(empty($_POST["q7"])) { array_push($errors, "Hetedik kérdésre nem adtál választ!");}
  if(empty($_POST["q8"])) { array_push($errors, "Nyolcadik kérdésre nem adtál választ!");}
  if(empty($_POST["q9"])) { array_push($errors, "Kilencedik kérdésre nem adtál választ!");}
  if(empty($_POST["q10"])) { array_push($errors, "Tizedik kérdésre nem adtál választ!");}

  if(count($errors) == 0)
{
    // 1. kérdés válasz ellenőrzés
    if (isset($_POST["q1"]) && $_POST["q1"] == "2") {
    $correct_answers[] = $_POST["q1"];
  } else {
    $incorrect_answers[] = $_POST["q1"];
  }
    // 2. kérdés válasz ellenőrzés
  if (isset($_POST["q2"]) && $_POST["q2"] == "3") {
    $correct_answers[] = $_POST["q2"];
  } else {
    $incorrect_answers[] = $_POST["q2"];
  }
    // 3. kérdés válasz ellenőrzés
  if (isset($_POST["q3"]) && $_POST["q3"] == "1") {
    $correct_answers[] = $_POST["q3"];
  } else {
    $incorrect_answers[] = $_POST["q3"];
  }
    // 4. kérdés válasz ellenőrzés
  if (isset($_POST["q4"]) && $_POST["q4"] == "4") {
    $correct_answers[] = $_POST["q4"];
  } else {
    $incorrect_answers[] = $_POST["q4"];
  }
  // 5. kérdés válasz ellenőrzés
  if (isset($_POST["q5"]) && $_POST["q5"] == "2") {
    $correct_answers[] = $_POST["q5"];
  } else {
    $incorrect_answers[] = $_POST["q5"];
  }
    // 6. kérdés válasz ellenőrzés
  if (isset($_POST["q6"]) && $_POST["q6"] == "3") {
    $correct_answers[] = $_POST["q6"];
  } else {
    $incorrect_answers[] = $_POST["q6"];
  }
    // 7. kérdés válasz ellenőrzés
  if (isset($_POST["q7"]) && $_POST["q7"] == "1") {
    $correct_answers[] = $_POST["q7"];
  } else {
    $incorrect_answers[] = $_POST["q7"];
  }
      // 8. kérdés válasz ellenőrzés
  if (isset($_POST["q8"]) && $_POST["q8"] == "4") {
    $correct_answers[] = $_POST["q8"];
  } else {
    $incorrect_answers[] = $_POST["q8"];
  }
      // 9. kérdés válasz ellenőrzés
  if (isset($_POST["q9"]) && $_POST["q9"] == "2") {
    $correct_answers[] = $_POST["q9"];
  } else {
    $incorrect_answers[] = $_POST["q9"];
  }
      // 10. kérdés válasz ellenőrzés
  if (isset($_POST["q10"]) && $_POST["q10"] == "3") {
    $correct_answers[] = $_POST["q10"];
  } else {
    $incorrect_answers[] = $_POST["q10"];
  }
  $endgame = true;
}
}
?>

<form method="POST" id="game2">
		<p class="h4">Olvasd el a következő mondatokat és válaszd ki a helyes kiegészítést:</p>
        <?php include('config/errors.php'); ?>
		<ol>
			<li>
				<span class="h5">My brother is a <b>______</b>.</span>
				<br>
				<input type="radio" name="q1" value="1" required>Mouse
				<input type="radio" name="q1" value="2">Doctor
				<input type="radio" name="q1" value="3">Destroy
        <input type="radio" name="q1" value="4">Octopus
			</li>
			
			<li>
      <span class="h5">I am going to the <b>______</b> to buy some vegetables.</span>
				<br>
				<input type="radio" name="q2" value="1" required>Battle
				<input type="radio" name="q2" value="2">Hospital
				<input type="radio" name="q2" value="3">Supermarket
        <input type="radio" name="q2" value="4">Field
			</li>
			
			<li>
      <span class="h5">The capital of France is <b>______</b>.</span>
				<br>
				<input type="radio" name="q3" value="1" required>Paris
				<input type="radio" name="q3" value="2">London
				<input type="radio" name="q3" value="3">Rome
                <input type="radio" name="q3" value="4">Budapest
			</li>
            <li>
            <span class="h5">The <b>______</b> is the largest animal on land.</span>
                <br>
				<input type="radio" name="q4" value="1" required>T-Rex
				<input type="radio" name="q4" value="2">Shark
				<input type="radio" name="q4" value="3">Dog
                <input type="radio" name="q4" value="4">Elephant
			</li>
            <li>
            <span class="h5">I love to eat <b>______</b> with peanut butter and jelly.</span>
                <br>
				<input type="radio" name="q5" value="1" required>Milk
				<input type="radio" name="q5" value="2">Bananas
				<input type="radio" name="q5" value="3">Lasagne
                <input type="radio" name="q5" value="4">Beer
			</li>
            <li>
            <span class="h5">The <b>______</b> is a musical instrument in the brass family.</span>
                <br>
				<input type="radio" name="q6" value="1" required>Metalica
				<input type="radio" name="q6" value="2">Firewater
				<input type="radio" name="q6" value="3">Trumpet
                <input type="radio" name="q6" value="4">Bark
			</li>
            <li>
            <span class="h5">The <b>______</b> is the capital of Italy.</span>
                <br>
				<input type="radio" name="q7" value="1" required>Rome
				<input type="radio" name="q7" value="2">Berlin
				<input type="radio" name="q7" value="3">Debrecen
                <input type="radio" name="q7" value="4">Manchester
			</li>
            <li>
            <span class="h5">I need to buy a new pair of <b>______</b> for the summer.</span>
            <br>
				<input type="radio" name="q8" value="1" required>Beer
				<input type="radio" name="q8" value="2">Boots
				<input type="radio" name="q8" value="3">Glass
                <input type="radio" name="q8" value="4">Sandals
			</li>
            <li>
            <span class="h5">The <b>______</b> is a bird known for its beautiful singing voice.</span>
            <br>
				<input type="radio" name="q9" value="1" required>Hyena
				<input type="radio" name="q9" value="2">Canary
				<input type="radio" name="q9" value="3">Boar
                <input type="radio" name="q9" value="4">Pelican
			</li>
            <li>
            <span class="h5">In the game of chess, the <b>______</b> is the most powerful piece on the board.</span>
            <br>
				<input type="radio" name="q10" value="1" required>Peasant
				<input type="radio" name="q10" value="2">King
				<input type="radio" name="q10" value="3">Queen
                <input type="radio" name="q10" value="4">Horse
			</li>
		</ol>
		<button type="submit" class='btn btn-warning' name="englishtest1">Kiértékelés</button>
	</form>
    <?php
    // Kiírjuk a statisztikát
    if($endgame)
    {
      C_Answers($correct_answers,$incorrect_answers,0);
    }
    ?>