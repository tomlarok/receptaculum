<?php
class StoreActivity {
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

    public function addStoreActivity($data){
    /*  $this->db->query('INSERT INTO store_activity (id_item,	id_worker, date, activity)
      VALUES (:id_item,	:id_worker, NOW(), :activity)');  // Date()
      */
      //$timestamp = strtotime(date('Y-m-d H:i:s'));
      $timestamp = ('2021-03-12 12:21:12');
      $this->db->query('INSERT INTO store_activity (id_item,	id_worker, activity, date)
      VALUES (:id_item,	:id_worker, :activity, :date)');  // Date()

      $this->db->bind(':id_item', $data['id_item']);
      $this->db->bind(':id_worker', $data['id_worker']);
      $this->db->bind(':activity', $data['activity']);
      $this->db->bind(':date', $timestamp); // TODO Add date to DB!
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
}
