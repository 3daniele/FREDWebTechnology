<?php
include "../inc/init.php";

if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}
?>

<?php
include ROOT_PATH . "public/template-parts/title.php";
?>

<title>Supporto</title>

<?php
include ROOT_PATH . "public/template-parts/header.php";
?>

<?php

    $supportMgr = new SupportManager();
    $ordersMgr = new OrdersManager();
    $userID = $_SESSION['userid'];

    $orders = $ordersMgr->getOrder($userID);
    $openTicket = $supportMgr->getOpenTicketUser($userID);
    $closeTicket = $supportMgr->getCloseTicketUser($userID);

    $ticket = ROOT_URL . "user/ticket-support.php?ticket=";

    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/user');
    $twig = new \Twig\Environment($loader, []);

echo $twig->render('support.html', [
    'ROOT_URL' => ROOT_URL,
    'orders' => $orders,
    'openTicket' => $openTicket,
    'closeTicket' => $closeTicket,
    'redirect' => $ticket

    
]);

?>



<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>