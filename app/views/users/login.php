<?php
  // require APPROOT . '/views/includes/head.php';
  //require '/views/includes/head.php';

?>

    <?php
      // require APPROOT . '/views/includes/navigation.php';
    //  require '/views/includes/navigation.php';
    $data = $_SESSION["data"];
    if (!isset($_POST['login'])){
      $data = [ //TODO data przeysłana przez funkcje
          'title' => 'Home page',
          'loginError' => '',
          'passwordError' => '',
        //  'emailError' => '',
          'confirmPasswordError' => ''
      ];
    }
    ?>


<div class="container-login">
    <div class="wrapper-login">
      <h2>Sign in</h2>
      <div class="login-form">
        <form action="index.php?log=l" method ="POST"> <!-- URLROOT.VIEW Haslotestowe1!-->
            <input type="text" placeholder="login *" name="login">
            <span class="invalidFeedback"><br>
                <?php /*$data = $_SESSION['logdata']*/; echo $data['loginError']; ?>
            </span><br>

            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback"><br>
                <?php echo $data['passwordError']; ?>
            </span>
            <br>
            <button class="button"id="submit" type="submit" name="login_action" value="submit">Submit</button>

          <!-- <p class="options">Not registered yet? <a href="./app/views/users/register.php">Create an account!</a></p>-->
          <p class="options">Not registered yet? <a href="index.php?reg">Create an account!</a></p>
        </form>
      </div>
    </div>
</div>
