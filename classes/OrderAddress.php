<?php

class OrderAddressManager extends DbManager{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('order_id','user','region_id','region_name', 'provinces_id','provinces_name', 'city_id', 'city_name','code','address');
    $this->tableName = 'orderaddress';
  }

  public function getAddressByOrder($orderID){
    return $this->db->query("SELECT * FROM orderaddress WHERE order_id=$orderID");
  }
}