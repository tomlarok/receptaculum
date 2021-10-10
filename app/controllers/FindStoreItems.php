<?php
class FindStoreItems extends Controller {

    public function __construct() {

      //  $this->workerModel = $this->model('Worker');
      //  $this->storeModel = $this->model('Store');
        $this->StoreActModel = $this->model('StoreAct');
      }

      public function findStoreItem(){
        // Searching by the empty inputs
        //$store_activity = new Test;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'item_name' => trim($_POST['name']),
                'worker' => trim($_POST['worker']),
                'sn' => trim($_POST['sn']),
                'error' => ''
            ];
            /*
            if (empty($data['item_name'])) {
              $store_activity = $this->testModel->findStoreActivitybyItem($data);
            } else {
              $store_activity = $this->testModel->findStoreActivitybySN($data);
            } else {
              $store_activity = $this->testModel->findStoreActivitybyWorker($data);
            } else {
              $data['error'] = "Podaj słowo kluczowe do szukania.";
            }
            */
            if (!empty($data['item_name'])) {
              $store_activity = $this->StoreActModel->findStoreActivitybyItem($data);
              /*
            //  var_dump($data);
                foreach($store['store'] as $r):
                  //$id_worker = $r->id_worker;
                  $id_item = $r->id_item;
                  $item_name = $r->item_name;
                  $item_info = $r->item_info;
                  $item_group = $r->item_grop;
                  $item_location = $r->item_location;
                  //$date = $r->date;
                  //$activity = $r->activity;
                //  foreach($row['store'] as $k):
                    $data = [
                        'id_activity' => '',
                        'id_item' => $id_item,
                        'id_worker' => '',
                        'date' => '',
                        'activity' => '',
                        'error' => ''
                    ];
                    $store_activity = $this->testModel->getStoreActivitybyIdItem($data);
                    foreach($store_activity['store_activity'] as $store):
                        $id_worker = $store->id_worker;
                        $id_item = $store->id_item;
                        $date = $store->date;
                        echo "<br> pracownik: ".$id_worker;
                        echo "<br> item: ".$id_item;
                    endforeach;
                //  endforeach
                endforeach;
                */
              //$store_activity = $this->testModel->getStoreActivitybyIdItem($data);

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
            //var_dump($data);
            return $data;
          //  public function($store_activity);
          }
          /*
          public function($store_activity) {
            $data = [
              'store' => $store_activity
            ];

            return $data;
          }
          */

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
      //var_dump($data);
      return $data;
    }

}
