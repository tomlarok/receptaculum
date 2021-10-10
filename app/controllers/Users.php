<?php
class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {
        $data = [
            'login' => '',
          //  'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'loginError' => '',
        //    'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [
                'login' => trim($_POST['login']),
              //  'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'loginError' => '',
              //  'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validate login on letters/numbers
            if (empty($data['login'])) {
                $data['loginError'] = 'Please enter login.';
            } elseif (!preg_match($nameValidation, $data['login'])) {
                $data['loginError'] = 'Name can only contain letters and numbers.';
            }
/*
            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format.';
            } else {
                //Check if email exists.
                if ($this->userModel->findUserByEmail($data['email'])) {
                $data['emailError'] = 'Email is already taken.';
                }
            }
*/
           // Validate password on length, numeric values,
            if(empty($data['password'])){
              $data['passwordError'] = 'Please enter password.';
            } elseif(strlen($data['password']) < 6){
              $data['passwordError'] = 'Password must be at least 8 characters';
            } elseif (preg_match($passwordValidation, $data['password'])) {
              $data['passwordError'] = 'Password must be have at least one numeric value.';
            }

            //Validate confirm password
             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                }
            }

            // Make sure that errors are empty
            if (empty($data['loginError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Check if is the same login in BD, already exists.
                if($this->userModel->findUserByLogin($data['login'])){
                  $data['loginError'] = "This login already exists.";
                }
                  else{
                //Register user from model function
                  if ($this->userModel->register($data)) {
                      //Redirect to the login page
                      //header('location: ' . URLROOT . '/users/login');
                      //header('index.php');
                  } else {
                      die('Something went wrong.');
                  }
                }

                /*
                //Register user from model function
                if ($this->userModel->register($data)) {
                    //Redirect to the login page
                    //header('location: ' . URLROOT . '/users/login');
                    //header('index.php');
                } else {
                    die('Something went wrong.');
                }
                */
            }
        }
        print_r($data);
        $_SESSION["data"] = $data;  // TODO change?
      //  $this->view('users/register', $data);
    }

    public function login() {
        $data = [
            'title' => 'Login page',
            'login' => '',
            'password' => '',
            'loginError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'login' => trim($_POST['login']),
                'password' => trim($_POST['password']),
                'loginError' => '',
                'passwordError' => '',
            ];
            //Validate login
            if (empty($data['login'])) {
                $data['loginError'] = 'Please enter a login.';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }

            //Check if all errors are empty
            if (empty($data['loginError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['login'], $data['password']);
                echo $data['login']." ".$data['password']; // TEST
                is_null($loggedInUser);
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Password or login is incorrect. Please try again.';

                  //  $this->view('users/login', $data);
                }
            }

        } else {
            $data = [
                'login' => '',
                'password' => '',
                'loginError' => '',
                'passwordError' => ''
            ];
        }
      //  print_r($data);
        $_SESSION["data"] = $data;  // TODO change?
      //  $this->view('users/login', $data);
    }

    public function createUserSession($user) {
      //  $_SESSION['user_id'] = $user->id;
        $_SESSION['login'] = $user->login;
        echo "Zalogowany user: ".$_SESSION['login'];
        //$_SESSION['email'] = $user->email;
        //header('location:' . URLROOT . '/pages/index');
        header('index.php');  // after login
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['login']);
      //  unset($_SESSION['email']);
        //header('location:' . URLROOT . '/users/login');
        header('index.php');
    }
}
