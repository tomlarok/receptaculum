<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */

  class Core {
    protected $page = ''; // TODO set variable visible in index.php
    protected $params = [];

    public function __construct(){

        //$_SESSION["data"] = $data;
        $url = $this->getUrl();
      }


      public function getUrl(){
        if(isset($_GET['url'])){
          $url = rtrim($_GET['url'], '/'); // rtrim - Remove characters from the right side of a string:

          $url = filter_var($url, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $url = explode('/', $url);  //The explode() function breaks a string into an array.
          return $url;
        }
        if(isset($_GET['log']) && ($_GET['log']=='l')){  //?log=l
          $log_action = rtrim($_GET['log'], '/'); // rtrim - Remove characters from the right side of a string:

          $log_action = filter_var($log_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $log_action = explode('/', $log_action);  //The explode() function breaks a string into an array.

          $users = new Users();
          $users -> login();
            return $log_action;
        }

        if(isset($_GET['log']) && ($_GET['log']=='out')){  //?log=l
          $logout_action = rtrim($_GET['log'], '/'); // rtrim - Remove characters from the right side of a string:

          $logout_action = filter_var($logout_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $logout_action = explode('/', $logout_action);  //The explode() function breaks a string into an array.

          $users = new Users();
          $users -> logout();
            return $logout_action;
        }

        if(isset($_GET['log']) && ($_GET['log']=='r')){  //?log=l
          $reg_action = rtrim($_GET['log'], '/'); // rtrim - Remove characters from the right side of a string:

          $reg_action = filter_var($reg_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $reg_action = explode('/', $reg_action);  //The explode() function breaks a string into an array.

          $users = new Users();
          $users -> register();
            return $reg_action;
        }

        // -- STORE -- TODO Check if it is correct!!!
        // -- add
        if(isset($_GET['store']) && ($_GET['store']=='add')){  //?log=l
          $store_action = rtrim($_GET['store'], '/'); // rtrim - Remove characters from the right side of a string:

          $store_action = filter_var($store_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $store_action = explode('/', $store_action);  //The explode() function breaks a string into an array.

          $store = new StoreItems();
          $store -> add();
            return $store_action;
        }
        // Update //./index.php?url=updateItem&id='.$lp.
        if(isset($_GET['store']) && ($_GET['store']=='upt')  && isset($_GET['id'])){  //?log=l
          $store_action = rtrim($_GET['store'], '/'); // rtrim - Remove characters from the right side of a string:
          echo $store_action ;

          $store_action = filter_var($store_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $store_action = explode('/', $store_action);  //The explode() function breaks a string into an array.

          $id = rtrim($_GET['id'], '/');
          $id = filter_var($id, FILTER_SANITIZE_URL);

          $store = new StoreItems();
          $store -> update($id);
            return $store_action;
        }

        // Delete
        //if(isset($_GET['store']) && ($_GET['store']=='upt')){  //?log=l
        if(isset($_GET['store_del'])){  //delete
          $store_action = rtrim($_GET['store_del'], '/'); // rtrim - Remove characters from the right side of a string:

          $store_action = filter_var($store_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/

          $store = new StoreItems();
          $store -> delete($store_action);
            return $store_action;
        }

        //
        // -- WORKERS -- TODO Check if it is correct!!!
        // -- add
        if(isset($_GET['workers']) && ($_GET['workers']=='add')){  //?log=l
          $workers_action = rtrim($_GET['workers'], '/'); // rtrim - Remove characters from the right side of a string:

          $workers_action = filter_var($workers_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $workers_action = explode('/', $workers_action);  //The explode() function breaks a string into an array.
          $workers = new Workers();
          $workers -> add();
            return $workers_action;
        }
        // Update //./index.php?url=updateItem&id='.$lp.
        if(isset($_GET['workers']) && ($_GET['workers']=='upt')  && isset($_GET['id'])){  //?log=l
          $workers_action = rtrim($_GET['workers'], '/'); // rtrim - Remove characters from the right side of a string:
          echo $workers_action ;
          $workers_action = filter_var($workers_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $workers_action = explode('/', $workers_action);  //The explode() function breaks a string into an array.
          $id = rtrim($_GET['id'], '/');
          $id = filter_var($id, FILTER_SANITIZE_URL);
          echo "<br> workers: ".$id;
          $workers = new Workers();
          $workers -> update($id);
            return $workers_action;
        }

        // Delete
        //if(isset($_GET['store']) && ($_GET['store']=='upt')){  //?log=l
        if(isset($_GET['workers_del'])){  //delete
          $workers_action = rtrim($_GET['workers_del'], '/'); // rtrim - Remove characters from the right side of a string:
          $workers_action = filter_var($workers_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $workers = new Workers();
          $workers -> delete($workers_action);
            return $workers_action;
        }

        //-- Store Activity
        // Addactivity
        if(isset($_GET['activity']) && ($_GET['activity']=='add')){  //?log=l
          $activity_action = rtrim($_GET['activity'], '/'); // rtrim - Remove characters from the right side of a string:

          $activity_action = filter_var($activity_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $activity_action = explode('/', $activity_action);  //The explode() function breaks a string into an array.

          $activity = new StoreActivities();
          $activity -> add();
            return $activity_action;
        }

        // Update //./index.php?url=updateItem&id='.$lp.
        if(isset($_GET['activity']) && ($_GET['activity']=='upt')  && isset($_GET['id'])){  //?log=l
          $activity_action = rtrim($_GET['activity'], '/'); // rtrim - Remove characters from the right side of a string:
          echo $activity_action ;
          $activity_action= filter_var($activity_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $activity_action = explode('/', $activity_action);  //The explode() function breaks a string into an array.
          $id = rtrim($_GET['id'], '/');
          $id = filter_var($id, FILTER_SANITIZE_URL);
          echo "<br> activity: ".$id;
          $activity = new StoreActivities();
          $activity -> update($id);
            return $activity_action;
        }

        // Delete
        //if(isset($_GET['store']) && ($_GET['store']=='upt')){  //?log=l
        if(isset($_GET['activity_del'])){  //delete
          $activity_action = rtrim($_GET['activity_del'], '/'); // rtrim - Remove characters from the right side of a string:
          $activity_action= filter_var($activity_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $activity = new StoreActivities();
          $activity -> delete($activity_action);
            return $activity_action;
        }

        // Receive, get item
      if(isset($_GET['activity_add_receive']) ){

          $activity_action = rtrim($_GET['activity_add_receive'], '/'); // rtrim - Remove characters from the right side of a string:
          //echo $activity_action ;
          $activity_action= filter_var($activity_action, FILTER_SANITIZE_URL); /*The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=*/
          $activity_action = explode('/', $activity_action);  //The explode() function breaks a string into an array.
          $id = rtrim($_GET['id'], '/');
          $id = filter_var($id, FILTER_SANITIZE_URL);

          $ida = rtrim($_GET['ida'], '/');
          $ida = filter_var($ida, FILTER_SANITIZE_URL);
          //echo "<br> activity: ".$id;
          $activity = new StoreActivities();
          $activity -> addReceive($id,$ida);
            return $activity_action;

      }
    }
    }
