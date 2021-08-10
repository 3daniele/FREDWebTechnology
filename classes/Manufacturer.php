<?php

class ManufacturerManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'name', 'info', 'site');
    $this->tableName = 'Manufacturer';
  }

}
