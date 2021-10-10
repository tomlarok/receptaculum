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
<!-- TODO buttton to delete -->
              <a href="./index.php?url=search_result_store">
                <button class="button" id="button" name="add_action">SZUKAJ</button>
              </a>
          </form>
        </div>
      </div>
  </div>

</div>

<div id="storeTable">

  <TABLE CELLPADDING=5 BORDER=1 class="tablestyle">
  <TR class="tableHeader">
      <TD>Lp</TD><TD>Nazwa</TD><TD>SN</TD><TD>Pracownik</TD><TD>Lokalizacja</TD><TD>Akcja</TD>
  </TR>
  <TR class="tableContent"> <!-- TODO  add class tr to special display content? -->
      <TD>1</TD><TD>N</TD><TD>12342343245</TD><TD>Malina</TD><TD>gdzieśtam </TD><TD> out </TD>
  </TR>

  </TABLE>


  <TABLE CELLPADDING=5 BORDER=1 class="tablestyle">
  <TR class="tableHeader">
      <TD>Lp</TD><TD>Nazwa</TD><TD>Kategoria</TD><TD>Dodatkowe informacje</TD><TD>Pracownik</TD><TD>Data</TD><TD>Akcja</TD>
  </TR>

  <?php  //TODO Error ..
  // usage of memory
  //$mem_usage = memory_get_usage();
  //echo "<br> Memory ".$mem_usage."<br>";
  require_once './app/controllers/StoreActivities.php';
  require_once './app/controllers/StoreItems.php';
  require_once './app/controllers/Workers.php';

  $st = new StoreActivities;

  $worker = new Workers;
  $store_item = new StoreItems;
//  $st = new StoreActivites;
  $data = $st->get();
  //$data = $st->getSingle();
  ///var_dump($data);
//  echo "<br>";

  $lp = 1;
  foreach($data['store_activity'] as $store):
     //echo $store->item_name;
    // echo "<br>";
    //echo "<br>Nr: ".$lp;
    $row = $st->getSingle($lp);
    //var_dump($row);
    foreach($row['store_activity'] as $r):
    //  echo "<br>Worker: ".$r->id_worker;
      $id_worker = $r->id_worker;
      $id_item = $r->id_item;
      $date = $r->date;
    endforeach;

    echo "<br> Id worker:".$id_worker;
  //  echo "<br>Pracownik: ".$row['store_activity']->id_worker;
  //  ['store_activity']
  //  echo "<br> id:".$row['id_worker'];
  //  $id_w = $row['id_worker'];
    //$worker_row = $worker->getSingleWorker($row['id_worker']);
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

/* Don't work TODO delete
    $item = $store_row['item_name'];
    $worker_name = $worker_row['name'];
    $worker_last_name = $worker_row['last_name'];
*/
/*  // TEST
    echo "<br>Name: ".$worker_name;
    echo "<br>Surname: ".$worker_last_name;
    echo "<br>Item: ".$item_name;
*/
/*
     echo '<TR><TD>'.$lp.'</TD><TD>';
     echo $store->item_name.'</TD><TD>';
     echo $store->item_group.'</TD><TD>';
     echo $store->item_info.'</TD><TD>';
     //echo $store->item_location.'</TD><TD>';
     echo $store->item_info.'</TD><TD>';
     echo $store->worker.'</TD><TD>';
     echo $store->date.'</TD><TD>';
*/
     echo '<TR><TD>'.$lp.'</TD><TD>';
     echo $item_name.'</TD><TD>';
     echo $item_group.'</TD><TD>';
     echo $item_info.'</TD><TD>';
     //echo $store->item_location.'</TD><TD>';
     echo $worker_fullname.'</TD><TD>';
     echo $date.'</TD><TD>';
     //echo $date.'</TD><TD>';
     echo '
     <a href="./index.php?url=updateItem&id='.$lp.'">
       <button class="button_update" id="button_add" name="updateItem">Edytuj</button>
     </a>
    <a href = "index.php?store_del='.$store->id_item.'">
      <button class="button" id="button_del">Usuń</button>
    </a>
      </TD></TR>';  //TODO sending id_item by POST

     $lp ++;
      //   <TD>Lp</TD><TD>Nazwa</TD><TD>Kategoria</TD><TD>Dodatkowe informacje</TD><TD>Lokalizacja</TD><TD>Akcja</TD>
  endforeach;


  ?>
</TABLE>

<a href="./index.php?url=addactivity">
  <button class="button" id="button" name="add_action">Wydaj</button>
  <!-- <button class="button_add" id="button_add" name="add_action">Dodaj</button> -->
</a>
<a href="./index.php?url=addactivity">
  <button class="button" id="button" name="add_action">Przyjmij</button>
  <!-- <button class="button_add" id="button_add" name="add_action">Dodaj</button> -->
</a>
</div>

<?php
