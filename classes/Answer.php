<?php

class AnswerManager extends DbManager{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'support_id', 'admin_id', 'massage');
    $this->tableName = 'Answer';
  }

  //getBySupport
  /* DASHBOARD */
  public function getBySupport($supportid){
    return $this->db->query("SELECT * FROM Answer WHERE support_id = '$supportid'");
  }

  public function deleteAnswer($supportid){
    return $this->db->query("DELETE FROM Answer WHERE support_id = '$supportid'");
  }
  
  public function insertAnswer($adminid, $supportid, $message){
    return $this->db->query("INSERT INTO Answer (support_id, admin_id, message) VALUES ('$supportid', '$adminid', '$message')");
  }
}
