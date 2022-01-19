<?php
include "../inc/init.php";

include ROOT_PATH . "public/template-parts/title.php";

include ROOT_PATH . "public/template-parts/header.php";

if (!defined('ROOT_URL')) {
    die;
}

if ($orderID == null || !isset($_SESSION["email"]) || $_SESSION["userid"] != $ordine['user_id']) {
    header("Location: " . ROOT_URL);
}

$orderMgr = new OrdersManager();
$orderAMgr = new OrderAddressManager();

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
$stimateDate = $dd_ . "-" . $mm_ . "-" . $yy_;

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/user');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('order-details.html', [
    'ROOT_URL' => ROOT_URL,
    'order' => $order,
    'date' => $date,
    'sum' => $sum,
    'stimateDate' => $stimateDate,
    'address' => $address
]);

include ROOT_PATH . "public/template-parts/footer.php";
