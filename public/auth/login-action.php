<?php
include "../../inc/init.php";

if (isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}

$email = $_POST["email"];
$password = $_POST["password"];

$passHash = hash("sha1",$password);

$userMgr = new UserManager();
$login = $userMgr->login($email, $passHash);


if ($login == null) {
    //ALERT
}else{
    $_SESSION["email"] = $email;
    foreach ($login as $log) {
        $_SESSION["img"] = $log["img"];
        $_SESSION["admin"] = $log["user_type"];
        $_SESSION["name"] = $log["name"];
        $_SESSION["userid"] = $log["id"];
    }
    header("Location: " . ROOT_URL . "shop");
}
