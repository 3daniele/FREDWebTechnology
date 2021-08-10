<?php

class RegionManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'name');
    $this->tableName = 'Region';
  }

}