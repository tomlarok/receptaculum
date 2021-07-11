<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
   /*
   $data = [
       'title' => 'Home page',
       'usernameError' => '',
       'passwordError' => ''
   ];
   */
  class Core {
    protected $page = ''; // TODO set variable visible in index.php
    protected $params = [];

    public function __construct(){
      /*
      if(isset($_GET['login'])){
        echo "login";
        $page = 'login';
        */
        /*
        if (isset($_POST['login_action'])){
          echo " Login action";
        }
        */
        /*
        $data = [ //TODO data przeysłana przez funkcje
            'title' => 'Home page',
            'usernameError' => '',
            'passwordError' => '',
            'emailError' => '',
            'confirmPasswordError' => ''
        ];
        */
        /*
        if (!isset($_SESSION["data"])){
          $_SESSION["data"] = $data;
        }
        */
        //$_SESSION["data"] = $data;
        $url = $this->getUrl();
      //  echo "Test core<br>";
      //  echo $url;
      //  echo "<br>";
      //  print_r($url);
      //  $page = $url[0];
      //  echo $page;
      //  echo " koniec<br>";
      }


      public function getUrl(){
        if(isset($_GET['url'])){
          $url = rtrim($_GET['url'], '/'); // rtrim - Remove characters from the right side of a string:
        //  echo $url;
        //  echo " k ";
          $url = filter_var($url, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $url = explode('/', $url);  //The explode() function breaks a string into an array.
          return $url;
        }
        if(isset($_GET['log']) && ($_GET['log']=='l')){  //?log=l
          $log_action = rtrim($_GET['log'], '/'); // rtrim - Remove characters from the right side of a string:
        //  echo $log_action;
        //  echo " k ";
          $log_action = filter_var($log_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $log_action = explode('/', $log_action);  //The explode() function breaks a string into an array.
          //return $log_action;
          // TODO launch Users.php
          $users = new Users();
          $users -> login();
            return $log_action;
        }

        if(isset($_GET['log']) && ($_GET['log']=='out')){  //?log=l
          $logout_action = rtrim($_GET['log'], '/'); // rtrim - Remove characters from the right side of a string:
        //  echo $logout_action;
        //  echo " k ";
          $logout_action = filter_var($logout_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $logout_action = explode('/', $logout_action);  //The explode() function breaks a string into an array.
          //return $log_action;
          // TODO launch Users.php
          $users = new Users();
          $users -> logout();
            return $logout_action;
        }

        if(isset($_GET['log']) && ($_GET['log']=='r')){  //?log=l
          $reg_action = rtrim($_GET['log'], '/'); // rtrim - Remove characters from the right side of a string:
        //  echo $reg_action;
        //  echo " r ";
          $reg_action = filter_var($reg_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $reg_action = explode('/', $reg_action);  //The explode() function breaks a string into an array.
          //return $log_action;
          // TODO launch Users.php
          $users = new Users();
          $users -> register();
            return $reg_action;
        }

        // -- STORE -- TODO Check if it is correct!!!
        // -- add
        if(isset($_GET['store']) && ($_GET['store']=='add')){  //?log=l
          $store_action = rtrim($_GET['store'], '/'); // rtrim - Remove characters from the right side of a string:
        //  echo $store_action ;
        //  echo " add ";
          $store_action = filter_var($store_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $store_action = explode('/', $store_action);  //The explode() function breaks a string into an array.
          //return $log_action;
          // TODO launch Users.php
          $store = new StoreItems();
          $store -> add();
            return $store_action;
        }
        // Update //./index.php?url=updateItem&id='.$lp.
        if(isset($_GET['store']) && ($_GET['store']=='upt')  && isset($_GET['id'])){  //?log=l
          $store_action = rtrim($_GET['store'], '/'); // rtrim - Remove characters from the right side of a string:
          echo $store_action ;
        //  echo " add ";
          $store_action = filter_var($store_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $store_action = explode('/', $store_action);  //The explode() function breaks a string into an array.
          //return $log_action;
          $id = rtrim($_GET['id'], '/');
          $id = filter_var($id, FILTER_SANITIZE_URL);
          //$id = explode('/', $id);
          echo "<br> Core: ".$id;
          $store = new StoreItems();
          $store -> update($id);
            return $store_action;
        }

        // Delete
        //if(isset($_GET['store']) && ($_GET['store']=='upt')){  //?log=l
        if(isset($_GET['store_del'])){  //delete
          $store_action = rtrim($_GET['store_del'], '/'); // rtrim - Remove characters from the right side of a string:
        //  echo $store_action ;
        //  echo " add ";
          $store_action = filter_var($store_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          //$store_action = explode('/', $store_action);  //The explode() function breaks a string into an array.
          //return $log_action;
          // TODO launch Users.php
          $store = new StoreItems();
          $store -> delete($store_action);
            return $store_action;
        }

      }

    }
