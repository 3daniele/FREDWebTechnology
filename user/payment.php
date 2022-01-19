<?php
include "../inc/init.php";

if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}

include ROOT_PATH . "public/template-parts/title.php";

include ROOT_PATH . "public/template-parts/header.php";

$userID = $_SESSION['userid'];
$paymentsMgr = new PaymentsManager();
$payments = $paymentsMgr->getPayments($userID);

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/user');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('payment.html', [
    'ROOT_URL' => ROOT_URL,
    'userID' => $userID,
    'payments' => $payments
]);

include ROOT_PATH . "public/template-parts/footer.php";
