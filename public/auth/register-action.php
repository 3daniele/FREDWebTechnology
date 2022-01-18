<?php
include "../../inc/init.php";

if (isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}

$userMgr = new UserManager();

$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$password = $_POST["password"];
$confPassword = $_POST["confPassword"];

$passHash = hash("sha1", $password);
$confPassHash = hash("sha1", $confPassword);

// creazione del nuovo utente
$userID = $userMgr->register($name, $surname, $email, $passHash);

if ($userID > 0) {
    // login automatico dell'utente appena creato
    $login = $userMgr->login($email, $passHash);

    $_SESSION["email"] = $email;
    foreach ($login as $log) {
        $_SESSION["img"] = $log["img"];
        $_SESSION["admin"] = $log["user_type"];
        $_SESSION["name"] = $log["name"];
        $_SESSION["userid"] = $log["id"];
    }
    // creazione e sincronizzazione dei carrelli
    $cartMgr = new CartManager();

    $cartID = $cartMgr->createCart();
    $currentCartID = $cartMgr->getCurrentCartId();
    if ($cartID != $currentCartID) {
        $cartMgr->mergeCarts($cartID, $currentCartID);
    }
    // redirect alla home
    header("Location: " . ROOT_URL . "shop");
} else {
    /*
    $error = "Errore durante la registrazione, riprova più tardi!";
    */
}
