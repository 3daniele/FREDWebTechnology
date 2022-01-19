<?php
include "../inc/init.php";
if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}

include ROOT_PATH . "public/template-parts/title.php";

include ROOT_PATH . "public/template-parts/header.php";

$orderMgr = new OrdersManager();
$orderAMgr = new OrderAddressManager();
$orderIMgr = new OrdersItemsManager();
$productMgr = new ProductManager();
$imgMgr = new ImgManager();

$orders = $orderMgr->getOrder($_SESSION['userid']);

for ($i = 0; $i < count($orders); $i++) {
    $items[$i] = $orderIMgr->getItems($orders[$i]['id']);
    $date = substr($orders[$i]['date_order'], 0, 10);
    $yy = substr($date, 0, 4);
    $mm = substr($date, 5, 2);
    $dd = substr($date, 8, 10);
    $dates[] = $dd . "-" . $mm . "-" . $yy;
    $sums[] = $orderMgr->getsum($orders[$i]["id"]);
}

$size = count($orders);

for ($i = 0; $i < count($items); $i++) {
    for ($j = 0; $j < count($items[$i]); $j++) {
        $products[$i][] = $productMgr->get($items[$i][$j]['product_id']);
        $imgs[$i][] = $imgMgr->get_thumbnail($products[$i][$j]->id);
    }
    $sizeItems[] = count($items[$i]);
}

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/user');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('order.html', [
    'ROOT_URL' => ROOT_URL,
    'orders' => $orders,
    'size' => $size,
    'sizeItems' => $sizeItems,
    'dates' => $dates,
    'sums' => $sums,
    'items' => $items,
    'products' => $products,
    'imgs' => $imgs
]);

include ROOT_PATH . "public/template-parts/footer.php";
