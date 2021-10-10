<?php
class StoreActivities extends Controller {
    public function __construct() {
    //  $mem_usage = memory_get_usage();
    //  echo "<br> Memory Contr SA ".$mem_usage."<br>";
        //$this->storeModel = $this->model('StoreActivities');
      //  $this->storeActivitiesModel = $this->model('StoreActivities');
        $this->workerModel = $this->model('Worker');
        $this->storeModel = $this->model('Store');
        //$this->userModel = $this->model('User');
        $this->StoreActModel = $this->model('StoreAct');
      //  $mem_usage = memory_get_usage();
      //  echo "<br> Memory Contr SA2 ".$mem_usage."<br>";
    }

    public function get(){
      $store_activity = $this->StoreActModel->getStoreActivities();
      //$store_activity = $this->storeModel->getStoreActivities();
    //  $store = "magazynek"; // TODO test!
      $store = $this->storeModel->getStoreItems();
      $workers = $this->workerModel->getWorkers();
      //>getStoreItems();
      //$workers = $this->userModel->getWorkers();

      $data = [
          'workers' => $workers,
          'store' => $store,
          'store_activity' => $store_activity
      ];
    //  var_dump($data);
            //    echo "Store class Test <br>";
    //  $this->view('?url=store', $data);
    //  $_SESSION["data_store"] = $data;  // TODO change?
      //return $store;
      return $data;
    }

    public function getSingle($id){
      $data = [
        'id_activity' => $id,
        'id_item' => '',
        'id_worker' => '',
        'date' => '',
        'activity' => ''
      ];
      $store_activity = $this->StoreActModel->getSingleStoreActivity($data);
      //$store = $this->storeModel->getSingleStoreActivity($data);
      $data = [
        'store_activity' => $store_activity
      ];

      return $data;
    }

    public function add(){ //TODO change validation routing data

      $data = [
          //'id_activity' => $id,
          'id_item' => '',
          'id_worker' => '',
          'date' => '',
          'activity' => ''
      ];

      //Check for post
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
          //Sanitize post data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          echo date("Y-m-d H:i:s");
          echo "Id item contorleer: ".trim($_POST['id_item']);
        //  echo trim($_POST['id_worker']);
          $data = [
              'id_item' => trim($_POST['id_item']),
              'id_worker' => trim($_POST['id_worker']),
              //'date' => date("Y-m-d H:i:s"),
              //'date' => trim($_POST['date']),
              'activity' => 'out',
              //'activity' => trim($_POST['activity']),
              'item_error' => ''
          ];
          echo "<br> Id item: ".$data['id_item'];
          echo "<br> Id worker: ".$data['id_worker'];
          //echo "<br> item_error: ".$data['item_error'];
          //Validate name TODO Delete if it will be choose from drop list
          if (empty($data['id_item'])) {
              $data['item_error'] = 'Podaj nazwę.';
          }

        /*  //Validate activity TODO Delete if it will be choose from drop list
          if (empty($data['date'])) {
              $data['item_error'] = 'Podaje datę i czas.';
          }
        */
          //Check if all errors are empty
          //if (empty($data['loginError']) && empty($data['passwordError'])) {
          if (empty($data['item_error'])) {
              $store = $this->StoreActModel->addStoreActivity($data);
              //echo $data['login']." ".$data['password']; // TEST
              is_null($store);
              if ($store) {
                  echo "<br> Dodano pozycję <br>";
              } else {
                  $data['itemError'] = 'Błąd dodania.';

                //  $this->view('users/login', $data);
              }
          }

      } else {
        $data = [
            'item_name' => '',
            'id_worker' => '',
            'date' => '',
            'activity' => '',
            'item_error' => ''
        ];
      }

    }

    public function update($id){ //TODO change validation routing data
    //  $store = $this->storeModel->updateStoreItem();

      //Check for post
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
          //Sanitize post data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data = [
              'id_item' => $id,
              'item_name' => trim($_POST['item_name']),
              'id_worker' => trim($_POST['id_worker']),
              'date' => trim($_POST['date']),
              'activity' => trim($_POST['activity']),
              'item_error' => ''
          ];
          //Validate name TODO Delete if it will be choose from drop list
          if (empty($data['item_name'])) {
              $data['item_error'] = 'Podaj nazwę.';
          }

          //Validate activity TODO Delete if it will be choose from drop list
          if (empty($data['date'])) {
              $data['item_error'] = 'Podaj kategorię.';
          }

          //Check if all errors are empty
          //if (empty($data['loginError']) && empty($data['passwordError'])) {
          if (empty($data['item_error'])) {
              //$store = $this->storeModel->updateStoreActivity($data);
              $store = $this->StoreActModel->updateStoreActivity($data);
              //echo $data['login']." ".$data['password']; // TEST
              is_null($store);
              if ($store) {
                  echo "<br> Zmieniono pozycję <br>";
              } else {
                  $data['itemError'] = 'Błąd zmiany pozycji.';

                //  $this->view('users/login', $data);
              }
          }

      } else {
        $data = [
            'id_item' => '',
            'id_worker' => '',
            'date' => '',
            'activity' => '',
            'item_error' => ''
        ];
      }
    }

    public function delete($id){ //TODO change validation routing data
      $store = $this->StoreActModel->deleteStoreActivity($id);
      //$store = $this->storeModel->deleteStoreActivity($id);

    /*  $data = [
          'store' => $store
      ];  */;
                echo "Store class  Delete <br>";
    //  $this->view('?url=store', $data);
    //  $_SESSION["data_store"] = $data;  // TODO change?
      //return $store;
      return $id;
    }


}
