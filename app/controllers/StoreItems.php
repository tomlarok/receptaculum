<?php
class StoreItems extends Controller {
    public function __construct() {
        $this->storeModel = $this->model('Store');
    }

    public function get(){
      $store = $this->storeModel->getStoreItems();
    //  $store = "magazynek"; // TODO test!
      $data = [
          'store' => $store
      ];
                echo "Store class Test <br>";
    //  $this->view('?url=store', $data);
    //  $_SESSION["data_store"] = $data;  // TODO change?
      //return $store;
      return $data;
    }

    public function update(){ //TODO change validation routing data 
      $store = $this->storeModel->updateStoreItem()();
      $data = [
          'store' => $store
      ];
                echo "Store class Test <br>";
    //  $this->view('?url=store', $data);
    //  $_SESSION["data_store"] = $data;  // TODO change?
      //return $store;
      return $data;
    }


}
