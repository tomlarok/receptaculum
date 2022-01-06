<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
  <a class="navbar-brand" href="#"><img src="./public/img/home2.png"></a>

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Strona Główna</a>
    </li>

    <?php
    if(isset($_SESSION['login'])){
    print '
    <li class="nav-item">
      <a class="nav-link" href="index.php?url=store">Magazyn</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?url=workers">Pracownicy</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?url=store_activities">Operacje</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?log=out">Log out</a>
    </li>';
//  } else {
  //  print '<a class="navbar-brand" href="index.php?log=out"><img src="./public/img/log_in.png"></a>';
  }
  // TODO change below things!
    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {

      if ( substr($user, 0, 12) == ("admin"))
      {
        print '
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin konto</a></li>
        ';
      }else{
        print '
        <li class="nav-item">
          <a class="nav-link" href="user.php">User konto</a></li>
        ';
      }
    }
    ?>
  </ul>


<ul class="navbar-nav">

</ul>
<div class="d-flex">
  <ul class="navbar-nav">
  <li class="navbar-right">


    <!--  Utwórz konto -->
  </li>
  <li class="navbar-right">  | </li>
  <?php
if (!isset($_SESSION['login']))
{
  // Log in
  print '
  <li class="navbar-right">
     <a class="navbar-brand" href="index.php?login"><img src="./public/img/log_in.png"></a>
  </li>
  ';

} else {
  // Log out
  print '
  <li class="navbar-right">
     <a class="navbar-brand" href="index.php?log=out"><img src="./public/img/log_out.png"></a>
  </li>
  ';
/*
print '
  <li class="navbar-right">
      <a href = "./controllers/logout.php"><img src="./views/img/log_out.png" /></a>
  <!--    <a href = "./controllers/logout.php">Wyloguj</a> -->
  </li>
  ';
  */
}

?>
</ul>

</div>

</nav>
