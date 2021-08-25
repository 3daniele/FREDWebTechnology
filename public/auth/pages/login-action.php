<?php
include "../../../inc/init.php";

$email = $_POST["email"];
$password = $_POST["password"];

$passHash = hash("sha1",$password);

$userMgr = new UserManager();
$login = $userMgr->login($email, $passHash);

if ($login == null) {
    //ALLERT
}else{
    $_SESSION["email"] = $email;
    $_SESSION["img"] = $login["img"];
    header("Location: " . ROOT_URL . "shop");
}







?>