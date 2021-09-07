<?php

class ProductManager extends DbManager
{
  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'name', 'description', 'price', 'manufacturer_id');
    $this->tableName = 'Product';
  }

  public function searchByName($name)
  {
    return $this->db->query("SELECT * FROM Product WHERE name = '$name' LIMIT 1");
  }

  public function searchByCategory($category)
  {
    $categoryMgr = new CategoryManager();
    $categoryid = $categoryMgr->getCategoryByName($category);

    $categoryItemMgr = new CategoryItemManager();
    $product_id = $categoryItemMgr->getProductFromCategory($categoryid[0]["id"]);

    $productMgr = new ProductManager();

    for ($i = 0; $i < count($product_id); $i++) {
      foreach ($product_id as $singleProduct) {
        $product[$i] = $productMgr->get($singleProduct);
      }
    }

    return $product;
  }
}
