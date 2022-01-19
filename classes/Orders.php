<?php

class OrdersManager extends DbManager
{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'user_id', 'date_order', 'status', 'tracking_information', 'stimate_delivery', 'shipment_user_info');
    $this->tableName = 'Orders';
  }

  public function addOrder($userID, $shipmentID)
  {
    $d = strtotime("+7 days");
    $stimate_delivery = date("Y-m-d", $d);

    $this->db->execute("INSERT INTO Orders (user_id, stimate_delivery, shipment_user_info) VALUES ($userID, '$stimate_delivery', $shipmentID)");
    return $this->getLastOrder($userID, $shipmentID);
  }

  private function getLastOrder($userID, $shipmentID)
  {
    $result = $this->db->query("SELECT * FROM Orders WHERE user_id = $userID AND shipment_user_info = $shipmentID ORDER BY id DESC LIMIT 1");
    return $result[0]['id'];
  }

  public function getsum($idOrder)
  {
    $result = $this->db->query(" SELECT SUM(Product.price*Orders_items.quantity) AS totale FROM Orders, Orders_items, Product WHERE Orders.id = $idOrder AND Orders.id = Orders_items.order_id AND Orders_items.product_id = Product.id ");
    return $result;
  }

  public function getOrder($userID)
  {
    $result = $this->db->query("SELECT * FROM Orders WHERE user_id = $userID ORDER BY date_order DESC");
    return $result;
  }

  public function getOrderByID($orderID)
  {
    $result = $this->db->query("SELECT * FROM Orders WHERE id = $orderID ");
    return $result[0];
  }
  /* DASHBOARD */

  public function getLastOrders()
  {
    return $this->db->query("SELECT * FROM Orders ORDER BY id DESC LIMIT 3");
  }

  public function getRicevuti()
  {
    return $this->db->query("SELECT * FROM Orders WHERE status='Ordine ricevuto' ORDER BY id DESC");
  }

  public function getLavorazione()
  {
    return $this->db->query("SELECT * FROM Orders WHERE status='In lavorazione' ORDER BY id DESC");
  }

  public function getSpediti()
  {
    return $this->db->query("SELECT * FROM Orders WHERE status='Spedito' ORDER BY id DESC");
  }

  public function getConsegna()
  {
    return $this->db->query("SELECT * FROM Orders WHERE status='In consegna' ORDER BY id DESC");
  }

  public function getConsegnati()
  {
    return $this->db->query("SELECT * FROM Orders WHERE status='Consegnato' ORDER BY id DESC");
  }
}
