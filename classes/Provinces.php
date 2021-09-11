<?php

class ProvincesManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'name', 'region_id');
    $this->tableName = 'Provinces';
  }

  public function getProvincia($provinces_id){
    return $this->db->query("SELECT * FROM Provinces WHERE id = '$provinces_id'");
  }
  
}
