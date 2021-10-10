<div class="container-login">
    <div class="wrapper-login">
      <h2>Wydaj - Dodaj zdarzenie / operację</h2>
      <div class="login-form">
        <form action="index.php?activity=add" method ="POST"> <!-- URLROOT.VIEW -->
          Nazwa:<br>
          <select name="item_name">
          <!--    <option value="1">Pierwsza opcja</option>
              <option value="2">Druga opcja</option>
              <option value="3">Trzecia opcja</option>  -->
<?php
require_once './app/controllers/StoreItems.php';
$st = new StoreItems;
$data = $st->get();

    // Get id/ from GET url
    if(isset($_GET['id'])){
      $id = validate($_GET['id']);
      //echo '<br>ID: '.$id.'<br>';
      print '<option value="'.$id.'">'.$id.' Wybrano</option>';
    }

              foreach($data['store'] as $store):
              //   echo '<TR><TD>'.$lp.'</TD><TD>';
              //   echo $store->item_name;
                 print '<option value="'.$store->id_item.'">'.$store->item_name.'</option>';
              //   echo "<br>Id item addactivity: "$store->id_item;
              endforeach;
              $id_item = $store->id_item; //  TODO Add ading item to worker from store page.
              // funkcja walidacji
              function validate($str) {
                // trim -Remove characters from both sides of a string
                return trim(htmlspecialchars($str)); /*przeszukują ciąg znaków, podany jako argument, w celu znalezienia znaczników HTML i PHP.
                 HTMLSPECIALCHARS zamienia znaki specialne (<,>,’,”,&) na ich „bezpieczne odpowiedniki”. */
              }
/*
              // spr czy dane zostały przesłane i czy nie są puste
              if (!isset($_POST['tytul']) && empty($_POST["tytul"])){
                echo "Brak podanego tytułu";
              } else {
                $tytul = validate($_POST['tytul']);
              }
*/

?>
          </select>

          <br>Pracownik:<br>
          <select name="id_worker">
<?php
$wk = new Workers;
$data = $wk ->get();
          foreach($data['workers'] as $workers):
          //   echo '<TR><TD>'.$lp.'</TD><TD>';
          //   echo $store->item_name;
             print '<option value="'.$workers->id_worker.'">'.$workers->name.'</option>';
          endforeach;
?>
          </select>
          <br>
          Dodatkowe informacje:<br>
          <input type="text" name="item_info" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>
          <input type="hidden" name="id_item" value="<?php echo $id_item ?>"/> <!-- TODO better in cookie? -->
        <span class="invalidFeedback"><br>
            <?php //echo $data['inputError']; ?>
        </span><br>
            <br>
            <button class="button" id="submit" type="submit" name="addItem" value="submit">Wydaj z magazynu</button>

        </form>
      </div>
    </div>
</div>

<?php
