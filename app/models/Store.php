<?php
class Store {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    //Get items from Store, DB.
    public function getStoreItems() {
        //Prepared statement
        $this->db->query('SELECT * FROM store');

        $results = $this->db->resultSet();
        return $results;

    }

    //Get single item from table Store, from DB.
    public function getSingleStoreItem($data) {
        //Prepared statement
        $this->db->query('SELECT * FROM store WHERE id_item = :id_item');
        $this->db->bind(':id_item', $data['id_item']);
        // It might be more other elements, values to searchin by this elements
        $results = $this->db->resultSet();
        return $results;

    }

    public function addStoreItem($data){
      $this->db->query('INSERT INTO store (item_name,	item_info, item_group, item_sn, item_location, item_handing_over)
      VALUES (:item_name,	:item_info, :item_group, :item_sn, :item_location, :item_handing_over)');  // headers :id_item, ...
      $this->db->bind(':item_name', $data['item_name']);
      $this->db->bind(':item_info', $data['item_info']);
      $this->db->bind(':item_group', $data['item_group']);
      $this->db->bind(':item_sn', $data['item_sn']);
      $this->db->bind(':item_location', $data['item_location']);
      $this->db->bind(':item_handing_over', $data['item_handing_over']);

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }

    public function deleteStoreItem($data){
      $this->db->query('DELETE FROM store WHERE id_item = :id_item');
      $this->db->bind(':id_item', $data);
      //$this->db->bind(':item_name', $item_name);
      //$this->db->query('DELETE FROM store WHERE item_name = :item_name');
      //$this->db->bind(':item_name', $item_name);

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }

    public function updateStoreItem($data){
      $this->db->query('UPDATE store SET item_name = :item_name,	item_info = :item_info, item_group = :item_group, item_location = :item_location
      WHERE id_item = :id_item');
      $this->db->bind(':id_item', $data['id_item']);
      $this->db->bind(':item_name', $data['item_name']);
      $this->db->bind(':item_info', $data['item_info']);
      $this->db->bind(':item_group', $data['item_group']);
      //$this->db->bind(':item_sn', $data['item_sn']); // It is not allow to change
      $this->db->bind(':item_location', $data['item_location']);
      //$this->db->bind(':item_handing_over', $data['item_handing_over']); //It is not allow to change

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }

    public function updateStoreItemHandingOver($data){
      $this->db->query('UPDATE store SET item_handing_over = :item_handing_over
      WHERE id_item = :id_item');
      $this->db->bind(':id_item', $data['id_item']);
      $this->db->bind(':item_handing_over', $data['item_handing_over']);

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }

    public function findStoreItembySN($data) {
        $this->db->query("SELECT * FROM store WHERE item_sn LIKE CONCAT('%',:item_sn,'%');");
        $this->db->bind(':item_sn', $data['item_sn']);
        // It might be more other elements, values to searchin by this elements
        $results = $this->db->resultSet();
        return $results;

    }

    public function findStoreItembyItem($data) {
        $this->db->query("SELECT * FROM store WHERE item_name LIKE CONCAT('%',:item_name,'%');");
        $this->db->bind(':item_name', $data['item_name']);
        // It might be more other elements, values to searchin by this elements
        $results = $this->db->resultSet();
        return $results;

    }
}
