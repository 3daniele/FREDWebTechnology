<?php

class SupportManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id', 'status', 'object','message', 'date','order_id');
    $this->tableName = 'Support';
  }


  /* DASHBOARD */
  public function showOpenTicket(){
    return $this->db->query("SELECT *FROM Support WHERE Support.status=0 ORDER BY Support.date DESC LIMIT 3");
  }
  
  public function getOpenTicket(){
    return $this->db->query("SELECT *FROM Support WHERE Support.status=0 ORDER BY Support.date DESC");
  }

  public function getCloseTicket(){
    return $this->db->query("SELECT *FROM Support WHERE Support.status=1 ORDER BY Support.date DESC");
  }

  public function getTicket($ticketid){
    return $this->db->query("SELECT *FROM Support WHERE Support.id = '$ticketid'");
  }

}