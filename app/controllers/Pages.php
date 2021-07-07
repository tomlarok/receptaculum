<?php
class Pages extends Controller {
    public function __construct() {
        //$this->userModel = $this->model('User');
        echo "Pages<br>";
    }

    public function index() {
        $data = [
            'title' => 'Home page',
            'usernameError' => '',
            'passwordError' => ''
        ];

        $this->view('index', $data);
    }

    public function about() {
        $this->view('about');
    }
}
