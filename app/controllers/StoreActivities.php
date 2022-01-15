<?php
class StoreActivities extends Controller {
    public function __construct() {
    //  $mem_usage = memory_get_usage();
    //  echo "<br> Memory Contr SA ".$mem_usage."<br>";
        $this->workerModel = $this->model('Worker');
        $this->storeModel = $this->model('Store');
        $this->StoreActModel = $this->model('StoreAct');
      //  $mem_usage = memory_get_usage();
      //  echo "<br> Memory Contr SA2 ".$mem_usage."<br>";
    }

    public function get(){
      $store_activity = $this->StoreActModel->getStoreActivities();
      $store = $this->storeModel->getStoreItems();
      $workers = $this->workerModel->getWorkers();

      $data = [
          'workers' => $workers,
          'store' => $store,
          'store_activity' => $store_activity
      ];
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
        //  echo date("Y-m-d H:i:s"); //TODO Delete after
        //  echo "Id item contorleer: ".trim($_POST['id_item']);
        //  echo trim($_POST['id_worker']);
        if (empty(trim($_POST['date']))) {
          $date = date('Y-m-d H:i:s');
        } else {
          $date = trim($_POST['date']);
        }
          $data = [
              'id_item' => trim($_POST['id_item']),
              'id_worker' => trim($_POST['id_worker']),
              //'date' => date("Y-m-d H:i:s"),
              'date' => $date,
              //'date' => (date('Y-m-d H:i:s')),
              //'date' => trim($_POST['date']),
              'activity' => 'out',
              //'activity' => trim($_POST['activity']),
              'item_error' => ''
          ];

          //Validate name TODO Delete if it will be choose from drop list
          if (empty($data['id_item'])) {
              $data['item_error'] = 'Podaj nazwę.';
          }

          // TODO: if (empty($data['item_error']) && checkIfItemIsFree()==True) {
          $isfree = $this->checkIfItemIsFree($data['id_item']);
          //echo "<br>ID .".$data['id_item']." isfre: ".$isfree; // // TODO: delete ater test
          if (empty($data['item_error']) && $isfree == "in") {
              $store = $this->StoreActModel->addStoreActivity($data);
              //echo $data['login']." ".$data['password']; // TEST
              is_null($store);
              if ($store) {
                // TODO change in tabale store value to out
                $this->updateStoreItemHandingOver($data['id_item']);
                  echo "<br> Dodano pozycję <br>";
              } else {
                  $data['itemError'] = 'Błąd dodania.';

                //  $this->view('users/login', $data);
              }
            }else {
              $data['itemError'] = 'Nie ma w magazynie. Wydane już.';
              echo "<br> Nie ma w magazynie. Wydane już. <br>";
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
      //return $store;
      return $id;
    }

    // TODO: Function to check if item is free, in a store amd nobody has it
    public function checkIfItemIsFree($id){
      $st = new StoreItems;
      //$data = $st->get();
      $data = $st ->getSingle($id);
      foreach($data['store'] as $store):
        $item_name = $store->item_name;
        $item_group = $store->item_group;
        $item_info = $store->item_info;
        $item_location = $store->item_location;
        $item_handing_over = $store->item_handing_over;
      endforeach;
      //echo "<br>item_handing_over: ".$item_handing_over; //TODO delete after test
      if ($item_handing_over == 'in') { // value - in store, out
        //echo "<br>".$item_handing_over; //TODO delete after test
        return $item_handing_over;
      } else {
        $error = $item_name." jest już wydane.";
        //echo "<br>".$error; //TODO delete after test
        return $error;
      }
    }

    public function updateStoreItemHandingOver($id){
      $data = [
          'id_item' => $id,
          'item_name' => '',
          'item_info' => '',
          'item_group' => '',
          'item_sn' => '',
          'item_location' => '',
          'item_handing_over' => 'out',
          'item_error' => ''
      ];
      if (empty($data['item_error'])) { // TODO change if statement?
          $store = $this->storeModel->updateStoreItemHandingOver($data);
          //echo $data['login']." ".$data['password']; // TEST
          is_null($store);
          if ($store) {
              echo "<br> Zmieniono pozycję na out <br>";
          } else {
              $data['itemError'] = 'Błąd zmiany pozycji.';

            //  $this->view('users/login', $data);
          }
      } else {
        $data = [
            'item_name' => '',
            'item_info' => '',
            'item_group' => '',
            'item_location' => '',
            'item_error' => ''
        ];
      }
    }

    public function addReceive($id, $ida){
      // add Receive activity
            $data = [
                //'id_activity' => $id,
                'id_item' => '',
                'id_worker' => '',
                'date' => '',
                'activity' => ''
            ];
            // TODO get id_activity. Search activity with 'out' by id_activity.
            // Get data from this avtivity and insert new activity in DB.
            $activity = $this->getSingle($ida);
            foreach($activity['store_activity'] as $a):
              $id_item = $a->id_item;
              $id_worker = $a->id_worker;
            endforeach;
// TODO incorrect number ids Error
                $data = [
                    'id_item' => $id_item, //$activity['id_item'],file
                    'id_worker' => $id_worker, //$activity['id_worker'],
                    'date' => (date('Y-m-d H:i:s')),
                    'activity' => 'in',
                    'item_error' => ''
                ];

              //  if (empty($data['item_error']) && $isfree == "out") {
                    $store = $this->StoreActModel->addStoreActivity($data);
                    //echo $data['login']." ".$data['password']; // TEST
                    is_null($store);
                    if ($store) {
                      // TODO change in tabale store value to out
                      //$this->updateStoreItemHandingOver($data['id_item']);
                        echo "<br> Dodano pozycję <br>";
                    } else {
                        $data['itemError'] = 'Błąd dodania.';

                      //  $this->view('users/login', $data);
                    } /*
                  }else {
                    $data['itemError'] = 'Nie ma w magazynie. Wydane już.';
                    echo "<br> Nie ma w magazynie. Wydane już. <br>";
                  } */

      // change value in a store table, in column item_handing_over from 'out' to 'in'
      $this->updateStoreItemHandingOverIn($id);
    }

    public function updateStoreItemHandingOverIn($id){ //TODO change .. And ..In in one function?
      $data = [
          'id_item' => $id,
          'item_name' => '',
          'item_info' => '',
          'item_group' => '',
          'item_sn' => '',
          'item_location' => '',
          'item_handing_over' => 'in',
          'item_error' => ''
      ];
      if (empty($data['item_error'])) { // TODO change if statement?
          $store = $this->storeModel->updateStoreItemHandingOver($data);
          //echo $data['login']." ".$data['password']; // TEST
          is_null($store);
          if ($store) {
              echo "<br> Zmieniono pozycję na in <br>";
          } else {
              $data['itemError'] = 'Błąd zmiany pozycji.';

            //  $this->view('users/login', $data);
          }
      } else {
        $data = [
            'item_name' => '',
            'item_info' => '',
            'item_group' => '',
            'item_location' => '',
            'item_error' => ''
        ];
      }
    }

}
