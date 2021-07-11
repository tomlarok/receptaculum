<div class="container-login">
    <div class="wrapper-login">
      <h2>Aktaulizacja pracownika</h2>

      <?php
      // Get id/ from GET url
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        echo '<br>ID: '.$id.'<br>';
      }
      // Get data from id row
    //  getSingle($id)

      $wk = new Workers;
      $data = $wk ->getSingleWorker($id);
    //  var_dump($data);
    //  echo "<br>";

      $lp = 1;
      foreach($data['workers'] as $workers):

         $name = $workers->name;
         $last_name = $workers->last_name;
         $post = $workers->post;

      endforeach;
      ?>
      <div class="login-form">
        <form action="index.php?workers=upt&id=<?php echo $id?>" method ="POST"> <!-- TODO change action form-->
        Imię:<br>
        <input type="text" name="name" maxlength="70" size="40" id="name" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
        value="<?php echo $name ?>"/>
        <br>
        Nazwisko:<br>
        <input type="text" name="last_name" maxlength="70" size="40" id="last_name" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
        value="<?php echo $last_name ?>"/>
        <br>
        Stanowisko:<br>
        <input type="text" name="post" maxlength="40" size="40" id="post" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
        value="<?php echo $post ?>"/>
        <br>

        <!-- TODO Set id value to POST -->
        <span class="invalidFeedback"><br>
            <?php //echo $data['inputError']; ?>
        </span><br>
            <br>
            <button class="button" id="submit" type="submit" name="addItem" value="submit">Aktualizuj</button>

        </form>
      </div>
    </div>
</div>
