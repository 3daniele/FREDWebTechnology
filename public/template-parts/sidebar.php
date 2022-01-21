<?php 

include "../inc/init.php";


if (isset($_SESSION['email'])) {
    $user1 = $_SESSION['name'];
}
$userMgr = new UserManager();
$user = $userMgr->data($_SESSION["email"]);

$addresMgr = new ShipmentInformationManager();
$regioneMgr = new RegionManager();
$provinciaMgr = new ProvincesManager();
$cittaMgr = new CityManager();
$cartMgr = new CartManager();

$indirizzi = $addresMgr->getFatturazionePrincipale($user[0]['id']);
$regione =  $regioneMgr->getRegione($indirizzi[0]['region']);
$provincia = $provinciaMgr->getProvincia($indirizzi[0]['province']);
$citta =  $cittaMgr-> getCitta($indirizzi[0]['city']);
if (isset($_SESSION['userid'])) {
    $cartID = $cartMgr->findCart($_SESSION['userid']);
} else {
    $cartID = $cartMgr->getCart($_SESSION['client_id']);
}

if ($cartID) {
    $quantity = $cartItemMgr->countTotalItem($cartID);
}
$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/public/template-parts');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('sidebar.html', [
    'ROOT_URL' => ROOT_URL,
    'user' => $user,
    'indirizzi' => $indirizzi,
    'citta'=> $citta,
    'provincia'=> $provincia,
    'regione' => $regione,
    'quantity' => $quantity,
]);