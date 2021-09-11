<?php

class CityManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'name', 'provinces_id');
    $this->tableName = 'City';
  }


  public function getCitta($city_id){
    return $this->db->query("SELECT * FROM City WHERE id = '$city_id'");
  }
}
