<?php

class NewsletterManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id', 'category', 'manufacturer');
    $this->tableName = 'Newsletter';
  }

}
