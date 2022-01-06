<div id="search-store-items"> <!--TODO id, item delete? or stay? -->

  <div class="container-login">
      <div class="wrapper-login">
        <h2>Wyszukiwarka</h2>
        <div class="login-form">
          <form action="index.php?url=search_results_store" method ="POST"> <!-- TODO add search item, replace ?url -->
            <h4> SN </h4>
            <input type="text" name="sn" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>

            <h4> Nazwa </h4>
            <input type="text" name="name" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>

          <span class="invalidFeedback"><br>
              <?php //echo $data['inputError']; ?>
          </span>
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
      <TD>Lp</TD><TD>Nazwa</TD><TD>Kategoria</TD><TD>Dodatkowe informacje</TD><TD>Lokalizacja</TD><TD>Akcja</TD>
  </TR>

  <?php

  require_once './app/controllers/StoreItems.php';
  $st = new StoreItems;
  $data = $st->get();


  $lp = 1;
  foreach($data['store'] as $store):

// TODO lp is a ID in DB, get array of ids in DB
     echo '<TR><TD>'.$lp.'</TD><TD>';
     echo $store->item_name.'</TD><TD>';
     echo $store->item_group.'</TD><TD>';
     echo $store->item_info.'</TD><TD>';
     echo $store->item_location.'</TD><TD>';
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
      //        echo "Id irem: ".$store->id_item;
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
     echo '
     <a href="./index.php?url=updateItem&id='.$store->id_item.'">
       <button class="button_update" id="button_add" name="updateItem">Edytuj</button>
     </a>
    <a href = "index.php?store_del='.$store->id_item.'">
      <button class="button" id="button_del">Usuń</button>
    </a>
      </TD></TR>';  //TODO sending id_item by POST

     $lp ++;
  endforeach;


  ?>
  </table>

<a href="./index.php?url=additem">
  <button class="button_add" id="button_add" name="add_action">Dodaj</button>
</a>
</div>

<?php
