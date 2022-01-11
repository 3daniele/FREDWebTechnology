<?php

class CartManager extends DbManager
{

  private $clientId;

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'user_id', 'client_id');
    $this->tableName = 'Cart';

    $this->_initializeClientIdFromSession();
  }

  // helper costruttore
  private function _initializeClientIdFromSession()
  {
    if (isset($_SESSION['client_id'])) {
      $this->clientId = $_SESSION['client_id'];
    } else {
      // generare una stringa casuale
      $str = $this->_random_string();
      // settare clientId in sessione con questa stringa
      $_SESSION['client_id'] = $str;
      $this->clientId = $str;
    }
  }

  // helper costruttore
  private function _random_string()
  {
    return substr(md5(mt_rand()), 0, 20);
  }

  public function createCart()
  {
    $cartID = 0;

    if (isset($_SESSION['userid'])) {
      $cartID = $this->create([
        'user_id' => $_SESSION['userid'],
        'client_id' => $this->clientId
      ]);
    } else {
      $cartID = $this->create([
        'client_id' => $this->clientId
      ]);
    }
    return $cartID;
  }

  public function getCart($client_id)
  {
    $data = false;
    $result = $this->db->query("SELECT id FROM Cart WHERE client_id = '$client_id'");
    if (count($result) > 0) {
      $data = $this->checkCart($result[0]['id']);
    }
    return $data;
  }

  // funzione di appoggio per vedere se sono presenti elementi nel carrello
  private function checkCart($id)
  {
    $data = false;
    $result = $this->db->query("SELECT * FROM Cart_item WHERE cart_id = $id");
    if (count($result) > 0) {
      $data = $id;
    }
    return $data;
  }

  public function addToCart($productId, $cartId)
  {
    $quantity = 0;
    $result = $this->db->query("SELECT quantity FROM Cart_item WHERE cart_id = $cartId AND product_id = $productId");
    if (count($result) > 0) {
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

  public function removeFromCart($productId, $cartId)
  {
    $quantity = -1;

    $result = $this->db->query("SELECT * FROM Cart_item WHERE cart_id = $cartId AND product_id = $productId");

    if (count($result) > 0) {
      $quantity = $result[0]['quantity'];
      if ($quantity > 0) {
        $quantity--;
        $this->db->execute("UPDATE Cart_item SET quantity = $quantity WHERE cart_id = $cartId AND product_id = $productId");
      }
      if ($quantity == 0) {
        $cartItemID = $result[0]['id'];
        $cartItemMgr = new CartItemManager();
        $cartItemMgr->removeItem($cartItemID);
      }
    }
  }

  public function getCurrentCartId()
  {
    $cartID = 0;

    $result = $this->db->query("SELECT * FROM Cart WHERE client_id = '$this->clientId'");

    if (count($result) > 0) {
      $cartID = $result[0]['id'];
    } else {
      $cartID = $this->createCart();
    }

    return $cartID;
  }

  public function findCart($userID)
  {
    $cartID = 0;

    $result = $this->db->query("SELECT * FROM Cart WHERE user_id = '$userID'");

    if (count($result) > 0) {
      $cartID = $result[0]['id'];
    }else{
      $cartID = $this->createCart();
    }
    return $cartID;
  }

  public function mergeCarts($cartID, $currentCartID)
  {
    $cartItemMgr = new CartItemManager();
    $items = $cartItemMgr->getItems($currentCartID);

    foreach ($items as $item) {
      $productID = $item['product_id'];
      $quantity = $item['quantity'];
      $cartItemID = $item['id'];

      // aggiunta degli elementi del carrello della sessione corrente al carrello dell'utente registrato
      for ($i = 0; $i < $quantity; $i++) {
        $this->addToCart($productID, $cartID);
        $this->removeFromCart($productID, $currentCartID);
      }
      // eliminazione degli elementi presenti nel carrello di sessione
      $cartItemMgr->removeItem($cartItemID);
    }
    // eliminazione del carrello di sessione
    $this->delete($currentCartID);
  }

}


class CartItemManager extends DbManager
{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'cart_id', 'product_id', 'quantity');
    $this->tableName = 'Cart_item';
  }

  public function getItems($cartId)
  {
    return $this->db->query("SELECT * FROM Cart_item WHERE cart_id = '$cartId'");
  }

  public function removeItem($cartItemID)
  {
    return $this->delete($cartItemID);
  }

  public function countTotalItem($cartId)
  {
    $result = $this->getItems($cartId);
    $count = 0;
    foreach ($result as $key) {
      $count = $count + $key['quantity'];
    }
    return $count;
  }
}
