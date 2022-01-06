<div id="storeTable">
  <TABLE CELLPADDING=5 BORDER=1 class="tablestyle">
  <TR class="tableHeader">
      <TD>Lp</TD><TD>Nazwa</TD><TD>SN</TD><TD>Kategoria</TD><TD>Dodatkowe informacje</TD><TD>Lokalizacja</TD><TD>Akcja</TD>
  </TR>

  <?php
  // Temporary show all items.  TODO show search result.


  //include('./controllers/store_view.php');
  require_once './app/controllers/StoreActivities.php';
  require_once './app/controllers/StoreItems.php';
  require_once './app/controllers/Workers.php';
  require_once './app/controllers/FindStoreItems.php';

  $st = new StoreItems;
  $find_item = new FindStoreItems;


  $data = $find_item->findItemInStore();

  $lp = 1;


  // TODO Improove searching? Searching by SN,
  foreach($data['store'] as $store):

    $item_name = $store->item_name;
    $item_group = $store->item_group;
    $item_sn = $store->item_sn;
    $item_info = $store->item_info;
    $item_location = $store->item_location;
    $item_handing_over = $store->item_handing_over;

      echo '<TR><TD>'.$lp.'</TD><TD>';
      echo $item_name.'</TD><TD>';
      echo "sn</TD><TD>";
      echo $item_group.'</TD><TD>';
      echo $item_info.'</TD><TD>';
      echo $item_location.'</TD><TD>';

      $isin = $store->item_handing_over;

      if ($isin == "in") {
        // Item is in a store.
        echo'
        <img class="icon" src="./public/img/in.png">
        <a href = "./index.php?url=addactivity&id='.$store->id_item.'">
          <button class="button" id="button_out">Wydaj</button>
        </a>';
      }
      if ($isin == "out") {
        // Item is out

        $result = $st->getItemIdActivity($store->id_item);

       foreach($result['store'] as $r):
          $id_activity = $r->id_activity;
        endforeach;
        echo '
        <img class="icon" src="./public/img/out.png">
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
