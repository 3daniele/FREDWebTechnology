<?php

class MessageManager extends DbManager{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'chat_id', 'message', 'date','displayed');
    $this->tableName = 'Message';
  }

}