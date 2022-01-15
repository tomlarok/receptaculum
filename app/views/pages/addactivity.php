<div class="container-login">
    <div class="wrapper-login">
      <h2>Wydaj - Dodaj zdarzenie / operację</h2>
      <div class="login-form">
        <form action="index.php?activity=add" method ="POST"> <!-- URLROOT.VIEW -->
          Nazwa:<br>
          <select name="id_item">

<?php
require_once './app/controllers/StoreItems.php';
$st = new StoreItems;
$data = $st->get();

    // Get id/ from GET url
    if(isset($_GET['id'])){
      $id = validate($_GET['id']);
      $checked_item = "Nie wybrano"; // Checked items from store 

      foreach($data['store'] as $store):

        if ($store->id_item == $id) {
          $checked_item = $store->item_name;
          $id_item = $id;
        }

      endforeach;

      print '<option value="'.$id_item.'">'.$checked_item.' [Wybierz]</option>';
    }

              foreach($data['store'] as $store):

                 print '<option value="'.$store->id_item.'">'.$store->item_name.'</option>';
             
              endforeach;
              $id_item = $store->id_item; //  TODO Add ading item to worker from store page.
              // funkcja walidacji
              function validate($str) {
                // trim -Remove characters from both sides of a string
                return trim(htmlspecialchars($str)); /*przeszukują ciąg znaków, podany jako argument, w celu znalezienia znaczników HTML i PHP.
                 HTMLSPECIALCHARS zamienia znaki specialne (<,>,’,”,&) na ich „bezpieczne odpowiedniki”. */
              }


?>
          </select>

          <br>Pracownik:<br>
          <select name="id_worker">
<?php
$wk = new Workers;
$data = $wk ->get();
          foreach($data['workers'] as $workers):
          
             print '<option value="'.$workers->id_worker.'">'.$workers->name.' '.$workers->last_name.'</option>';
          endforeach;
?>
          </select>

          <br>Czas wydania:<br>

          <input type="datetime-local" id="daytime" name="date">

        <span class="invalidFeedback"><br>
            <?php //echo $data['inputError'];//TODO Change item_name to id_item as lik sendig worker ?>
        </span>

          <br>
          Dodatkowe informacje:<br>
          <input type="text" name="item_info" maxlength="40" size="40" id="info" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>
      <!--     <input type="hidden" name="id_item" value=" //echo $id_item ?>"/> TODO better in cookie? -->
        <span class="invalidFeedback"><br>
            <?php //echo $data['inputError'];//TODO Change item_name to id_item as lik sendig worker ?>
        </span><br>
            <br>
            <button class="button" id="submit" type="submit" name="addItem" value="submit">Wydaj z magazynu</button>
        </form>
      </div>
    </div>
</div>

<?php
