<?php

class AnswerManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'support_id', 'admin_id', 'massage');
    $this->tableName = 'Answer';
  }

}
