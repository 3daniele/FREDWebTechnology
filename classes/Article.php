<?php

class ArticleManager extends DbManager{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'title', 'text', 'img');
    $this->tableName = 'Article';
  }

}
