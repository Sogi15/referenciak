<?php 
if(!isset($_SESSION)) // Ha nincs session indítunk egyet
{
    session_start(); // session indító
}
$email = ""; // email változó deklarálása
$errors = array(); // error tömb a hibáknak
include_once('db.php'); // adatbázis globális változóinak bekérése
$database = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME); // csatlakozás az adatbázishoz

// Vissza gomb
if (isset($_POST['backbutton'])){
    header('Location: ../index.php');
}

// Regisztráció
if (isset($_POST['register_user'])){
    header('Location: register.php');
}
if (isset($_POST['register'])) { 
    $username = mysqli_real_escape_string($database, $_POST['username']); // f.név | email | jelszó beolvasása
    $email = mysqli_real_escape_string($database, $_POST['email']);
    $pass = mysqli_real_escape_string($database, $_POST['pass']);
  if (empty($username)) { array_push($errors, "Üres felhasználónév mező!"); } // üres mező kezelés
  if (empty($email)) { array_push($errors, "Üres E-Mail mező"); }
  if (empty($pass)) { array_push($errors, "Üres Jelszó mező!"); }
     
  // ha már létezik az adatbázisban az email cím
      $user_check = "SELECT * FROM users WHERE email='$email' LIMIT 1";
      $result = mysqli_query($database, $user_check);
      $user = mysqli_fetch_assoc($result);
      // Ha már regisztrálva van akkor hibaüzenet
      if ($user) { 
        if ($user['email'] === $email) {
          array_push($errors, "Ez az E-Mail cím már használatban van!");
        }
      }
   // Ha nincs semilyen hiba akkor az adatbázisba rögzíti az adatokat
    if (count($errors) == 0) {
        $password = password_hash($pass, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (id, email, username, password,rank)
                  VALUES('', '$email','$username', '$password','1')"; // rank 1 mert sima felhasználó regisztrál
      if ($database->query($query) === TRUE)
      {
        $_SESSION['name'] = $username;
        $_SESSION['email'] = $email;
        header('Location: ../index.php'); // ha sikeres akkor a főoldalra dob.
    }
  }
  }
  
// Bejelentkezés 
if (isset($_POST['login_user'])) {
    $loginemail = mysqli_real_escape_string($database, $_POST['email']); // változók beolvasása
    $loginpassword = mysqli_real_escape_string($database, $_POST['pass']);
  
    // üres mezők kezelése
    if (empty($loginemail)) {
        array_push($errors, "Nem írtál be E-Mail címet!");
    }
    if (empty($loginpassword)) {
        array_push($errors, "Nem írtál be Jelszót!");
    }
  
    // bejelentkezés elvégzése
    if (count($errors) == 0) {
        $passcheck = "SELECT * FROM users WHERE email LIKE '$loginemail'"; // ha az email megtalálható az adatbázisban
        $passcheck_result = mysqli_query($database, $passcheck);
        if (mysqli_num_rows($passcheck_result) == 1) {
            while($row = $passcheck_result->fetch_assoc()) {
                $passcheck_db = $row["password"]; // jelszó kiolvasása
                $username = $row['username'];
                $rank = $row['rank'];
                if(password_verify($loginpassword, $passcheck_db)) // ha a beírt jelszó egyezik az adatbázisban lévővel
                {
                    // ha rank 1 akkor fhasználó ha 0 akkor admin jelentkezett be.
                    if($rank != 1)
                    {
                        $_SESSION['admin'] = True;
                    }
                    else {
                        $_SESSION['admin'] = False;
                    }
                    $_SESSION['email'] = $loginemail;
                    $_SESSION['name'] = $username;
                    header('Location: ../index.php'); // ha sikeres akkor a főoldalra dob.
                }
                else {
                    array_push($errors, "Hibás jelszót adtál meg!");
                }
            }
        }
        else {
            array_push($errors, "Nincs ilyen felhasználó!");
        }
  }
}

function pageContent($page) { // oldalak betöltése az index.php-n belül
    if(file_exists("page/" . $page . ".php")) { // ha van file akkor az adott oldalt tölti be
          include_once("page/" . $page . ".php");
      }
      else {
          include_once("page/404.php"); // ha nincs akkor a 404-es hibakódhoz rendelt oldalt jeleníti meg
      };
  }
  

  // szó hozzáadás a magyar-angol szójátékhoz
  if (isset($_POST['wordback']))
  {
    header('Location: ../../index.php?page=tesztek');
  }

  if (isset($_POST['addword']))
  {
      $magyar = htmlspecialchars($_POST['hun_word']);
      $angol = htmlspecialchars($_POST['eng_word']);
      $magyar = strtolower($magyar);
      $angol = strtolower($angol);
      if (empty($magyar)) {
          array_push($errors, "Nem írtál be semmit!");
      }
      if (empty($angol)) {
        array_push($errors, "Nem írtál be semmit!");
    }
      if (count($errors) == 0) {
      $done = $magyar."#".$angol;
      $szokincs = fopen("../../res/szokincs.txt", "a");
      fwrite($szokincs, $done.PHP_EOL);
      fclose($szokincs);
      header('Location: ../../index.php?page=tesztek');
  }
  }

  function C_Answers($correct, $incorrect,$type) {
    echo "<h2>A játék végetért!</h2>";
    if($type == 0)
    {
        if(count($correct) > count($incorrect))
        {
        $colorclass = "bg-success bg-gradient";
        $msg = "<h4>Ügyes vagy!</h4>";
        }
        else if(count($correct) == count($incorrect)) {
            $colorclass = "bg-warning bg-gradient";
            $msg = "<h4>Nem túl jó, de nem is tragikus!</h4>";
        }
        else {
        $colorclass = "bg-danger bg-gradient";
        $msg = "<h4>Sajnos még gyakorolnod kell!</h4>";
        }
        echo "<div class='m-2 p-2 border border-dark rounded ".$colorclass."'>".$msg;
        echo "<p class='h6'>";
        if(!empty($correct))
        {
        echo "Helyes válaszok száma: <b>" . count($correct) . "</b><br>";
        }
        else {
            echo "Helyes válaszok száma: <b>0</b>";
        }
        if(!empty($incorrect))
        {
            echo "Helytelen válaszok száma: <b>" . count($incorrect) . "</b><br>";
        }
        else {
            echo "Helytelen válaszok száma: <b>0</b>";
        }
        }
        else {
            if($correct > $incorrect)
            {
            $colorclass = "bg-success bg-gradient";
            $msg = "<h4>Ügyes vagy!</h4>";
            }
            else if($correct == $incorrect) {
                $colorclass = "bg-warning bg-gradient";
                $msg = "<h4>Nem túl jó, de nem is tragikus!</h4>";
            }
            else {
            $colorclass = "bg-danger bg-gradient";
            $msg = "<h4>Sajnos még gyakorolnod kell!</h4>";
            }
            echo "<div class='m-2 p-2 border border-dark rounded ".$colorclass."'>".$msg;
            echo "<p class='h6'>";
            if(!empty($correct))
            {
            echo "Helyes válaszok száma: <b>" . $correct . "</b><br>";
            }
            else {
                echo "Helyes válaszok száma: <b>0</b><br>";
            }
            if(!empty($incorrect))
            {
                echo "Helytelen válaszok száma: <b>" . $incorrect . "</b><br>";
            }
            else {
                echo "Helytelen válaszok száma: <b>0</b><br>";
            }
            }
            echo "</p></div>";
    }
    
?>