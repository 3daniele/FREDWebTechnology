<?php include "../inc/init.php"; 

if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}

$wishlistMgr = new WishlistManager();

// AGGIUNTA ALLA LISTA
if (isset($_POST["wishlist"])) {

    $userid = $_SESSION["userid"];
    $productID = $_POST["wishlist"];

    $wishlistMgr->addProduct($userid, $productID);

    $productID = $_POST['productID'];
    header('Location: ' . ROOT_URL . 'shop/single-product.php?product=' . $productID);
}

// AGGIUNTA AL CARRELLO
if (isset($_POST['addToCart'])) {

    $productID = $_POST['addToCart'];

    // addToCart Logic
    $cartMgr = new CartManager();

    if (isset($_SESSION['userid'])) {
        $cartID = $cartMgr->findCart($_SESSION['userid']);
    } else {
        $cartID = $cartMgr->getCurrentCartId();
    }
    // aggiungi al carrello "cartID" il prodotto "productID"
    $cartMgr->addToCart($productID, $cartID);

    header("Location: ". ROOT_URL . "shop/pages/wishlist.php");
}

// RIMOZIONE DALLA LISTA
if (isset($_POST['rimuovi'])){
    $productID = $_POST['rimuovi'];

    $wishlistMgr->deleteByProductId($productID, $_SESSION["userid"]);

    header("Location: ". ROOT_URL . "shop/pages/wishlist.php");
}