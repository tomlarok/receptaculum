<?php
//   require APPROOT . '/views/includes/head.php';
//require './app/views/includes/head.php';
//session_start();
?>

<div class="navbar">
    <?php
    //   require APPROOT . '/views/includes/navigation.php';
    //47SXi9hHxRDeWQn HasloTomka1@
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
</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>
        <div class="login-form">
            <form
                id="register-form"
                method="POST"
                action="index.php?log=r"
                >
            <input type="text" placeholder="login *" name="login">
            <span class="invalidFeedback"><br>
                <?php echo $data['loginError']; ?>
            </span>
<!-- TODO Zmienić by nie można było dodać takiego samego usera!!!
            <input type="email" placeholder="Email *" name="email">
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>
-->
            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback"><br>
                <?php echo $data['passwordError']; ?>
            </span><br>

            <input type="password" placeholder="Confirm Password *" name="confirmPassword">
            <span class="invalidFeedback"><br>
                <?php echo $data['confirmPasswordError']; ?>
            </span><br>

            <button class="button"id="submit" type="submit" value="submit">Submit</button>

        </form>
      </div>
    </div>
</div>
