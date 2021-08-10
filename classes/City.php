<?php

class CityManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'name', 'region_id');
    $this->tableName = 'City';
  }

}
