<?php
include "../../inc/init.php";
if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}


include ROOT_PATH . "public/template-parts/title.php"; 

include ROOT_PATH . "public/template-parts/header.php"; 


$shipmentMgr = new ShipmentInformationManager();
$paymentsMgr = new PaymentsManager();
$cartMgr = new CartManager();
$cartItemMgr = new CartItemManager();
$productMgr = new ProductManager();
$imgMgr = new ImgManager();
$ordersMgr = new OrdersManager();
$ordersItemMgr = new OrdersItemsManager();

$userID = $_SESSION['userid'];

$cartID = $cartMgr->findCart($userID);
$items = $cartItemMgr->getItems($cartID);
$addresses = $shipmentMgr->getIndirizzi($userID);
$payments = $paymentsMgr->getPayments($userID);
$quantity = $cartItemMgr->countTotalItem($cartID);

for ($i = 0; $i < count($items); $i++) {
    $products[] = $productMgr->get($items[$i]['product_id']);
    $imgs[] = $imgMgr->get_thumbnail($products[$i]->id);
}

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/shop');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('checkout.html', [
    'ROOT_URL' => ROOT_URL,
    'userID' => $userID,
    'items' => $items,
    'addresses' => $addresses,
    'payments' => $payments,
    'quantity' => $quantity,
    'products' => $products,
    'imgs' => $imgs
]);

include ROOT_PATH . "public/template-parts/sidebar.php"; 
        
echo "</div> </form> </div>";

include ROOT_PATH . "public/template-parts/footer.php"; 