<?php

class MessageManager extends DbManager{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'chat_id', 'message', 'date','displayed');
    $this->tableName = 'Message';
  }

  public function getLast($chatID){
    return $this->db->query("SELECT *FROM Message WHERE chat_id = '$chatID' ORDER BY date LIMIT 1");
  }

}