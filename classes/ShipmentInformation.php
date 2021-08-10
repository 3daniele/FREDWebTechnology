<?php

class ShipmentInformationManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id', 'region', 'city', 'code', 'address');
    $this->tableName = 'Shipment_information';
  }

}