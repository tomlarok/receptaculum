<?php
class Worker {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    //Get items from table Workers, from DB.
    public function getWorkers() {
        //Prepared statement
        $this->db->query('SELECT * FROM workers');

        $results = $this->db->resultSet();
        return $results;
    }

    //Get single item from table Store, from DB.
    public function getSingleWorker($data) {
        //Prepared statement
        $this->db->query('SELECT * FROM workers WHERE id_worker = :id_worker');
        $this->db->bind(':id_worker', $data['id_worker']);
        // It might be more other elements, values to searchin by this elements
        $results = $this->db->resultSet();
        return $results;
    }

    public function addWorker($data){ //	id_worker 	name 	last_name 	post
      $this->db->query('INSERT INTO workers (name,	last_name, post)
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

    public function deleteWorker($data){
      $this->db->query('DELETE FROM workers WHERE id_worker = :id_worker');
      $this->db->bind(':id_worker', $data);
      //$this->db->bind(':item_name', $item_name);
      //$this->db->query('DELETE FROM store WHERE item_name = :item_name');
      //$this->db->bind(':item_name', $item_name);

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }

    public function updateWorker($data){
      $this->db->query('UPDATE workers SET name = :name,	last_name = :last_name, post = :post
      WHERE id_worker = :id_worker');
      $this->db->bind(':id_worker', $data['id_worker']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':last_name', $data['last_name']);
      $this->db->bind(':post', $data['post']);

      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }
}
