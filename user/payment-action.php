<?php include "../inc/init.php";

if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}

$paymentsMgr = new PaymentsManager();

// Aggiunta nuovo metodo
if (isset($_POST['add'])) {
    $credit_card_number = $_POST['credit_card_number'];
    $expiration = $_POST['expiration'];
    $cvv = $_POST['cvv'];
    $userID = $_SESSION['userid'];
    
    $paymentsMgr->addPayment($userID, $credit_card_number, $cvv, $expiration);

    header('Location: ' . ROOT_URL . 'user/payment.php');
}

// Eliminazione di un metodo
if (isset($_POST['delete'])) {
    $paymentID = $_POST['delete'];

    $paymentsMgr->remove($paymentID);

    header('Location: ' . ROOT_URL . 'user/payment.php');
}

// Cambio metodo predefinito
if (isset($_POST['principal'])) {
    $paymentID = $_POST['paymentID'];
    $principal = $_POST['principal'];

    $paymentsMgr->setPrincipal($paymentID, $principal);
    
    header('Location: ' . ROOT_URL . 'user/payment.php');
}
