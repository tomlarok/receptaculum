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

require_once 'lib/Core.php';
require_once 'lib/Controller.php';
require_once 'lib/Database.php';
require_once 'controllers/config/config.php';
// it is necessary?
require_once 'controllers/Users.php';
require_once 'controllers/StoreItems.php';
require_once 'controllers/StoreActivities.php';
require_once 'controllers/Workers.php';

    //Instantiate core class
    $init = new Core();
