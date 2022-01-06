<?php
class FindStoreItems extends Controller {

    public function __construct() {

        $this->storeModel = $this->model('Store');
        $this->StoreActModel = $this->model('StoreAct');
      }

      public function findStoreItem(){
        // Searching by the empty inputs
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'item_name' => trim($_POST['name']),
                'worker' => trim($_POST['worker']),
                'sn' => trim($_POST['sn']),
                'error' => ''
            ];

            if (!empty($data['item_name'])) {
              $store_activity = $this->StoreActModel->findStoreActivitybyItem($data);

            } elseif (!empty($data['worker'])) {
              //var_dump($data);
              $store_activity = $this->StoreActModel->findStoreActivitybyWorker($data);
            //  $store_activity = $this->testModel->getStoreActivitybyIdWorker($store_activity);
            }
            elseif (!empty($data['sn'])) {
              $store_activity = $this->StoreActModel->findStoreActivitybySN($data);
              // Get id_item from the same item with right SN
            //  $store_activit = $this->testModel->getStoreActivitybyIdItem($store_activity);
            }


            $data = [
              'store_activity' => $store_activity
            ];

            return $data;
          }
    }

    public function getStoreActivitybyIdWorker($id_worker){
      $data = [
          'item_name' => '',
          'id_worker' => $id_worker,
          'sn' => '',
          'error' => ''
      ];

      $store_activity = $this->StoreActModel->getStoreActivitybyIdWorker($data);

      $data = [
        'store_activity' => $store_activity
      ];

      return $data;
    }

    public function findItemInStore(){
      // Searching by the empty inputs
      //$store_activity = new Test;
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
          //Sanitize post data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data = [
              'item_name' => trim($_POST['name']),
              'item_sn' => trim($_POST['sn']),
              'error' => ''
          ];

          if (!empty($data['item_name'])) {
            $store = $this->storeModel->findStoreItembyItem($data);
          }
          elseif (!empty($data['sn'])) {
            $store = $this->storeModel->findStoreItembySN($data);
          }

          $data = [
            'store' => $store
          ];
          return $data;

        }

  }

}
