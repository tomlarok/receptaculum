<?php

while ($row = @mysqli_fetch_array ($result)){


  $id_item= $row ['id_item'];
  $item_info = $row ['item_info'];
  $item_group = $row ['item_group'];
  $item_location = $row ['item_location'];


  $polaczenie->next_sult(); // ???
  /*
  $zultat2 = mysqli_query ($polaczenie, "CALL wyszukajKategoria('$id_kategoria')");
  $row2 = mysqli_fetch_array ($zultat2);
  $kategoria = $row2 ['nazwa'];
  */
  print '
  <TR>
    <TD>'; echo $id_item; print'</TD><TD>'; echo $item_info; print'</TD><TD>'; echo $item_group; print'</TD><TD>';
    echo $item_location; print'</TD><TD>';

      print'
      </TD><TD><a hf="./controllers/zamowienie_dodaj.php?id_ksiazka='; echo $id_ksiazka;
      print'">Zamów i wypożycz</a></br>';

    if ((isset($_SESSION['login'])) && ($_SESSION['login']==true))
    {
      if ($dostepnosc == "Tak"){
        echo '<br>Dostępna<br>';
        print '<img src="./views/img/dostepnosc.png" class="icon" alt="Img dostp?" ';
      }
    }
    print'
    </TR>
    ';

  $lp ++;
}
