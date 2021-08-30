<?php

class ShipmentInformationManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id', 'region', 'city', 'code', 'address', 'principal');
    $this->tableName = 'Shipment_information';
  }

  public function getFatturazione($userid){
    return $this->db->query("SELECT * FROM Shipment_information WHERE user_id = '$userid' AND principal = 1");
  }

  public function getIndirizzi($userid){
    return $this->db->query("SELECT * FROM Shipment_information WHERE user_id = '$userid'");
  }

}