<?php include "../inc/init.php"; 

if (!defined('ROOT_URL')) {
    die;
}

$cartMgr = new CartManager();

// AGGIUNTA AL CARRELLO
if (isset($_POST['product_id'])) {

    $productID = $_POST['product_id'];

    // addToCart Logic
    if (isset($_SESSION['userid'])) {
        $cartID = $cartMgr->findCart($_SESSION['userid']);
        echo $cartID;
    } else {
        $cartID = $cartMgr->getCurrentCartId();
        echo $cartID;
    }
    // aggiungi al carrello "cartID" il prodotto "productID"
    $cartMgr->addToCart($productID, $cartID);

    if (isset($_POST['singleProduct'])) {
        $productID = $_POST['productID'];
        header('Location: ' . ROOT_URL . 'shop/single-product.php?product=' . $productID);
    } else {
        if(isset($_POST['uri'])){
            header('Location: ' . ROOT_URL . 'shop/search.php?search='.$_POST['s']);
        }else{
            header('Location: ' . ROOT_URL . 'shop');
        }
        
    }
}

// Aggiunta e rimozione dal carrello
if (isset($_POST['minus'])) {
    $cartID = $cartMgr->findCart($_SESSION['userid']);
    $cartMgr->removeFromCart($_POST['minus'], $cartID);
    
    header("Location: " . ROOT_URL . "shop/pages/cart.php");
  }  
  if (isset($_POST['plus'])) {
    $cartID = $cartMgr->findCart($_SESSION['userid']);
    $cartMgr->addToCart($_POST['plus'], $cartID);
    
    header("Location: " . ROOT_URL . "shop/pages/cart.php");
}
