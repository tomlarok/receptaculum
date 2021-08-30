<?php
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {

        $this->db->query('INSERT INTO users (login, password) VALUES(:login, :password)');
        //$this->db->query('INSERT INTO users (login, email, password) VALUES(:login, :email, :password)');


        //Bind values
        $this->db->bind(':login', $data['login']);
      //  $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($login, $password) {
        $this->db->query('SELECT * FROM users WHERE login = :login');
      //  $this->db->query('SELECT login, password FROM users WHERE login = :login');
        //Bind value
        $this->db->bind(':login', $login);

        $row = $this->db->single(); //select singel row
      //  echo "Test login";
        if(!empty($row) ){
        //  print_r($row);
          $hashedPassword = $row->password; //TODO if login is not in table users (?login, pass are incorect?) -> Notice: Trying to get property of non-object in /opt/lampp/htdocs/template/app/models/User.php on line 33
          echo $row->password;
          if (password_verify($password, $hashedPassword)) {  // TODO change to #pass
        //  if ($password == $hashedPassword) {
              echo "<br>True, password correct!</br>";
              return $row;
          } else {
            echo "<br>False, password incorrect!</br>";
              return false;
          }
        } else {
        //  echo " Null<br>";
        }
        /*
        print_r($row);
        $hashedPassword = $row->password; //TODO if login is not in table users (?login, pass are incorect?) -> Notice: Trying to get property of non-object in /opt/lampp/htdocs/template/app/models/User.php on line 33

        if (password_verify($password, $hashedPassword)) {  // TODO change to #pass
      //  if ($password == $hashedPassword) {
            return $row;
        } else {
            return false;
        }
        */
    }

    //Find user by login. Login is passed in by the Controller.
    public function findUserByLogin($login) {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE login = :login');

        //Email param will be binded with the login variable
        $this->db->bind(':login', $login);

        //Check if login is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
