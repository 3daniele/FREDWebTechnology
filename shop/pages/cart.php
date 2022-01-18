<?php
include "../../inc/init.php";

include ROOT_PATH . "public/template-parts/title.php";

include ROOT_PATH . "public/template-parts/header.php";
            
$cartMgr = new CartManager();
$cartItemMgr = new CartItemManager();
$imgMgr = new ImgManager();
$productMgr = new ProductManager();

if (isset($_SESSION['email'])) {
    $user = $_SESSION['name'];
}

if (isset($_SESSION['userid'])) {
    $cartID = $cartMgr->findCart($_SESSION['userid']);
} else {
    $cartID = $cartMgr->getCart($_SESSION['client_id']);
}

if ($cartID) {
    $quantity = $cartItemMgr->countTotalItem($cartID);
}

$items = $cartItemMgr->getItems($cartID);

for ($i = 0; $i < count($items); $i++) {
    $products[] = $productMgr->get($items[$i]['product_id']);
    $imgs[] = $imgMgr->get_thumbnail($products[$i]->id);
}

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/shop');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('cart.html', [
    'ROOT_URL' => ROOT_URL,
    'user' => $user,
    'quantity' => $quantity,
    'products' => $products,
    'imgs' => $imgs,
    'items' => $items,
]);

include ROOT_PATH . 'public/template-parts/sidebar.php';

echo "</div> </div>";

include ROOT_PATH . "public/template-parts/footer.php";
