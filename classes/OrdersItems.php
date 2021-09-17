<?php

class OrdersItemsManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'order_id', 'product_id', 'quantity');
    $this->tableName = 'Orders_items';
  }

  public function addItem($orderID, $productID, $quantity) {
    return $this->db->execute("INSERT INTO Orders_items (order_id, product_id, quantity) VALUES ($orderID, $productID, $quantity)");
  }
}
