<?php include "../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Dashboard</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<?php 
    $orderMgr = new OrdersManager();
    $orderAddressMgr = new OrderAddressManager();
    $userMgr = new UserManager();
    $supportMgr = new SupportManager();
    $reviewMgr = new ReviewManager();
    $productMgr = new ProductManager();


    $orders = $orderMgr->getLastOrders();
    $users = array();
    $addresses = array();

    foreach($orders as $order){
        $user = $userMgr->get($order['user_id']);
        $addressinfo = $orderAddressMgr->getAddressByOrder($order['id']);
        $string = $addressinfo['address'] . ", " . $addressinfo['city_name'] . ", " . $addressinfo['code'] . ", " . $addressinfo['provinces_name'] . ".";
        $string2 = $user->name.", ".$user->surname;
        
        array_push($addresses, $string);
        array_push($users, $string2);
    }

    $tickets = $supportMgr->showOpenTicket();

    $reviews = $reviewMgr->getLastReview();

    $products = $productMgr->getEsaurimenti();
    
    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/templates/admin/');
    $twig = new \Twig\Environment($loader, []);
    
    echo $twig->render('index.html', [
        'ROOT_URL' => ROOT_URL,
        'orders' => $orders,
        'users' => $users,
        'addresses' => $addresses,
        'tickets' => $tickets,
        'reviews' => $reviews,
        'products' => $products
        
    ]);


?>


<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>