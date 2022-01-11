<?php

class ChatManager extends DbManager{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'user_id', 'date');
    $this->tableName = 'Chat';
  }

  public function getAllChat(){
    return $this->db->query("SELECT *FROM Chat ORDER BY date DESC");
  }

  public function getUserChat($userid){
    return $this->db->query("SELECT *FROM Chat WHERE user_id=$userid");
  }

}