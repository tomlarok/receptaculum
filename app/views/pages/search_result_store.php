<div id="storeTable">
  <TABLE CELLPADDING=5 BORDER=1 class="tablestyle">
  <TR class="tableHeader">
      <TD>Lp</TD><TD>Nazwa</TD><TD>SN</TD><TD>Pracownik</TD><TD>Kategoria</TD><TD>Dodatkowe informacje</TD><TD>Lokalizacja</TD><TD>Akcja</TD>
  </TR>

  <?php
  // Temporary show all items.  TODO show search result.


  //include('./controllers/store_view.php');
  require_once './app/controllers/StoreActivities.php';
  require_once './app/controllers/StoreItems.php';
  require_once './app/controllers/Workers.php';
  require_once './app/controllers/FindStoreItems.php';

  $st = new StoreActivities;

  $worker = new Workers;
  $store_item = new StoreItems;

  $find_item = new FindStoreItems;

  $data = $find_item->findStoreItem();
  var_dump($data);

  $lp = 1;

  // TODO Searching good works if we search by name of device/item. But if we want search by worker, it crash.
  // Find the row in table store_activity where id_item or id_worker and list them all.
  foreach($data['store_activity'] as $store):

    //The property_exists() method checks if the object or class has a property.
    if (property_exists($store, "id_worker" )) {
      $id_worker = $store->id_worker;
      //echo "<br> Jest id_worker<br>";
      $activity_row = $find_item->getStoreActivitybyIdWorker($id_worker);
      //$worker_row = $find_item ->getSingleWorker($id_worker);
      //var_dump($activity_row);

      foreach($activity_row['store_activity'] as $s):
      //  echo "<br>Worker name: ".$r->name;
      //  $worker_name = $s->name;
      //  echo "<br>Worker Surname: ".$r->last_name;
      //  $worker_last_name = $s->last_name;
        $id_item = $s->id_item;
        $date = $s->date;
      endforeach;

    }else {
    //  echo "<br> Nie ma id_worker.<br>";
    }
      //$id_worker = $store->id_worker;
      if (property_exists($store, "id_item" )) {
        $id_item = $store->id_item;
      }else {
      //  echo "<br> Nie ma item.<br>";
      }
      //$id_item = $store->id_item;
      ///$date = $store->date;
    //  echo "<br> pracownik: ".$id_worker;
    //  echo "<br> item: ".$id_item;

      $worker_row = $worker->getSingleWorker($id_worker);
      $store_row = $store_item->getSingle($id_item); //getSingle

      foreach($worker_row['workers'] as $r):
      //  echo "<br>Worker name: ".$r->name;
        $worker_name = $r->name;
      //  echo "<br>Worker Surname: ".$r->last_name;
        $worker_last_name = $r->last_name;
      endforeach;

      foreach($store_row['store'] as $r):
      //  echo "<br>Item name: ".$r->item_name;
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
      echo '
      <a href="./index.php?url=addactivity&id='.$lp.'">
        <button class="button_update" id="button_add" name="updateItem">Wydaj</button>
      </a>
     <a href = "index.php?store_del='.$store->id_item.'">
       <button class="button" id="button_del">Przyjmij</button>
     </a>
       </TD></TR>';  //TODO sending id_item by POST

      $lp ++;
  //  var_dump($data);
  //  echo "<br>";
    endforeach;
/*
    $lp = 1;
    foreach($data['store_activity'] as $store): //TODO change number iteration t
       //echo $store->item_name;
      // echo "<br>";

       echo '<TR><TD>'.$lp.'</TD><TD>';
       echo $r->item_name.'</TD><TD>';
       echo "sn</TD><TD>";
       echo "pracownik</TD><TD>";
       echo $r->item_group.'</TD><TD>';
       echo $r->item_info.'</TD><TD>';
       echo $r->item_location.'</TD><TD>';
       echo '
       <a href="./index.php?url=addactivity&id='.$lp.'">
         <button class="button_update" id="button_add" name="updateItem">Wydaj</button>
       </a>
      <a href = "index.php?store_del='.$store->id_item.'">
        <button class="button" id="button_del">Przyjmij</button>
      </a>
        </TD></TR>';  //TODO sending id_item by POST

       $lp ++;

    endforeach;
*/
  ?>
  </table>

</div>
