<?php
class ShipmentInformation {

  public $id;
  public $userID;
  public $regionID;
  public $provinceID;
  public $cityID;
  public $code;
  public $address;
  public $principal;

  public function __construct($id, $userID, $regionID, $provinceID, $cityID, $code, $address, $principal)
  {
    $this->id = (int) $id;
    $this->userID = (int) $userID;
    $this->regionID = (int) $regionID;
    $this->provinceID = (int) $provinceID;
    $this->cityID = (int) $cityID;
    $this->code = $code;
    $this->address = $address;
    $this->principal = $principal;
  }

}

class ShipmentInformationManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id', 'region', 'province', 'city', 'code', 'address', 'principal');
    $this->tableName = 'Shipment_information';
  }

  public function getFatturazione($userid){
    return $this->db->query("SELECT * FROM Shipment_information WHERE user_id = '$userid' AND principal = 1");
  }

  public function getIndirizzi($userid){
    return $this->db->query("SELECT * FROM address WHERE user = '$userid'");
  }

  public function addShipmentInformation($userID, $regionID, $provinceID, $cityID, $code, $address) {
    return $this->db->query("INSERT INTO Shipment_information (user_id, region, province, city, code, address) VALUES($userID, $regionID, $provinceID, $cityID, '$code', '$address')");
  }

  public function updateShipmentInformation($id, $userID, $regionID, $provinceID, $cityID, $code, $address) {
    return $this->db->query("UPDATE Shipment_information SET region = $regionID, province = $provinceID, city = $cityID, code = '$code', address = '$address' WHERE id` = $id");
  }

  public function setPrincipal($id, $principal) {
    return $this->db->query("UPDATE Shipment_information SET principal = $principal WHERE id` = $id");
  }

  public function remove($shipmentInfoID) {
    return $this->delete($shipmentInfoID);
  }

}