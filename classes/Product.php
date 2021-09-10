<?php

class Product
{
  public $id;
  public $name;
  public $description;
  public $price;
  public $manufacturer_id;


  public function __construct($id, $name, $description, $price, $manufacturer_id)
  {
    $this->id = (int)$id;
    $this->name = $name;
    $this->description = $description;
    $this->price = $price;
    $this->manufacturer_id = $manufacturer_id;
  }
}

class ProductManager extends DbManager
{
  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'name', 'description', 'price', 'manufacturer_id');
    $this->tableName = 'Product';
  }
}
