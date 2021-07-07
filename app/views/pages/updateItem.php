<div class="container-login">
    <div class="wrapper-login">
      <h2>Aktualizacja pozycji w magazynie</h2>

      <?php
      /* // TODO
      //include('./controllers/store_view.php');
      require_once './app/controllers/StoreItems.php';
      $st = new StoreItems;
      $data = $st->updateItem();
    //  var_dump($data);
    //  echo "<br>";
    // Search item from Store by lp
      $lp = 1;
      foreach($data['store'] as $store):
         $new_item_name = $store->item_name.'</TD><TD>';
         $new_item_name = $store->item_group.'</TD><TD>';
         $new_item_name = $store->item_name.'</TD><TD>';
         $new_item_name = $store->item_location.'</TD><TD>';
       endforeach;
      */?>
      <div class="login-form">
        <form action="index.php?log=l" method ="POST"> <!-- TODO change action form-->
          Nazwa:<br>
        <input type="text" name="item_name" maxlength="70" size="40" id="tytul" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
        value="<?php echo "Data name! " ?>"/>
        <br>
        Kategoria:<br>
        <input type="text" name="item_group" maxlength="70" size="40" id="autor" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" />
        <br>
        Dodatkowe informacje:<br>
        <input type="text" name="item_info" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" />
        <br>
        Lokalizacja:<br>
        <input type="text" name="item_location" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" />
        <br>

        <span class="invalidFeedback"><br>
            <?php //echo $data['inputError']; ?>
        </span><br>
            <br>
            <button class="button" id="submit" type="submit" name="addItem" value="submit">Aktualizuj</button>

        </form>
      </div>
    </div>
</div>

<?php
