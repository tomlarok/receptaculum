<div id="storeTable">
  <TABLE CELLPADDING=5 BORDER=1 class="tablestyle">
  <TR class="tableHeader">
      <TD>Lp</TD><TD>Imie</TD><TD>Nazwisko</TD><TD>Stanowisko</TD><TD>Akcja</TD>
  </TR>

  <?php

  require_once './app/controllers/Workers.php';
  $wk = new Workers;
  $data = $wk->get();

  $lp = 1;
  foreach($data['workers'] as $workers):


     echo '<TR><TD>'.$lp.'</TD><TD>';
     echo $workers->name.'</TD><TD>';
     echo $workers->last_name.'</TD><TD>';
     echo $workers->post.'</TD><TD>';
     echo '
     <a href="./index.php?url=updateworker&id='.$workers->id_worker.'">
       <button class="button_update" id="button_add" name="updateItem">Edytuj</button>
     </a>
    <a href = "index.php?workers_del='.$workers->id_worker.'">
      <button class="button" id="button_del">Usuń</button>
    </a>
      </TD></TR>';  //TODO sending id_item by POST

     $lp ++;
  endforeach;


  ?>
  </table>

<a href="./index.php?url=addworker">
  <button class="button_add" id="button_add" name="add_action">Dodaj</button>
</a>
</div>
