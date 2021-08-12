<?php

class PhotoManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'product_id', 'link', 'thumbnail');
    $this->tableName = 'Photo';
  }

}
