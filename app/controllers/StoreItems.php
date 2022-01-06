<?php
class StoreItems extends Controller {
    public function __construct() {
        $this->storeModel = $this->model('Store');
    }

    public function get(){
      $store = $this->storeModel->getStoreItems();

      $data = [
          'store' => $store
      ];

      return $data;
    }

    public function getSingle($id){
      $data = [
        'id_item' => $id,
        'item_name' => '',
        'item_info' => '',
        'item_group' => '',
        'item_location' => '',
        'item_error' => ''
      ];
      $store = $this->storeModel->getSingleStoreItem($data);

      $data = [
        'store' => $store
      ];

      return $data;
    }

    public function add(){ //TODO change validation routing data

      $data = [
          'item_name' => '',
          'item_info' => '',
          'item_group' => '',
          'item_sn' => '',
          'item_location' => '',
          'item_handing_over' => '', // in
          'item_error' => ''
      ];

      //Check for post
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
          //Sanitize post data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data = [
              'item_name' => trim($_POST['item_name']),
              'item_info' => trim($_POST['item_info']),
              'item_group' => trim($_POST['item_group']),
              'item_sn' => trim($_POST['item_sn']),
              'item_location' => trim($_POST['item_location']),
              'item_handing_over' => 'in',
              'item_error' => ''
          ];
          //Validate login
          if (empty($data['item_name'])) {
              $data['item_error'] = 'Podaj nazwę.';
          }

          //Validate password
          if (empty($data['item_group'])) {
              $data['item_error'] = 'Podaje kategorię.';
          }

          //Check if all errors are empty
          if (empty($data['item_error'])) {
              $store = $this->storeModel->addStoreItem($data);

              is_null($store);
              if ($store) {
                  echo "<br> Dodano pozycję <br>";
              } else {
                  $data['itemError'] = 'Błąd dodania.';

              }
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

    public function update($id){ //TODO change validation routing data

      //Check for post
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
          //Sanitize post data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data = [
              'id_item' => $id,
              'item_name' => trim($_POST['item_name']),
              'item_info' => trim($_POST['item_info']),
              'item_group' => trim($_POST['item_group']),
              'item_location' => trim($_POST['item_location']),
              'item_error' => ''
          ];
          //Validate login
          if (empty($data['item_name'])) {
              $data['item_error'] = 'Podaj nazwę.';
          }

          //Validate password
          if (empty($data['item_group'])) {
              $data['item_error'] = 'Podaj kategorię.';
          }

          //Check if all errors are empty
          if (empty($data['item_error'])) {
              $store = $this->storeModel->updateStoreItem($data);

              is_null($store);
              if ($store) {
                  echo "<br> Zmieniono pozycję <br>";
              } else {
                  $data['itemError'] = 'Błąd zmiany pozycji.';

              }
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

    public function delete($id){ //TODO change validation routing data
      $store = $this->storeModel->deleteStoreItem($id);

      return $id;
    }

    public function getItemIdActivity($id){
      $this->StoreActModel = $this->model('StoreAct');
      $data = [
          'id_item' => $id,
          'item_error' => ''
      ];
      $store = $this->StoreActModel->getStoreActivitybyIdItem($data);
      $data = [
          'store' => $store
      ];
      return $data;
    }

}
