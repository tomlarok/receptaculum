<?php
    //Load the model and the view
    class Controller {
        public function model($model) {
            //Require model file
          //  echo "<br> Contoler </br>";
          //  require_once '../app/models/' . $model . '.php';
            //require_once __ROOT__.'/models/' . $model . '.php';
            require_once './app/models/' . $model . '.php';
            //Instantiate model
            return new $model();
        }

        //Load the view (checks for the file)
        public function view($view, $data = []) {
        //  echo "<br>".$view."<br>";
      /*      if (file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            } else {
                die("View does not exists.");
            }
        */
        if (file_exists('./index.php' . $view)) {
            require_once './index.php' . $view;
            echo ('index.php' . $view. '<br>');
        } else {
            echo ('index.php' . $view. '<br>');
            die("View does not exists!!!.");
        }

        /* // version old
            if (file_exists('./app/views/' . $view . '.php')) {
                require_once './app/views/' . $view . '.php';
            } else {
                die("View does not exists2.");
            }
          */
            /*
            if (file_exists(__ROOT__.'/views/' . $view . '.php')) {
                require_once __ROOT__.'/views/' . $view . '.php';
            } else {
                die("View does not exists2.");
            }
            */
        }
    }
