<?php

class SupportManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id', 'status', 'object','message', 'date','order_id');
    $this->tableName = 'Support';
  }

  public function getOpenTicketUser($userId){
    return $this->db->query("SELECT *FROM Support WHERE Support.status=0 AND user_id = '$userId' ORDER BY Support.date DESC");
  }

  public function getCloseTicketUser($userId){
    return $this->db->query("SELECT *FROM Support WHERE Support.status=1 AND user_id = '$userId' ORDER BY Support.date DESC");
  }

  public function addSupport($userID, $object, $message)
  {
    return $this->db->execute("INSERT INTO Support (user_id, object, message) VALUES ($userID, '$object', '$message')");
  }

  public function addSupportOrder($userID, $object, $message, $orderid)
  {
    return $this->db->execute("INSERT INTO Support (user_id, object, message, order_id) VALUES ($userID, '$object', '$message', $orderid)");
  }

  public function getLast($userid)
  {
    return $this->db->query("SELECT *FROM Support WHERE user_id = '$userid' ORDER BY Support.date DESC LIMIT 1");
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

  public function countTicket($userid){
    return $this->db->query("SELECT COUNT(id) AS nticket  FROM Support WHERE user_id = '$userid'");
  }

  public function updateTicket($supportid, $status){
    return $this->db->query("UPDATE Support SET status='$status' WHERE id='$supportid';");
  }

}