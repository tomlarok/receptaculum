<?php
class Worker {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    //Get items from table Workers, from DB.
    public function getWorker() {
        //Prepared statement
        $this->db->query('SELECT * FROM workers');

        $results = $this->db->resultSet();
        return $results;
    }

    //Get single item from table Store, from DB.
    public function getSingleWorker($data) {
        //Prepared statement
        $this->db->query('SELECT * FROM worker WHERE id_worker = :id_worker');
        $this->db->bind(':id_worker', $data['id_worker']);
        // It might be more other elements, values to searchin by this elements
        $results = $this->db->resultSet();
        return $results;
    }

    public function addWorker($data){ //	id_worker 	name 	last_name 	post
      $this->db->query('INSERT INTO worers (name,	last_name, post)
      VALUES (:name, :last_name, :post)');  // headers :id_item, ...
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':last_name', $data['last_name']);
      $this->db->bind(':post', $data['post']);

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
      $this->db->bind(':item_location', $data['item_location']);

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }
}
