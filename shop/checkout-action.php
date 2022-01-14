<?php include "../inc/init.php"; 

// TO-DO
if (!defined('ROOT_URL')) {
    die;
}

// Checkout
if (isset($_POST['checkout'])) {
    $cartMgr = new CartManager();
    $cartItemMgr = new CartItemManager();
    $ordersMgr = new OrdersManager();
    $ordersItemMgr = new OrdersItemsManager();

    $userID = $_SESSION['userid'];
    $shipmentID = $_POST['shipmentID'];

    echo $userID . '<br>';
    echo $shipmentID;
    //$cartID = $cartMgr->findCart($userID);
    //$orderID = $ordersMgr->addOrder($userID, $shipmentID);
   
    $cartItems = $cartItemMgr->getItems($cartID);

    foreach ($cartItems as $item) {
        $productID = $item['product_id'];
        $quantity = $item['quantity'];

        $ordersItemMgr->addItem($orderID, $productID, $quantity);
        $cartItemMgr->removeItem($item['id']);
    }

    //header("Location: " . ROOT_URL);
}
