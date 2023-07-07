<?php
// harmadik form anyagias (slider) része
require('form3labels.php');
?>

<div class="border rounded w-100 p-4 mt-4 mb-4 bgw">
    <table class="w-100" id="form3">
        <tbody>
            <tr>
                <th colspan="2">
                    <h3 class="text-primary"><b>Mire szeretné használni a számlát és havonta
                            mekkora<br> forgalmat tervez rajta bonyolítani?</b></h3>
                    <p class="tx-deflt">A csúszkát állítsa be minden sorban a kívánt
                        mértékig</p>
                    <hr class="text-secondary">
                </th>
            </tr>
            <tr>

                <?php
                // ciklus a sliderek legenerálásához
                foreach ($form3labels as $label => $string) {
                    echo '<td class="w-50 pb-2 pt-2">
                <label class="tx-left col-form-label">
                <b class="tx-deflg">' . $string . '</b>
                </label>
                </td><td class="w-50 pb-2 pt-2">
                <div class="slider-container">
                <span class="slider-tooltip" id="slider' . $label . 't">Nem Tervez</span>
                <input type="range" min="0" max="7" value="0" class="slider" id="slider' . $label . '" name="slider' . $label . 'name" required>
                <div id="slider' . $label . '_v" class="sliderValue tx-defl">Nem tervez</div>
            </div>
        </td>
    </tr>';
                }
                ?>
        </tbody>
    </table>
</div>