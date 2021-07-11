<?php
class Workers extends Controller {
    public function __construct() {
        $this->workerModel = $this->model('Worker');
    }

    public function get(){
      $worker= $this->workerModel->getWorkers();
      $data = [
          'workers' => $worker
      ];
;
      return $data;
    }

    public function getSingleWorker($id){ //	id_worker 	name 	last_name 	post
      $data = [
        'id_worker' => $id,
        'name' => '',
        'last_name' => '',
        'post' => '',
        'error' => ''
      ];
      $worker = $this->workerModel->getSingleWorker($data);

      $data = [
        'workers' => $worker
      ];

      return $data;
    }

    public function add(){ //TODO change validation routing data

      $data = [
          'name' => '',
          'last_name' => '',
          'post' => '',
          'error' => ''
      ];

      //Check for post
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
          //Sanitize post data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data = [
              'name' => trim($_POST['name']),
              'last_name' => trim($_POST['last_name']),
              'post' => trim($_POST['post']),
              'error' => ''
          ];
          //Validate name
          if (empty($data['item_name'])) {
              $data['error'] = 'Podaj imię.';
          }

          //Validate surname
          if (empty($data['last_name'])) {
              $data['last_name'] = 'Podaje nazwisko.';
          }

          //Check if all errors are empty
          if (empty($data['item_error'])) {
              $worker = $this->workerModel->addWorker($data);
              //echo $data['login']." ".$data['password']; // TEST
              is_null($worker);
              if ($worker) {
                  echo "<br> Dodano pozycję <br>";
              } else {
                  $data['error'] = 'Błąd dodania.';

                //  $this->view('users/login', $data);
              }
          }

      } else {
        $data = [
          'name' => '',
          'last_name' => '',
          'post' => '',
          'error' => ''
        ];
      }

    }

    public function update($id){ //TODO change validation routing data

      //Check for post
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
          //Sanitize post data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data = [
              'id_worker' => $id,
              'name' => trim($_POST['name']),
              'last_name' => trim($_POST['last_name']),
              'post' => trim($_POST['post']),
              'error' => ''
          ];
          //Validate login
          if (empty($data['name'])) {
              $data['error'] = 'Podaj imię.';
          }

          //Validate password
          if (empty($data['last_name'])) {
              $data['error'] = 'Podaj nazwisko';
          }

          //Check if all errors are empty
          //if (empty($data['loginError']) && empty($data['passwordError'])) {
          if (empty($data['error'])) {
              $worker = $this->workerModel->updateWorker($data);
              //echo $data['login']." ".$data['password']; // TEST
              is_null($worker);
              if ($worker) {
                  echo "<br> Zmieniono pozycję <br>";
              } else {
                  $data['error'] = 'Błąd zmiany pozycji.';

                //  $this->view('users/login', $data);
              }
          }

      } else {
        $data = [
          'name' => '',
          'last_name' => '',
          'post' => '',
          'error' => ''
        ];
      }
    }

    public function delete($id){ //TODO change validation routing data
      $worker = $this->workerModel->deleteWorker($id);
                echo "Store class  Delete <br>";
      //return $worker;
      return $id;
    }


}
