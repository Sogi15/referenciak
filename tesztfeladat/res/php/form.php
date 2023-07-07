<?php // A form elküldése után látható!?>
<h1 class="tx-def">Kedves Ügyfelünk!</h1>
<p class="tx-def">
    Kérjük ellenőrízze az ön által beadott adatokat!<br>
    Ha minden adat helyes nyomjon a 'Leadás' gombra!<br>
    Abban az esetben ha hibát észlelt nyomjon a 'Vissza' gombra és töltse ki újra a kérdőívet!
</p>

<div class="border rounded w-100 p-4 m-0 bgw">
    <table class="w-100 m-0">
        <tbody>
            <tr>
                <th colspan="2">
                    <h3 class="text-primary"><b>Személyes adatok</b></h3>
                    <hr class="text-secondary">
                </th>
            </tr>
            <tr>
                <td class="w-50">
                    <p class="tx-form_label">Neve:</p>
                </td>
                <td class="w-50">
                    <p class="tx-form_value border rounded text-center bg-light">
                        <?php echo $_SESSION['name']; ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td class="w-50">
                    <p class="tx-form_label">Telefonszáma:</p>
                </td>
                <td class="w-50">
                    <p class="tx-form_value border rounded text-center bg-light">
                        <?php echo $_SESSION['telefon']; ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td class="w-50">
                    <p class="tx-form_label w-75">Külföldi állampolgár vagy külföldi állandó lakcímmel rendelkezik?</p>
                </td>
                <td class="w-50">
                    <p class="tx-form_value border rounded text-center bg-light">
                        <?php echo $_SESSION['nation']; ?>
                    </p>
                </td>
            </tr>
            <tr id="okmanyok">
                <td class="w-50">
                    <p class="tx-form_label w-75">Okmányok:</p>
                </td>
                <td class="w-100 d-flex d-row">
                    <p class="tx-form_value border rounded text-center bg-light w-100">
                        <?php echo $_SESSION['image0']; ?>
                    </p>
                    <p class="tx-form_value border rounded text-center bg-light w-100">
                        <?php echo $_SESSION['image1']; ?>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="border rounded w-100 p-4 mt-4 mb-4 bgw">
    <table class="w-100 m-0">
        <tbody>
            <tr>
                <th colspan="2">
                    <h3 class="text-primary"><b>Vagyonnal kapcsolatos adatok</b></h3>
                    <hr class="text-secondary">
                </th>
            </tr>
            <tr>
                <td class="w-50">
                    <p class="tx-form_label">Mekkora a teljes vagyonának volumene?</p>
                </td>
                <td class="w-50">
                    <p class="tx-form_value border rounded text-center bg-light">
                        <?php echo $_SESSION['money']; ?>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="border rounded w-100 p-4 mt-4 mb-4 bgw">
    <table class="w-100 m-0">
        <tbody>
            <tr>
                <th colspan="2">
                    <h3 class="text-primary"><b>Mire szeretné használni a számlát és havonta mekkora forgalmat tervez
                            rajta bonyolítani?</b></h3>
                    <hr class="text-secondary">
                </th>
                <?php
                require('form3labels.php');
                foreach ($form3labels as $label => $text) {
                    echo '</tr>
                <td class="w-50">
                <p class="tx-form_label w-75">' . $text . '</p>
                </td>
                <td class="w-50">
                <p class="tx-form_value border rounded text-center bg-light">' . $_SESSION['slider' . $label] . '</p>
                </td></tr>';
                } ?>
        </tbody>
    </table>
</div>
<form method="post">
    <input type="submit" value="Vissza" class="btn btn-outline-primary w-25 fs-5 mb-3" name="form_back">
    <input type="submit" value="Leadás" class="btn btn-outline-primary w-25 fs-5 mb-3" style="float:right;"
        name="form_done">
</form>