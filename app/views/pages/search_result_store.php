<div id="storeTable">
  <TABLE CELLPADDING=5 BORDER=1 class="tablestyle">
  <TR class="tableHeader">
      <TD>Lp</TD><TD>Nazwa</TD><TD>SN</TD><TD>Pracownik</TD><TD>Kategoria</TD><TD>Dodatkowe informacje</TD><TD>Lokalizacja</TD><TD>Akcja</TD>
  </TR>

  <?php
  // Temporary show all items.  TODO show search result.

  require_once './app/controllers/StoreActivities.php';
  require_once './app/controllers/StoreItems.php';
  require_once './app/controllers/Workers.php';
  require_once './app/controllers/FindStoreItems.php';

  $st = new StoreActivities;

  $worker = new Workers;
  $store_item = new StoreItems;

  $find_item = new FindStoreItems;

  $data = $find_item->findStoreItem();
  //var_dump($data);

  $lp = 1;

  // TODO Improove searching? Searching by SN, date, worker.
  // Find the row in table store_activity where id_item or id_worker and list them all.
  foreach($data['store_activity'] as $store):
    // Get id_activity
    $id_activity = $store->id_activity;
    //The property_exists() method checks if the object or class has a property.
    if (property_exists($store, "id_worker" )) {
      $id_worker = $store->id_worker;
      //echo "<br> Jest id_worker<br>";
      $activity_row = $find_item->getStoreActivitybyIdWorker($id_worker);
      //$worker_row = $find_item ->getSingleWorker($id_worker);

      foreach($activity_row['store_activity'] as $s):

        $id_item = $s->id_item;
        $date = $s->date;
      endforeach;

    }else {
    //  echo "<br> Nie ma id_worker.<br>";
    }

      if (property_exists($store, "id_item" )) {
        $id_item = $store->id_item;
      }else {
      //  echo "<br> Nie ma item.<br>";
      }


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
      echo "sn</TD><TD>";
      echo $worker_fullname."</TD><TD>";
      echo $r->item_group.'</TD><TD>';
      echo $r->item_info.'</TD><TD>';
      echo $r->item_location.'</TD><TD>';

      // IF item is in a store?
      //$item_handing_over == 'in'
      //echo "<br> Page id_item: ".$id_item;
      $isin = $st->checkIfItemIsFree($store->id_item);
      if ($isin == "in") {
        echo '
        <a href="./index.php?addactivity&id='.$store->id_item.'">
          <button class="button_update" id="button_add" name="updateItem">Wydaj</button>
        </a>';  //TODO change, delete?
      } else {
        echo '
        <a href="./index.php?activity_add_receive&id='.$store->id_item.'&ida='.$id_activity.'">
          <button class="button" id="button_del">Przyjmij</button>
        </a>';
      }
      echo '</TD></TR>';


      $lp ++;

    endforeach;

  ?>
  </table>

</div>
