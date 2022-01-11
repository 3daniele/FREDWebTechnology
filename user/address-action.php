<?php include "../inc/init.php";

if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}

$shipIMgr = new ShipmentInformationManager();

// Aggiunta nuovo indirizzo
if (isset($_POST['add'])) {
    $userID = $_SESSION['userid'];
    $regionID = $_POST['regione'];
    $provinceID = $_POST['provincia'];
    $cityID = $_POST['comune'];
    $code = $_POST['cap'];
    $address = $_POST['address'];

    $shipID = $shipIMgr->addShipmentInformation($userID, $regionID, $provinceID, $cityID, $code, $address);

    header('Location: ' . ROOT_URL . 'user/address.php');
}

// Modifica di un indirizzo
if (isset($_POST['update'])) {
    $shipmentID = $_POST['shipmentID'];
    $regionID = $_POST['regione'];
    $provinceID = $_POST['provincia'];
    $cityID = $_POST['comune'];
    $code = $_POST['cap'];
    $address = $_POST['address'];

    $shipID = $shipIMgr->updateShipmentInformation($shipmentID, $regionID, $provinceID, $cityID, $code, $address);

    header('Location: ' . ROOT_URL . 'user/address.php');
}

//Eliminazione di un indirizzo
if (isset($_POST['delete'])) {
    $shipmentID = $_POST['delete'];

    $shipIMgr->remove($shipmentID);

    header('Location: ' . ROOT_URL . 'user/address.php');
}

// Cambio indirizzo predefinito 
if (isset($_POST['principal'])) {
    $shipmentID = $_POST['shipmentID'];
    $principal = $_POST['principal'];

    $shipIMgr->setPrincipal($shipmentID, $principal);

    header('Location: ' . ROOT_URL . 'user/address.php');
}

?>