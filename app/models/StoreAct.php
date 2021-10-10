<?php
class StoreAct{
    private $db;
    public function __construct() {
        $this->db = new Database;
    }
    //Get items from Store, DB.
    public function getStoreActivities() {
        //Prepared statement
        $this->db->query('SELECT * FROM store_activity');

        $results = $this->db->resultSet();
        return $results;

    }
// TODO get info from other table name, worker, etc.
    //Get single item from table Store, from DB.
    public function getSingleStoreActivity($data) {
        //Prepared statement
        $this->db->query('SELECT * FROM store_activity WHERE id_activity = :id_activity');
        $this->db->bind(':id_activity', $data['id_activity']);
        // It might be more other elements, values to searchin by this elements
        $results = $this->db->resultSet();
        return $results;

    }
/*
    public function getSingleStoreActivity2($data) {  //TODO delete if it will be NOT necessery
        //Prepared statement
        $this->db->query('SELECT * FROM store_activity WHERE id_activity = :id_activity');
        $this->db->bind(':id_activity', $data['id_activity']);
        // It might be more other elements, values to searchin by this elements
        $results = $this->db->resultSet();
        return $results;

      }
*/
    public function addStoreActivity($data){
    /*  $this->db->query('INSERT INTO store_activity (id_item,	id_worker, date, activity)
      VALUES (:id_item,	:id_worker, NOW(), :activity)');  // Date()
      */
      $this->db->query('INSERT INTO store_activity (id_item,	id_worker, activity)
      VALUES (:id_item,	:id_worker, :activity)');  // Date()

      $this->db->bind(':id_item', $data['id_item']);
      $this->db->bind(':id_worker', $data['id_worker']);
      $this->db->bind(':activity', $data['activity']);
    // Data()  $this->db->bind(':item_location', $data['item_location']);

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }

    public function deleteStoreActivity($data){
      $this->db->query('DELETE FROM store_activity WHERE id_activity = :id_activity');
      $this->db->bind(':id_activity', $data);

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }

    public function updateStoreActivity($data){
      $this->db->query('UPDATE store_activity SET id_item = :id_item,	id_worker  = :id_worker, activity = :activity
      WHERE id_activity = :id_activity');
      $this->db->bind(':id_activity', $data['id_activity']);
      $this->db->bind(':id_item', $data['id_item']);
      $this->db->bind(':id_worker', $data['id_worker']);
      $this->db->bind(':activity', $data['activity']);

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }

    public function findStoreActivitybyItem($data) {
        //Prepared statement
        //var_dump($data);
        //$this->db->query('SELECT * FROM store_activity WHERE id_activity = :id_activity');
        //$this->db->query("SELECT * FROM store WHERE item_name LIKE CONCAT('%',:item_name,'%');");
        $this->db->query("SELECT * FROM store_activity WHERE id_item IN
          (SELECT id_item FROM store WHERE item_name LIKE CONCAT('%',:item_name,'%'))");
        $this->db->bind(':item_name', $data['item_name']);
        // It might be more other elements, values to searchin by this elements
        $results = $this->db->resultSet();
        return $results;

    }

    public function findStoreActivitybySN($data) {
        //Prepared statement
        //$this->db->query('SELECT * FROM store_activity WHERE id_activity = :id_activity');

        $this->db->query("SELECT * FROM store WHERE item_sn LIKE CONCAT('%',:item_sn,'%');");  //TODO change query!
        $this->db->bind(':item_sn', $data['item_sn']);
        // It might be more other elements, values to searchin by this elements
        $results = $this->db->resultSet();
        return $results;

    }

    public function findStoreActivitybyWorker($data) {
        //Prepared statement
        //var_dump($data);
        //$this->db->query('SELECT * FROM store_activity WHERE id_activity = :id_activity');
        //$this->db->query("SELECT * FROM workers WHERE name LIKE CONCAT('%',name,'%');");
        /* SELECT * FROM store_activity WHERE id_worker IN
          (SELECT id_worker FROM workers WHERE last_name LIKE CONCAT('%',"gor",'%')) */
        $this->db->query("SELECT * FROM store_activity WHERE id_worker IN
          (SELECT id_worker FROM workers WHERE last_name LIKE CONCAT('%',:last_name,'%'));");
        $this->db->bind(':last_name', $data['worker']);
        // It might be more other elements, values to searchin by this elements
        $results = $this->db->resultSet();
        return $results;

    }
    // TODO public function findStoreActivitybyDate($data)  ?

    public function getStoreActivitybyIdItem($data){
      //var_dump($data);
      //echo "<br>Id item:".$data['id_item'];
      //Prepared statement
      $this->db->query('SELECT * FROM store_activity WHERE id_item = :id_item');
      $this->db->bind(':id_item', $data['id_item']);
      // It might be more other elements, values to searchin by this elements
      $results = $this->db->resultSet();
      return $results;
    }

    public function getStoreActivitybyIdWorker($data){
      //Prepared statement
      $this->db->query('SELECT * FROM store_activity WHERE id_worker = :id_worker');
      $this->db->bind(':id_worker', $data['id_worker']);
      // It might be more other elements, values to searchin by this elements
      $results = $this->db->resultSet();
      return $results;
    }

}
