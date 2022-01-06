<?php
    //Load the model and the view
    class Controller {
        public function model($model) {
            //Require model file
            require_once './app/models/' . $model . '.php';
            //Instantiate model
            return new $model();
        }

        public function view($view, $data = []) {

        if (file_exists('./index.php' . $view)) {
            require_once './index.php' . $view;
            echo ('index.php' . $view. '<br>');
        } else {
            echo ('index.php' . $view. '<br>');
            die("View does not exists!!!.");
        }

        }
    }
