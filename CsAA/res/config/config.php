<?php
include "server.php";
//rang rendszer a kiolvasott rank alapján, lényegében a numerikus adatot striggé alakítja át.
function Rank_Array($rankT,$type) {
  $ranks = array(
    '1' => 'Tulajdonos',
    '2' => 'Üzletvezető',
    '3' => 'Műszakvezető',
    '4' => 'Tréner',
    '5' => 'Dolgozó',
  );
  //1. típus ahl a select tagen belüli opció listába kerül kiírásra
  if($type == 0)
  {
    foreach($ranks as $id => $rank) {
      if($rankT == $id)
      {$select = "selected";}
      else {
        $select = "";
      }
      echo '<option value="'.$id.'"'.$select.'>'.$rank.'</option>';
    }
  }
  //2. ha csak 1 adatot akarunk kiírni 
  else if($type == 1){
    foreach($ranks as $id => $rank) {
      if($rankT == $id)
      {echo $rank;}
    }
  }
    return $rankT;
  }

  // hasonló a ranghoz csak itt az utazásról szól a function
  function Travel_details($travelT) {
    $travels = array(
      '0' => 'Helyi',
      '1' => 'Bejárós',
    );
    
      foreach($travels as $id => $travel) {
        if($travelT == $id)
        {$select = "selected";}
        else {
          $select = "";
        }
        echo '<option value="'.$id.'"'.$select.'>'.$travel.'</option>';
      }
      return $travelT;
    }

    //a php oldalak meghívása az index.php body-ján belül így nem kell minden oldalon létrehozni a css-t és menü rendszert.
function pageContent($pageT) {
  if(file_exists("pages/" . $pageT . ".php")) {
		include_once("pages/" . $pageT . ".php");
	}
    else {
		include_once("pages/404.php");
	};
};

// napok lekérdezése ahol az aktuális napot kiolvasva visszakapjuk a nap nevének a 3 kezdőbetűjét angolul amit honosítunk
function Napok($dayT) {
  $day = date("Y-m-$dayT"); // date függvénnyel kiírt dátum a beadott szám alapján pld (2023-01-12)
  $dayname = date('D', strtotime($day)); // Angolul kiírja a strtotime a nap nevének első 3 betűjét
  $name = "Error"; // változó a nap nevéhez alap érték csak azért error, mert ha valami hiba lenne.
  switch ($dayname)
  {
    // az angol név alapján át alakított napok nevei
    case "Mon": $name = "Hétfő"; break;
    case "Tue": $name = "Kedd"; break;
    case "Wed": $name = "Szerda"; break;
    case "Thu": $name = "Csütörtök"; break;
    case "Fri": $name = "Péntek"; break;
    case "Sat": $name = "Szombat"; break;
    case "Sun": $name = "Vasárnap"; break;
  }
  return $name;
}

//hónapok kiiratása különböző metódusokba
function Honapok($monthnumT) {
  $months = array('Január', 'Február', 'Március', 'Április', 'Május', 'Június', 'Julius', 'Augusztus','Szeptember','Október','November','December'); // hónap nevei
  $months_n = array('31','28','31','30','31','30','31','31','30','31','30','31'); // hónapok napszáma
  $month_number = date('m'); //aktuális hónap száma (1-12)
  if ($monthnumT == 0)
  {
    //aktuálic hónap neve (pld január)
    echo $months[$month_number-1];
  } 
  else if ($monthnumT == 1)
  {
    //aktuális hónap + év (március. 2023 pld)
    echo $months[$month_number-1]." ".date('Y');
  }
  else if ($monthnumT == 2)
  {
    //aktuális hónap napjainak a száma (pld 31)
    return $months_n[$month_number-1];
  }
  else if ($monthnumT == 3)
  {
    // előző hónap
    return $months[$month_number-2];
  } 
  else if ($monthnumT == 4)
  {
    //következő hónap
    return $months[$month_number-0];
  }
  // Payment.php-hez szükséges részlet 
  else if ($monthnumT == 5)
  {
    // a hónap első napja és utolsó napja ebben a formátumban pld (2023.01.1-2023.01.31)
    echo date('Y').'.'.$month_number.'.01 - '.date('Y').'.'.$month_number.'.'.$months_n[$month_number-1];
  }
  else if ($monthnumT == 6)
  {
    // a hónap aktuális napja a pontos dátummal (2023.01.23 pld)
    echo date('Y').'.'.$month_number.'.'.date('d');
  }
};
  ?>