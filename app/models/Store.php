<?php
class Store {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    //Get items from Store DB.
    public function getStoreItems() {
        //Prepared statement
        $this->db->query('SELECT * FROM store');

        $ressults = $this->db->resultSet();
        return $ressults;

        /*
        //Email param will be binded with the login variable
        $this->db->bind(':login', $login);

        //Check if login is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        */
    }

    public function addStoreItem(){
      $this->db->query('INSERT INTO store (item_name,	item_info, item_group, item_location)');  // headers :id_item, ...
      $this->db->bind(':item_name', $item_name);
      $this->db->bind(':item_info', $item_info);
      $this->db->bind(':item_group', $item_group);
      $this->db->bind(':item_location', $item_location);

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }

    public function deleteStoreItem(){
      $this->db->query('DELETE FROM store WHERE item_name = :item_name');
      $this->db->bind(':item_name', $item_name);

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }

    public function updateStoreItem(){
      $this->db->query('UPDATE store SET item_name = :item_name,	item_info = :item_info, item_group = :item_group, item_location = :item_location');
      $this->db->bind(':item_name', $item_name);
      $this->db->bind(':item_info', $item_info);
      $this->db->bind(':item_group', $item_group);
      $this->db->bind(':item_location', $item_location);

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }
}
