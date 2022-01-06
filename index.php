<?php
//include("require.php");
include("./app/require.php");
$page = "";
if(isset($_GET['login'])){
  //echo "login";
  $page = 'login';
//  header('Location: '.VIEWS.'index.php');
//exit();
}
if(isset($_GET['reg'])){
//  echo "Registration";
  $page = 'reg';//TODO delete?
//  header('Location: '.VIEWS.'index.php');
//exit();
}

if(isset($_GET['log']) && $_GET['log']== 'r'){
  $page = 'reg';//TODO delete?
}

if(isset($_GET['log']) && $_GET['log']== 'l'){
    $page = 'login';
}

?>
<html>
  <head>
    <?php include("./app/views/includes/head.php"); ?>
  </head>

<body>
  <!-- Banner -->
  <?php // include('./app/views/includes/banner.php'); ?>
    <!--navbar -->
  <?php include('./app/views/includes/nav.php'); ?>
  <!-- Loading pages -->
  <!-- Load page -->
  <div class="homeplace">

    <a href="index.php?login"> Log in</a> |
    <a href="index.php?url=about"> About</a> |
    <a href="index.php?url=welcome"> Hi, welcome</a><br>

  </div>

  <!-- Page Content -->
<section class="py-5"> <!-- p - for classes that set padding, y - for classes that set both *-top and *-bottom -->
  <div class="container">
  <?php
  //include('./app/views/users/login.php');
  //echo $page;
  if(isset($_SESSION['login'])){
    echo "<br>Hi ".$_SESSION['login']. "<br>";
  }
  if($page == "login"){
    //echo "logon";
    include(VIEWS.'/users/login.php');
  }
  if($page == "reg"){
    include(VIEWS.'/users/register.php');
  }
  if(isset($_GET['url'])){
    $page = $_GET['url'];
    include(VIEWS.'/pages/'.$page.'.php');
  }

  ?>
  </div>
</section>

</body>
</html>
