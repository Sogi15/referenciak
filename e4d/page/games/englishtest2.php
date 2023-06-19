<?php
  $errors = array();
  $endgame = false;
// Ellenőrizzük, hogy a form elküldésekor lett-e bejegyzés
if (isset($_POST['englishtest2'])) {
    $correct_answers = array();
    $incorrect_answers = array();

  // Ellenőrizzük, hogy a formból elküldött adatok tartalmazzák-e a helyes válaszokat
  if(empty($_POST["q1"])) { array_push($errors, "Első kérdésre nem adtál választ!");}
  if(empty($_POST["q2"])) { array_push($errors, "Második kérdésre nem adtál választ!");}
  if(empty($_POST["q3"])) { array_push($errors, "Harmadik kérdésre nem adtál választ!");}
  if(empty($_POST["q4"])) { array_push($errors, "Negyedik kérdésre nem adtál választ!");}
  if(empty($_POST["q5"])) { array_push($errors, "Ötödik kérdésre nem adtál választ!");}
  if(empty($_POST["q6"])) { array_push($errors, "Hatodik kérdésre nem adtál választ!");}

  if(count($errors) == 0)
{
    // 1. kérdés válasz ellenőrzés
    if (isset($_POST["q1"]) && $_POST["q1"] == "4") {
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
  if (isset($_POST["q3"]) && $_POST["q3"] == "2") {
    $correct_answers[] = $_POST["q3"];
  } else {
    $incorrect_answers[] = $_POST["q3"];
  }
    // 4. kérdés válasz ellenőrzés
  if (isset($_POST["q4"]) && $_POST["q4"] == "3") {
    $correct_answers[] = $_POST["q4"];
  } else {
    $incorrect_answers[] = $_POST["q4"];
  }
  // 5. kérdés válasz ellenőrzés
  if (isset($_POST["q5"]) && $_POST["q5"] == "1") {
    $correct_answers[] = $_POST["q5"];
  } else {
    $incorrect_answers[] = $_POST["q5"];
  }
    // 6. kérdés válasz ellenőrzés
    if (isset($_POST["q6"]) && $_POST["q6"] == "1") {
      $correct_answers[] = $_POST["q6"];
    } else {
      $incorrect_answers[] = $_POST["q6"];
    }
  $endgame = true;
}
}
?>
<form method="POST">
		<p class="h4">Olvasd el a következő mondatokat és válaszd ki a helyes kiegészítést:</p>
        <?php include('config/errors.php'); ?>
		<ol>
			<li>
      <span class="h5">I <b>______</b> to school every day.</span>
				<br>
				<input type="radio" name="q1" value="1" required>Gone
				<input type="radio" name="q1" value="2">Goes
				<input type="radio" name="q1" value="3">Going
        <input type="radio" name="q1" value="4">Go
			</li>
			
			<li>
      <span class="h5">She <b>_____</b> breakfast at 7 o'clock.</span>
				<br>
				<input type="radio" name="q2" value="1" required>Had
				<input type="radio" name="q2" value="2">Have
				<input type="radio" name="q2" value="3">Has
        <input type="radio" name="q2" value="4">Having
			</li>
			
			<li>
      <span class="h5">They <b>_____</b> in New York for five years.</span>
				<br>
				<input type="radio" name="q3" value="1" required>Lives
				<input type="radio" name="q3" value="2">Live
				<input type="radio" name="q3" value="3">Lived
        <input type="radio" name="q3" value="4">Living
			</li>
            <li>
            <span class="h5">I <b>_____</b> tennis twice a week.</span>
                <br>
				<input type="radio" name="q4" value="1" required>Plays
				<input type="radio" name="q4" value="2">Played
				<input type="radio" name="q4" value="3">Play
                <input type="radio" name="q4" value="4">Playing
			</li>
            <li>
            <span class="h5">He is <b>_____</b> a book right now.</span>
                <br>
				<input type="radio" name="q5" value="1" required>Reading
				<input type="radio" name="q5" value="2">Read
				<input type="radio" name="q5" value="3">Reads
        <input type="radio" name="q5" value="4">To read
			</li>
      <li>
      <span class="h5">I cannot believe how <b>_____</b> this view is.</span>
                <br>
				<input type="radio" name="q6" value="1" required>Beautiful
				<input type="radio" name="q6" value="2">Colorful
				<input type="radio" name="q6" value="3">Crowded
        <input type="radio" name="q6" value="4">Delicious
			</li>
            </ol>
		<button type="submit" class='btn btn-warning' name="englishtest2">Kiértékelés</button>
	</form>
    <?php
    // Kiírjuk a statisztikát
    if($endgame)
    {
      C_Answers($correct_answers,$incorrect_answers,0);
    }
    ?>