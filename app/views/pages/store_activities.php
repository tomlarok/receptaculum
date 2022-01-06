<div id="search-store-item"> <!--TODO id, item delete? or stay? -->

  <div class="container-login">
      <div class="wrapper-login">
        <h2>Wyszukiwarka</h2>
        <div class="login-form">
          <form action="index.php?url=search_result_store" method ="POST"> <!-- TODO add search item, replace ?url -->
            <h4> SN </h4>
            <input type="text" name="sn" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>

            <h4> Nazwa </h4>
            <input type="text" name="name" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>

            <h4> Pracownik </h4>
            <input type="text" name="worker" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>
<!-- TODO Add time interval?, activity IN/OUT? -->
          <span class="invalidFeedback"><br>
              <?php //echo $data['inputError']; ?>
          </span><br>
              <br>
              <button class="button" id="submit" type="submit" name="addItem" value="submit">Szukaj</button>
<!-- TODO buttton to delete
              <a href="./index.php?url=search_result_store">
                <button class="button" id="button" name="add_action">SZUKAJ</button>
              </a>  -->
          </form>
        </div>
      </div>
  </div>

</div>

<div id="storeTable">

  <TABLE CELLPADDING=5 BORDER=1 class="tablestyle">
  <TR class="tableHeader">
      <TD>Lp</TD><TD>Nazwa</TD><TD>Kategoria</TD><TD>Dodatkowe informacje</TD><TD>Pracownik</TD><TD>Data</TD><TD>Akcja</TD>
  </TR>

  <?php
  require_once './app/controllers/StoreActivities.php';
  require_once './app/controllers/StoreItems.php';
  require_once './app/controllers/Workers.php';

  $st = new StoreActivities;

  $worker = new Workers;
  $store_item = new StoreItems;

  $data = $st->get();


  $lp = 1;
  foreach($data['store_activity'] as $store):

    //$id_item = 0; //TODO to delete?
    if (property_exists($store, "id_activity")) {
      $id_activity = $store->id_activity;
    }else {
    //  echo "<br> Nie ma item.<br>";
    }

    $row = $st->getSingle($id_activity);

    foreach($row['store_activity'] as $r):
    //  echo "<br>Worker: ".$r->id_worker;
      $id_worker = $r->id_worker;
      $id_item = $r->id_item;
      $date = $r->date;
      $activity = $r->activity;
    endforeach;

    $worker_row = $worker->getSingleWorker($id_worker);
    $store_row = $store_item->getSingle($id_item); //getSingle

    foreach($worker_row['workers'] as $r):
      $worker_name = $r->name;
      $worker_last_name = $r->last_name;
    endforeach;

    foreach($store_row['store'] as $r):
      $item_name = $r->item_name;
      $item_group = $r->item_group;
      $item_info = $r->item_info;
    endforeach;

    $worker_fullname = $worker_name." ".$worker_last_name;

     echo '<TR><TD>'.$lp.'</TD><TD>';
     echo $item_name.'</TD><TD>';
     echo $item_group.'</TD><TD>';
     echo $item_info.'</TD><TD>';
     //echo $store->item_location.'</TD><TD>';
     echo $worker_fullname.'</TD><TD>';
     echo $date.'</TD><TD>';
     //echo $date.'</TD><TD>';
    /* Edit // <a href="./index.php?url=activity&id='.$id_activity.'">
       <button class="button_update" id="button_add" name="updateItem">Edytuj</button>
     </a> */
     echo $activity.''.'
    <a href = "index.php?activity_del='.$id_activity.'">
      <button class="button" id="button_del">Usuń</button>
    </a>
      </TD></TR>';  //TODO sending id_item by POST

     $lp ++;

  endforeach;


  ?>
</TABLE>

</div>

<?php
