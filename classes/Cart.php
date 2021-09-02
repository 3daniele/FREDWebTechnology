<?php

class CartManager extends DbManager {

  private $clientId;

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'user_id', 'client_id');
    $this->tableName = 'Cart';

    $this->_initializeClientIdFromSession();
  }

  public function getCart($client_id) {
    $data = false;
    $result = $this->db->query("SELECT id FROM Cart WHERE client_id = '$client_id'");
    if (count($result) > 0) {
      $data = $this->checkCart($result[0]['id']);
    }
    return $data;
  }

  // funzione di appoggio per vedere se sono presenti elementi nel carrello
  private function checkCart($id) {
    $data = false;
    $result = $this->db->query("SELECT * FROM Cart_item WHERE cart_id = $id");
    if (count($result) > 0) {
      $data = $id;
    }
    return $data;
  }

  public function addToCart($productId, $cartId){
    $quantity = 0;
    $result = $this->db->query("SELECT quantity FROM Cart_item WHERE cart_id = $cartId AND product_id = $productId");
    if (count($result) > 0){
      $quantity = $result[0]['quantity'];
    } 
    $quantity++;

    if (count($result) > 0) {
      $this->db->execute("UPDATE Cart_item SET quantity = $quantity WHERE cart_id = $cartId AND product_id = $productId");
    } else {
      $cartItemMgr = new CartItemManager();
      $newId = $cartItemMgr->create([
        'cart_id' => $cartId,
        'product_id' => $productId,
        'quantity' => 1
      ]);
    }

  }
  public function getCurrentCartId() {
    $cartId = 0;

    $result = $this->db->query("SELECT * FROM cart WHERE client_id = '$this->clientId'");
    if (count($result) > 0) {
      $cartId = $result[0]['id'];
    } else {
      $cartId = $this->create([
        'client_id' => $this->clientId
      ]);
    }

    return $cartId;
  }

  private function _initializeClientIdFromSession(){
    if (isset($_SESSION['client_id'])){
      $this->clientId = $_SESSION['client_id'];
    } else {
      // generare una stringa casuale
      $str = $this->_random_string();
      // settare clientId in sessione con questa stringa
      $_SESSION['client_id'] = $str;
      $this->clientId = $str;
    }
  }

  private function _random_string(){
    return substr(md5(mt_rand()), 0, 20);
  }
  

}


class CartItemManager extends DbManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'cart_id', 'product_id', 'quantity');
    $this->tableName = 'Cart_item';
  }

  public function getItems($cartId){
    return $this->db->query("SELECT * FROM Cart_item WHERE cart_id = '$cartId'");
  }

  public function countTotalItem($cartId){
    $result = $this->getItems($cartId);
    $count = 0;
    foreach ($result as $key) {
        $count = $count + $key['quantity'];
    }
    return $count;

  }

}