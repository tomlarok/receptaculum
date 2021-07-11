<div class="container-login">
    <div class="wrapper-login">
      <h2>Dodaj pracownika</h2>
      <div class="login-form">
        <form action="index.php?workers=add" method ="POST"> <!-- URLROOT.VIEW -->
        Imię:<br>
        <input type="text" name="name" maxlength="70" size="40" id="name" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>
        Nazwisko:<br>
        <input type="text" name="last_name" maxlength="70" size="40" id="last_name" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>
        Stanowisko:<br>
        <input type="text" name="post" maxlength="40" size="40" id="post" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>

        <span class="invalidFeedback"><br>
            <?php //echo $data['inputError']; ?>
        </span><br>
            <br>
            <button class="button" id="submit" type="submit" name="addItem" value="submit">Dodaj</button>

        </form>
      </div>
    </div>
</div>
