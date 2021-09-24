<?php

class OrdersManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id', 'date_order', 'status','tracking_information', 'stimate_delivery', 'shipment_user_info');
    $this->tableName = 'Orders';
  }

  public function addOrder($userID, $shipmentID) {
    $d = strtotime("+7 days");
    $stimate_delivery = date("Y-m-d", $d);

    $this->db->execute("INSERT INTO Orders (user_id, stimate_delivery, shipment_user_info) VALUES ($userID, '$stimate_delivery', $shipmentID)");
    return $this->getLastOrder($userID, $shipmentID);
  }

  private function getLastOrder($userID, $shipmentID) {
    $result = $this->db->query("SELECT * FROM Orders WHERE user_id = $userID AND shipment_user_info = $shipmentID ORDER BY id DESC LIMIT 1");
    return $result[0]['id'];
  }

  public function getOrder($userID) {
    $result = $this->db->query("SELECT * FROM Orders WHERE user_id = $userID ");
    return $result;
  }
  /* DASHBOARD */

  public function getLastOrders(){
    return $this->db->query("SELECT * FROM Orders ORDER BY id DESC LIMIT 3");                                 
  }

}
