<?php

class ChatManager extends DbManager{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'user_id');
    $this->tableName = 'Chat';
  }

}