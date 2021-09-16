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
    $this->columns = array('id', 'name', 'description', 'small_description', 'price', 'stock', 'manufacturer_id');
    $this->tableName = 'Product';
  }

  /* DASHBOARD */
  public function getEsaurimenti()
  {
    return $this->db->query("SELECT * FROM Product WHERE stock < 10  ORDER BY stock LIMIT 15");
  }

  public function getProductOrderByStock()
  {
    return $this->db->query("SELECT * FROM Product ORDER BY stock");
  }

  public function updateProduct($productID, $name, $description, $small_description, $price, $stock)
  {
    $descriptionbis = addslashes($description);
    $small_descriptionbis= addslashes($small_description);
    return $this->db->query("UPDATE Product SET name='$name', description='$descriptionbis', small_description='$small_descriptionbis', price='$price', stock='$stock' WHERE id='$productID'");
  }

  public function newProduct($name, $description, $small_description, $price, $stock,$manufacturer_id){
    $descriptionbis = addslashes($description);
    $small_descriptionbis= addslashes($small_description);
    return $this->db->query("INSERT INTO Product (name,description,small_description,price,stock,manufacturer_id) VALUES ('$name','$description', '$small_description', '$price','$stock','$manufacturer_id')");
  }

  public function getLast(){
    return $this->db->query("SELECT *FROM Product ORDER BY id DESC");
  }
}
