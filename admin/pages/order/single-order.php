<?php include "../../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php

include ROOT_PATH . "public/template-parts/title.php";

include ROOT_PATH . "public/template-parts/header.php";

include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php";

if (!defined('ROOT_URL')) {
    die;
}

if ($orderID == null || !isset($_SESSION["email"]) || $_SESSION["userid"] != $ordine['user_id']) {
    header("Location: " . ROOT_URL);
}

$orderMgr = new OrdersManager();
$orderAMgr = new OrderAddressManager();
$orderItemMgr = new OrdersItemsManager();
$prodcutMgr = new ProductManager();
$imgMgr = new ImgManager();

$orderID = $_GET["order"];

$order = $orderMgr->getOrderByID($orderID);
$address = $orderAMgr->getAddressByOrder($orderID);

$date = substr($order['date_order'], 0, 10);
$yy = substr($date, 0, 4);
$mm = substr($date, 5, 2);
$dd = substr($date, 8, 10);
$date = $dd . "-" . $mm . "-" . $yy;
$sum = $orderMgr->getsum($order["id"]);

$date_ = substr($order['stimate_delivery'], 0, 10);
$yy_ = substr($date_, 0, 4);
$mm_ = substr($date_, 5, 2);
$dd_ = substr($date_, 8, 10);
$stimateDate = $dd_ . "/" . $mm_ . "/" . $yy_;

$listProduct = $orderItemMgr->getItems($orderID);

$products = array();
$imgs = array();

foreach($listProduct as $product){
    $p = $prodcutMgr->get($product['product_id']);
    $img = $imgMgr->get_thumbnail($product['product_id']);
    array_push($products, $p);
    array_push($imgs, $img);
}

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/admin/order/');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('single-order.html', [
    'ROOT_URL' => ROOT_URL,
    'order' => $order,
    'date' => $date,
    'sum' => $sum,
    'stimateDate' => $stimateDate,
    'address' => $address,
    'products' => $products,
    'quantity' => $listProduct,
    'imgs' => $imgs
]);

include ROOT_PATH . "public/template-parts/footer.php";