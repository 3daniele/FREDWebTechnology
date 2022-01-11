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
    foreach ($login as $log) {
        $_SESSION["img"] = $log["img"];
        $_SESSION["admin"] = $log["user_type"];
        $_SESSION["name"] = $log["name"];
    }
    header("Location: " . ROOT_URL . "shop");
}







?>