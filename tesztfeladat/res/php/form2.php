<?php // második form Vagyonnal kapcsolatos adatok része

// tömb a radio input label-hez
$form2labels = array(
    "mo1" => "150 - 300 millió HUF",
    "mo2" => "300 - 1000 millió HUF",
    "mo3" => "1 - 5 milliárd HUF",
    "mo4" => "5 millió HUF feletti"
);
?>

<div class="border rounded w-100 p-4 mt-4 mb-4 bgw">
    <table class="w-100">
        <tbody>
            <tr>
                <th colspan="2">
                    <h3 class="text-primary"><b>Vagyonnal kapcsolatos adatok</b></h3>
                    <hr class="text-secondary">
                </th>
            </tr>
            <tr class="d-flex flex-row ">
                <td class="w-50">
                    <label class="tx-left col-form-label"><b class="tx-deflg">Mekkora a
                            teljes vagyonának volumene?</b></label>
                </td>
                <td class="w-50 d-flex flex-row p-0 m-0">
                    <ul class="money-mo">
                        <?php // ciklus a lista elemek generálásához 
                        foreach ($form2labels as $label => $text) {
                            echo '<li class="form2radiolabel">
    <input type="radio" class="form-check-input form2radio" name="money" id="' . $label . '" value="' . $label . '" required>
    <label class="form-check-label tx-deflg" for="' . $label . '">' . $text . '</label>
    </li>';
                        }
                        ?>
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
</div>