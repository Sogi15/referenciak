<?php // első form Személyes adatok része
if ($_SESSION["error"] != "") {
    echo '<script>alert("' . $_SESSION["error"] . '");</script>';
}
// változók beállítása, ha visszalépett az illető
if (isset($_GET['edit'])) {
    $lastname = $_SESSION['lastname'];
    $firstname = $_SESSION['firstname'];
    $telefon = $_SESSION['telefon'];
} else {
    // változók alapból null értékkel rendelkeznek
    $lastname = "";
    $firstname = "";
    $telefon = "";
}
?>

<div class="border rounded w-100 p-4 m-0 bgw">
    <table class="w-100">
        <tbody>
            <tr>
                <th colspan="2">
                    <h3 class="text-primary"><b>Személyes adatok</b></h3>
                    <hr class="text-secondary">
                </th>
            </tr>
            <tr>
                <td class="w-50"><label class="text-muted tx-left col-form-label"><b class="tx-deflg">Neve</b><br>
                        <p class="tx-deflt">Lorem ipsum dolor sit
                            amet</p>
                    </label></td>
                <td class="w-50 p-0 m-0">
                    <div id="names">
                        <input class="form-control" type="text" value="<?php echo $lastname; ?>" name="lastname"
                            onkeydown="return /[a-zA-ZáéíóöőúüűÁÉÍÓÖŐÚÜŰ]/i.test(event.key)" id="lastname"
                            placeholder="Vezetéknév" required>
                        <input class="form-control" type="text" value="<?php echo $firstname; ?>" name="firstname"
                            onkeydown="return /[a-zA-ZáéíóöőúüűÁÉÍÓÖŐÚÜŰ]/i.test(event.key)" id="firstname"
                            placeholder="Keresztnév" required>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="w-50 p-0 m-0">
                    <label class="text-muted tx-left col-form-label"><b class="tx-deflg">Telefonszáma</b><br>
                        <p class="tx-deflt">Lorem
                            ipsum dolor sit
                            amet</p>
                    </label>
                </td>
                <td class="w-50 p-0 m-0">
                    <input class="form-control w-100" type="text" maxlength="11" name="tel" id="tel"
                        placeholder="Telefonszám" value="<?php echo $telefon; ?>"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                </td>
            </tr>
            <tr>
                <td class="w-50">
                    <label class="tx-left col-form-label w-22vw"><b class="tx-deflg">Külföldi
                            állampolgár vagy külföldi állandó lakcímmel rendelkezik?</b></label>
                </td>
                <td class="w-50 d-flex flex-row p-0 m-0">
                    <div class="p-1">
                        <input type="radio" class="btn-check" id="btn-yes" name="nation" value="True" required>
                        <label class="form1check btn btn-outline-secondary" for="btn-yes">Igen</label>
                    </div>
                    <div class="p-1">
                        <input type="radio" class="btn-check" id="btn-no" name="nation" value="False" required>
                        <label class="form1check btn btn-outline-secondary" for="btn-no">Nem</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="w-50">
                    <label class="text-muted tx-left col-form-label"><b class="tx-deflg">Okmányok
                            feltöltése</b><br>
                        <p class="tx-deflt w-22vw" style="font-size: 0.7vw;">Okmányainál személyi igazolvány (mindkét
                            oldal)
                            vagy jogosítvány (mindkét oldal) vagy útlevél illetve a lakcím
                            kártya
                            lakcímet tartalmazó oldala szükséges (amennyiben Ön külföldi vagy
                            más
                            okmányokkal rendelkezik, úgy telefonos egyeztetés
                            alapján).</p>
                    </label>
                </td>
                <td class="w-100 d-flex flex-row p-0 m-0">
                    <div id="dropzone" class="dropzone w-100">
                        <p class="text-primary fs-4"><b>Húzza be a fájlokat</b><br>
                            <span class="tx-xs">vagy <u>kattintson ide</u> a fájlok böngészéséhez</span>
                        </p>
                        <input type="file" name="images[]" id="fileInput" style="display: none;" accept="image/*"
                            required multiple>
                        <div id="fileName1" class="file-name"></div>
                        <div id="fileName2" class="file-name"></div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>