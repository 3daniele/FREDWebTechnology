<?php include "../inc/init.php"; 

if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}

if (isset($_POST["wishlist"])) {
    $wishlistMgr = new WishlistManager();

    $userid = $_SESSION["userid"];
    $productID = $_POST["wishlist"];

    $wishlistMgr->addProduct($userid, $productID);

    $productID = $_POST['productID'];
    header('Location: ' . ROOT_URL . 'shop/single-product.php?product=' . $productID);
}