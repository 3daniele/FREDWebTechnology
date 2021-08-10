<?php

class PaymentsManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id', 'credit_card_number', 'cvv', 'expiration' , 'paypal');
    $this->tableName = 'Payments';
  }

}