<div class="container-login">
    <div class="wrapper-login">
      <h2>Aktualizacja pozycji w magazynie</h2>

      <?php
      // Get id/ from GET url
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        echo '<br>ID: '.$id.'<br>';
      }
      // Get data from id row
    //  getSingle($id)

      $st = new StoreItems;
      $data = $st->getSingle($id);
    //  var_dump($data);
    //  echo "<br>";

      $lp = 1;
      foreach($data['store'] as $store):

         $name = $store->item_name;
         $group = $store->item_group;
         $info = $store->item_info;
         $location = $store->item_location;

      endforeach;
      ?>
      <div class="login-form">
        <form action="index.php?store=upt&id=<?php echo $id?>" method ="POST"> <!-- TODO change action form-->
          Nazwa:<br>
        <input type="text" name="item_name" maxlength="70" size="40" id="tytul" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
        value="<?php echo $name ?>"/>
        <br>
        Kategoria:<br>
        <input type="text" name="item_group" maxlength="70" size="40" id="autor" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
        value="<?php echo $group ?>"/>
        <br>
        Dodatkowe informacje:<br>
        <input type="text" name="item_info" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
        value="<?php echo $info ?>"/>
        <br>
        Lokalizacja:<br>
        <input type="text" name="item_location" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
        value="<?php echo $location ?>"/>
        <br>
        <!-- TODO Set id value to POST -->
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
