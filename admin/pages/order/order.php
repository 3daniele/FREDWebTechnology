<?php include "../../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Ordini</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<?php
$orderMgr = new OrdersManager();
$userMgr = new UserManager();
$orderadMgr = new OrderAddressManager();

$ricevuti = $orderMgr->getRicevuti();
$lavorazione = $orderMgr->getLavorazione();
$spedito = $orderMgr->getSpediti();
$consegna = $orderMgr->getConsegna();
$consegnati = $orderMgr->getConsegnati();

$userRicevuti = array();
$userLavorazione = array();
$userSpedito = array();
$userConsegna = array();
$userConsegnati = array();

$indirizziR = array();
$indirizziL = array();
$indirizziS = array();
$indirizziC = array();
$indirizziCC = array();

foreach($ricevuti as $r){
    array_push($userRicevuti, $userMgr->get($r['user_id']));
    array_push($indirizziR, $orderadMgr->getAddressByOrder($r['id']));
}

foreach($lavorazione as $r){
    array_push($userLavorazione, $userMgr->get($r['user_id']));
    array_push($indirizziL, $orderadMgr->getAddressByOrder($r['id']));
}

foreach($spedito as $r){
    array_push($userSpedito, $userMgr->get($r['user_id']));
    array_push($indirizziS, $orderadMgr->getAddressByOrder($r['id']));
}

foreach($consegna as $r){
    array_push($userConsegna, $userMgr->get($r['user_id']));
    array_push($indirizziC, $orderadMgr->getAddressByOrder($r['id']));
}

foreach($consegnati as $r){
    array_push($userConsegnati, $userMgr->get($r['user_id']));
    array_push($indirizziCC, $orderadMgr->getAddressByOrder($r['id']));
}

$redirect = ROOT_URL . "admin/pages/order/single-order.php?order=";

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/templates/admin/order/');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('order.html', [
    'ROOT_URL' => ROOT_URL,
    'redirect' => $redirect,
    'ordiniRicevuti' =>$ricevuti,
    'ordiniLavorazione' =>$lavorazione,
    'ordiniSpedizione' =>$spedito,
    'ordiniConsegna' =>$consegna,
    'ordiniConsegnati' =>$consegnati,
    'utentiR' => $userRicevuti,
    'utentiL' => $userLavorazione,
    'utentiC' => $userConsegna,
    'utentiCC' => $userConsegnati,
    'indirizziR' => $indirizziR,
    'indirizziL' => $indirizziL,
    'indirizziS' => $indirizziS,
    'indirizziC' => $indirizziC,
    'indirizziCC' => $indirizziCC,
     
]);
?>

<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>