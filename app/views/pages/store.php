<div id="storeTable">
  <TABLE CELLPADDING=5 BORDER=1 class="tablestyle">
  <TR class="tableHeader">
      <TD>Lp</TD><TD>Nazwa</TD><TD>Kategoria</TD><TD>Dodatkowe informacje</TD><TD>Lokalizacja</TD><TD>Akcja</TD>
  </TR>

  <?php
  //include('./controllers/store_view.php');
  require_once './app/controllers/StoreItems.php';
  $st = new StoreItems;
  $data = $st->get();
//  var_dump($data);
//  echo "<br>";

  $lp = 1;
  foreach($data['store'] as $store):
     //echo $store->item_name;
    // echo "<br>";

     echo '<TR><TD>'.$lp.'</TD><TD>';
     echo $store->item_name.'</TD><TD>';
     echo $store->item_group.'</TD><TD>';
     echo $store->item_name.'</TD><TD>';
     echo $store->item_location.'</TD><TD>';
     echo ' Usuń / Modyfikuj </TD></TR>';
     $lp ++;
      //   <TD>Lp</TD><TD>Nazwa</TD><TD>Kategoria</TD><TD>Dodatkowe informacje</TD><TD>Lokalizacja</TD><TD>Akcja</TD>
  endforeach;


  ?>
  </table>

  <button class="button_add" id="button_add" type="submit" name="add_action" value="submit">Add</button>

</div>

<?php

/* // TODO to delete. Test data['store]']
foreach($data['store'] as $store):

   echo $store->item_name;
   echo "<br>";
   echo $store->item_info;
   echo "<br>";
   echo $store->item_location;
endforeach;

echo "<br>";
*/
//echo $data['item_name'];
////echo $data->{'item_name'};
//echo is_array($data) ? 'Array<br>' : 'not an Array';
/*
foreach ($data as $key => $object) {
    echo $object->object_property;
}
$array = get_object_vars($data);
echo $array['item_name'];
//$array = json_decode(json_encode($data), true);
//echo $array['item_name'];
print_r($data);
//var_dump($data['store']);
//var_dump($_SESSION["data_store"]);
*/ // TODO test delete

/*
echo "<h3> Store </h3>";
print '
<table>
  <tr>
    <td> 1 </td>
    <td> 3 </td>
  </tr>
  <tr>
    <td> 2 </td>
    <td> 4 </td>
  </tr>
</table>
';
*/
