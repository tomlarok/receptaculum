<?php
 session_start();
 // session data of pages
// $_SESSION["data"] = array();
if (!isset($_SESSION["data"])){
  $_SESSION["data"] = array();
}

// TODO Change?!?!?
if (!isset($_SESSION["data_store"])){
  $_SESSION["data_store"] = array();
}

 //echo "hej";
//require_once 'controllers/users.php';
//require_once 'controllers/test.php';
//include 'controllers/users.php';
//$user = new Users();
//require_once 'libraries/controller.php';

//Require libraries from folder libraries
//require_once 'lib/test.php';
require_once 'lib/Core.php';
require_once 'lib/Controller.php';
require_once 'lib/Database.php';
require_once 'controllers/config/config.php';
// it is necessary?
require_once 'controllers/Users.php';
require_once 'controllers/StoreItems.php';

require_once 'controllers/Workers.php';
/*//require_once './app/helpers/session_helper.php';

    //Require libraries from folder libraries
    require_once 'lib/test.php';
    require_once './app/libraries/Core.php';
    require_once './app/libraries/Controller.php';
    require_once './app/libraries/Database.php';
    require_once './app/helpers/session_helper.php';
*/
//    require_once './app/config/config.php';

    //Instantiate core class
    $init = new Core();
