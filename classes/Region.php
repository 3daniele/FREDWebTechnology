<?php

class RegionManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'name');
    $this->tableName = 'Region';
  }
  
  public function getRegione($region_id){
    return $this->db->query("SELECT * FROM Region WHERE id = '$region_id'");
  }

}