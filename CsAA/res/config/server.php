<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
header('Content-Type: text/html; charset=utf-8');
$email = "";
$errors = array();
include_once('db.php');
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
if (isset($_POST['regback']) )
{
  header('location: ../index.php?page=workers');
}
if (isset($_POST['editback']) )
{
  header('location: ../index.php?page=user');
}

# -------------------------------------------------------------------------------------
 
if (isset($_POST['register'])) {
  $firstname = mysqli_real_escape_string($db, $_POST['fname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $pass = mysqli_real_escape_string($db, $_POST['pass']);
  $rank = mysqli_real_escape_string($db, $_POST['rank']);
  $age = mysqli_real_escape_string($db, $_POST['age']);
  $travel = mysqli_real_escape_string($db, $_POST['travel']);
  $irsz = mysqli_real_escape_string($db, $_POST['irsz']);
  $adoszam = mysqli_real_escape_string($db, $_POST['adoszam']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
if (empty($firstname)) { array_push($errors, "Üres Keresztnév mező!"); }
if (empty($lastname)) { array_push($errors, "Üres Vezetéknév mező!"); }
if (empty($age)) { array_push($errors, "Üres Születésnap mező!"); }
if (empty($email)) { array_push($errors, "Üres E-Mail mező"); }
if (empty($pass)) { array_push($errors, "Üres Jelszó mező!"); }
if (strlen($irsz) != 4 || empty($irsz)) { array_push($errors, "Hibás irányítószám mező! Az irányítószám 4 karakter hosszú számsor!"); }
if (strlen($adoszam) != 10 || empty($adoszam)) { array_push($errors, "Hibás adóazonosító mező! Az adóazonosító 10 karakter hosszú számsor!"); }
if (empty($city)) { array_push($errors, "Üres lakhely mező!"); }

    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) { 
      if ($user['email'] === $email) {
        array_push($errors, "Ez a munkás már regisztrálva van!");
      }
    }

  if (count($errors) == 0) {
  	$password = md5($pass);
  	$query = "INSERT INTO users (id, email, password)
  			  VALUES('', '$email', '$password')";
    if ($db->query($query) === TRUE)
    {
$id_check = "SELECT id FROM users WHERE email LIKE '$email'";
$result = $db->query($id_check);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $regid = $row["id"];
  }
}
    $reg = "INSERT INTO user_details (userid,firstname,lastname,rank,age,travel,irsz,adoszam,city,workedtime)
    VALUES('$regid','$firstname','$lastname','$rank','$age','$travel','$irsz','$adoszam','$city','0')";
    if ($db->query($reg) === TRUE)
    {
         header('location: ../index.php?page=workers');
      }
      else {
        echo "Hiba történt";
      }
  }
}
}


# -------------------------------------------------------------------------------------
 
if (isset($_POST['login_user'])) {
  $loginemail = mysqli_real_escape_string($db, $_POST['email']);
  $loginpassword = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($loginemail)) {
      array_push($errors, "Nem írtál be E-Mail címet!");
  }
  if (empty($loginpassword)) {
      array_push($errors, "Nem írtál be Jelszót!");
  }

  if (count($errors) == 0) {
      $loginpassword = md5($loginpassword);
      $query = "SELECT * FROM users WHERE email='$loginemail' AND password='$loginpassword'";
      $results = mysqli_query($db, $query);
      if (mysqli_num_rows($results) == 1) {
        $id_check = "SELECT id FROM users WHERE email LIKE '$loginemail'";
$result = $db->query($id_check);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $loginid = $row["id"];
  }
}
$query = "SELECT * FROM user_details WHERE userid='$loginid'";
$result = $db->query($query);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $lfirstname = $row["firstname"];
    $llastname = $row["lastname"];
    $lrank = $row["rank"];
    $lid = $row["userid"];
    $lage = $row["age"];
    $ltime = $row["workedtime"];
    $adoszam = $row["adoszam"];
    $irsz = $row["irsz"];
    $city = $row["city"];
    $travel = $row["travel"];
  }
  $query = "SELECT * FROM rank WHERE id = '$lrank'";
$result = $db->query($query);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $salary = $row["salary"];
    $bonus = $row["bonus"];}}
}
      $timenow = new DateTime('now');
      $age_now = new DateTime($lage);
      $age = $timenow->diff($age_now);
      $_SESSION['name'] = $llastname.' '.$lfirstname;
      $_SESSION['email'] = $loginemail;
      $_SESSION['rank'] = $lrank;
      $_SESSION['id'] = $lid;
      $_SESSION['age'] = $lage;
      $_SESSION['bonus'] = $bonus;
      $_SESSION['salary'] = $salary;
      $_SESSION['city'] = $city;
      $_SESSION['irsz'] = $irsz;
      $_SESSION['travel'] = $travel;
      $_SESSION['adoszam'] = $adoszam;
      $_SESSION['startworkH'] = date("H");
      $_SESSION['startworkM'] = date("i");
      $_SESSION['ageyear'] = ''.$age->y;
      $_SESSION['success'] = "Sikeresen bejelentkeztél";
      $_SESSION['workedtime'] = $ltime;
        header('location: ../index.php');
      }else {
          array_push($errors, "Rossz E-Mail/Jelszó");
      }
  }
}

# -------------------------------------------------------------------------------------
 
if (isset($_POST['editprofile_save'])) {
  $firstname = mysqli_real_escape_string($db, $_POST['fname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lname']);
  $age = mysqli_real_escape_string($db, $_POST['age']);
  $travel = mysqli_real_escape_string($db, $_POST['travel']);
  $irsz = mysqli_real_escape_string($db, $_POST['irsz']);
  $adoszam = mysqli_real_escape_string($db, $_POST['adoszam']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $id = mysqli_real_escape_string($db, $_POST['id']);
if (empty($firstname)) { array_push($errors, "Üres Keresztnév mező!"); }
if (empty($lastname)) { array_push($errors, "Üres Vezetéknév mező!"); }
if (empty($age)) { array_push($errors, "Üres Születésnap mező!"); }
if (strlen($irsz) != 4 || empty($irsz)) { array_push($errors, "Hibás irányítószám mező! Az irányítószám 4 karakter hosszú számsor!"); }
if (strlen($adoszam) != 10 || empty($adoszam)) { array_push($errors, "Hibás adóazonosító mező! Az adóazonosító 10 karakter hosszú számsor!"); }
if (empty($city)) { array_push($errors, "Üres lakhely mező!"); }

if (count($errors) == 0) {
  $query = "UPDATE user_details SET firstname = '$firstname', lastname = '$lastname', age = '$age', travel = '$travel', irsz = '$irsz', adoszam = '$adoszam', city = '$city' WHERE userid LIKE '$id'";
  if ($db->query($query) === TRUE)
  {
    $_SESSION['name'] = $lastname.' '.$firstname;
      $_SESSION['age'] = $age;
      $_SESSION['city'] = $city;
      $_SESSION['irsz'] = $irsz;
      $_SESSION['travel'] = $travel;
      $_SESSION['adoszam'] = $adoszam;
      $_SESSION['ageyear'] = date('Y-m-d') - $age;
    header('location: ../index.php?page=user');
  }
}
}

# ----------------------------------------------
if (isset($_POST['foodback'])) {
  header('location: ../index.php?page=food');
}
if (isset($_POST['foodadd'])) {

  $binary = file_get_contents($_FILES['image']['tmp_name']);
  $foodname = mysqli_real_escape_string($db, $_POST['foodname']);
  $ing = mysqli_real_escape_string($db, $_POST['ingredients']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $status = mysqli_real_escape_string($db, $_POST['status']);
  if (empty($binary)) {array_push($errors, "Nincs kiválasztva kép!");}
  if (empty($foodname)) {array_push($errors, "Nem írtál be nevet az ételnek!");}
  if (empty($ing)) {array_push($errors, "Nem írtál be listát a hozzávalókról!");}
  if (empty($price)) {array_push($errors, "Nem írtál be árat!");}
  if (count($errors) == 0) {
    $finfo = new finfo(FILEINFO_MIME);
    $type = $finfo->file($_FILES['image']['tmp_name']);
    $mime = substr($type, 0, strpos($type, ';'));
    $query = "INSERT INTO food (name,ingredients,price,status) 
    VALUES('$foodname','$ing','$price','$status')";
    if ($db->query($query) === TRUE)
    {
      $id_check = "SELECT id FROM food WHERE name LIKE '$foodname'";
      $result = $db->query($id_check);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $foodid = $row["id"];
      }
      $query = "INSERT INTO `fimg` (`id`,`data`,`mime`,`name`) 
      VALUES('$foodid','".$db->real_escape_string($binary)."',
              '".$db->real_escape_string($mime)."',
              '".$db->real_escape_string($_FILES['image']['name'])."')";
      if ($db->query($query) === TRUE)
      {
        header('location: ../index.php?page=food');
      }
        else {
          echo "Hiba történt";
        }
    }
    }
    else {
      echo 'Hiba történt!';
    }
  }
}

# ----------------------------------------------

if (isset($_POST['foodedit'])) {
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $foodname = mysqli_real_escape_string($db, $_POST['foodname']);
  $ing = mysqli_real_escape_string($db, $_POST['ingredients']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $status = mysqli_real_escape_string($db, $_POST['status']);
  $newimg = mysqli_real_escape_string($db, $_POST['newimg']);
  if ($newimg == 1)
  {
    if (empty($binary)) {array_push($errors, "Nincs kiválasztva kép!");}
    else {
    $binary = file_get_contents($_FILES['image']['tmp_name']);
    $finfo = new finfo(FILEINFO_MIME);
    $type = $finfo->file($_FILES['image']['tmp_name']);
    $mime = substr($type, 0, strpos($type, ';'));
    }
  }
  if (empty($foodname)) {array_push($errors, "Nem írtál be nevet az ételnek!");}
  if (empty($ing)) {array_push($errors, "Nem írtál be listát a hozzávalókról!");}
  if (empty($price)) {array_push($errors, "Nem írtál be árat!");}
  if (count($errors) == 0) {
    $edit_f = "UPDATE food SET name = '$foodname', ingredients = '$ing', price = '$price', status = '$status' WHERE id LIKE '$id'";
    if ($db->query($edit_f) === TRUE)
    {
      if($newimg == 1)
      {
        $a = $db->real_escape_string($binary);
        $b = $db->real_escape_string($mime);
        $c = $db->real_escape_string($_FILES['image']['name']);
        $edit_f = "UPDATE fimg SET data ='$a', mime = '$b', name ='$c' WHERE id LIKE '$id'";
        if ($db->query($edit_f) === TRUE)
        {
          header('location: ../index.php?page=food');
        }
        else {
          echo 'hiba történt!';
        }
      }
      else {
        header('location: ../index.php?page=food');
      }
    }
  }
}

#---------------------------
if (isset($_POST['fooddelete'])) {

  $delif = mysqli_real_escape_string($db, $_POST['food_del']);
  $id = mysqli_real_escape_string($db, $_POST['id']);
  if ($delif == 1)
  {
    $del = "DELETE FROM food WHERE id LIKE '$id'";
    if ($db->query($del) === TRUE)
    {
      $del = "DELETE FROM fimg WHERE id LIKE '$id'";
      if ($db->query($del) === TRUE)
      {
        header('location: ../index.php?page=food');
      }
      else {
        echo 'Hiba történt!';
      }
    }
  }
  else {
    header('location: ../index.php?page=food');
  }
}

#----------------------
if (isset($_POST['wo_delete'])) {
  $delif = mysqli_real_escape_string($db, $_POST['worker_del']);
  $id = mysqli_real_escape_string($db, $_POST['id']);
  if ($delif == 1)
  {
    $wdel = "DELETE FROM user_details WHERE userid LIKE '$id'";
    if ($db->query($wdel) === TRUE)
    {
      $wdel = "DELETE FROM users WHERE id LIKE '$id'";
      if ($db->query($wdel) === TRUE)
      {
        header('location: ../index.php?page=workers');
      }
      else {
        echo 'Hiba történt!';
      }
    }
  }
  else {
    header('location: ../index.php?page=workers');
  }
}
  ?>