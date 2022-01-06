<div class="container-login">
    <div class="wrapper-login">
      <h2>Dodaj pozycję do magazynu</h2>
      <div class="login-form">
        <form action="index.php?store=add" method ="POST"> <!-- URLROOT.VIEW -->
          Nazwa:<br>
        <input type="text" name="item_name" maxlength="70" size="40" id="tytul" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>
        Kategoria:<br>
        <input type="text" name="item_group" maxlength="70" size="40" id="autor" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>
        Dodatkowe informacje:<br>
        <input type="text" name="item_info" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>
        Lokalizacja:<br>
        <input type="text" name="item_location" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>
        SN:<br>
        <input type="text" name="item_sn" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>

        <span class="invalidFeedback"><br>
            <?php //echo $data['inputError']; ?>
        </span><br>
            <br>
            <button class="button" id="submit" type="submit" name="addItem" value="submit">Dodaj</button>

        </form>
      </div>
    </div>
</div>

<?php
