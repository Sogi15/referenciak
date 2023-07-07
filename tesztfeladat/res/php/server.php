<?php
// session indítás, ha nem fut.
if (!isset($_SESSION)) {
    session_start();
    $_SESSION['error'] = ""; // error változó
}

// vissza gomb a form.php-n
if (isset($_POST["form_back"])) {
    header('location: index.php?edit');
}

if (isset($_POST["form_done"])) {
    // kérdőív leadása után fájlok és adatok törlése.
    $file1 = $_SESSION['deletable0'];
    $file2 = $_SESSION['deletable1'];
    if (file_exists($file1) && file_exists($file2)) {
        unlink($file1);
        unlink($file2);
        session_destroy();
        echo '<script>
    var confirmed = confirm("Köszönjük, hogy kitöltötte a kérdőívünket!\nAz OK gombra kattintva vissza ugrik a főoldalra");
    if (confirmed) {
      window.location.href = "index.php?page=home";
    }
    </script>';
    }
}

// form elküldés elvégzése.
if (isset($_POST["sendForm"])) {
    // Session változók létrehozása a form.php részhez (form1)
    $_SESSION['firstname'] = htmlspecialchars($_POST['firstname']); // vezetéknév
    $_SESSION['lastname'] = htmlspecialchars($_POST['lastname']); // keresztnév
    $_SESSION['name'] = $_SESSION['lastname'] . ' ' . $_SESSION['firstname']; // név egybe rakása
    $_SESSION['telefon'] = htmlspecialchars($_POST['tel']); // telefonszám
    // külföldi állampolgárság csekkolása
    switch (htmlspecialchars($_POST['nation'])) {
        case 'True':
            $_SESSION['nation'] = "Igen";
            break; // Ha True akkor külföldi
        case 'False':
            $_SESSION['nation'] = "Nem";
            break; // Ha False akkor csak magyar
        default:
            $_SESSION['nation'] = "Nem";
            break; // allapból False érték
    }
    //vagyonnal kapcsolatos adatok (form2)
    switch (htmlspecialchars($_POST['money'])) {
        case 'mo1':
            $_SESSION['money'] = "150 - 300 millió HUF";
            break;
        case 'mo2':
            $_SESSION['money'] = "300 - 1000 millió HUF";
            break;
        case 'mo3':
            $_SESSION['money'] = "1 - 5 milliárd HUF";
            break;
        case 'mo4':
            $_SESSION['money'] = "5 millió HUF feletti";
            break;
        default:
            $_SESSION['money'] = "150 - 300 millió HUF";
            break;
    }
    // slider form (form3)
    for ($i = 0; $i <= 7; $i++) {
        switch (htmlspecialchars($_POST["slider" . $i . "name"])) {
            case '0':
                $slider = "Nem tervez";
                break;
            case '1':
                $slider = "0 - 500 000 Ft / hó";
                break;
            case '2':
                $slider = "500 001 - 1 000 000 Ft / hó";
                break;
            case '3':
                $slider = "1 000 001 - 3 000 000 Ft / hó";
                break;
            case '4':
                $slider = "3 000 001 - 5 000 000 Ft / hó";
                break;
            case '5':
                $slider = "5 000 001 - 8 000 000 Ft / hó";
                break;
            case '6':
                $slider = "8 000 001 - 20 000 000 Ft / hó";
                break;
            case '7':
                $slider = "100 000 000 Ft felett / hó";
                break;
        }
        $_SESSION['slider' . $i] = $slider;
    }

    // képek feltöltéséhez a mappa kijelölése
    $target_dir = "res/img/public/";
    if (isset($_FILES["images"]["name"])) {
        $fileCount = count($_FILES["images"]["name"]); // fileok megszámolása
        if ($fileCount <= 2) { // min 1 max 2 file lehet az okmányok 2 oldala miatt.
            for ($i = 0; $i < $fileCount; $i++) {
                $target_file = $target_dir . basename($_FILES["images"]["name"][$i]);
                // fájl mappába helyezés vizsgálattal egybekötve
                if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $target_file)) {
                    // session változóba tároljuk a képhez szükséges img taget.
                    $_SESSION['image' . $i] = "<img src='$target_file' alt='Feltöltött kép'>";
                    $_SESSION['deletable' . $i] = $target_file; // a törléshez szükséges session változó
                    header('location: index.php?page=form');
                } else {
                    echo "Hiba történt a fájl feltöltése közben!";
                }
            }
        } else {
            $_SESSION['error'] = "Legfeljebb 2 fájlt tölthetsz fel.";
        }
    }
}

?>