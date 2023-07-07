<?php // főoldal | űrlap ?>
<h1 class="tx-def">Kedves Leendő Ügyfelünk!</h1>
<p class="tx-def">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas lobortis libero et metus
    mattis, vitae aliquet nisi venenatis. Phasellus sed turpis rutrum, facilisis leo sit amet,
    facilisis libero.
</p>
<form method="post" enctype="multipart/form-data">
    <?php include_once('res/php/form1.php'); // Személyes adatok ?>
    <?php include_once('res/php/form2.php'); // Vagyonnal kapcsolatos adatok ?>
    <?php include_once('res/php/form3.php'); // Mire szeretné használni a számlát..... ?>
    <input type="submit" class="btn btn-primary" style="width: 15vw;" id="sendbtn" value="Küldés" name="sendForm">
</form>
<p class="lh-lg tx-def">Együttműködését előre is köszönjük<br>Üdvözlettel<br>Leendő bankára</p>