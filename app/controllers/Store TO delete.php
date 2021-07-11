<?php
class Stors extends Controller {
    public function __construct() {
        $this->storeModel = $this->model('StoreItem');
    }
// TODO delete CLasss?
    public function get(){
      $store = $this->storeModel->getStoreItems();
      $store = "magazynek"; // TODO test!
      $data = [
          'store' => $store
      ];
                echo "Store class";
      $this->view('index.php?url=store', $data);
      $_SESSION["data_store"] = $data;  // TODO change?
    }


}
