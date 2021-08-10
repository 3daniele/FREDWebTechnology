<?php

class OrdersManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id', 'date_order', 'status','tracking_information', 'stimate_delivery', 'shipment_user_info');
    $this->tableName = 'Orders';
  }

}
