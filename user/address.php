<?php
include "../inc/init.php";

if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}

include ROOT_PATH . "public/template-parts/title.php";

include ROOT_PATH . "public/template-parts/header.php";

$shipIMgr = new ShipmentInformationManager();
$addressMgr = new AddressManager();
$regionMgr =  new RegionManager();
$provinceMgr = new ProvincesManager();
$cityMgr = new CityManager();

$indirizzi = $shipIMgr->getIndirizzi($_SESSION['userid']);

$addresses = json_encode($addressMgr->getAll());
$regions = json_encode($regionMgr->getAll());
$provinces = json_encode($provinceMgr->getAll());
$cities = json_encode($cityMgr->getAll());

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/user');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('address.html', [
    'ROOT_URL' => ROOT_URL,
    'addresses' => $addresses,
    'regions' => $regions,
    'provinces' => $provinces,
    'cities' => $cities,
    'indirizzi' => $indirizzi
]);

include ROOT_PATH . "public/template-parts/footer.php";