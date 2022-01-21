<?php
include "../../inc/init.php";

if (isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}

include ROOT_PATH . "public/template-parts/title.php";

include ROOT_PATH . "public/template-parts/header.php";

$email = $_POST["email"];
$password = $_POST["password"];

$passHash = hash("sha1", $password);

$userMgr = new UserManager();
$login = $userMgr->login($email, $passHash);


if ($login == null) {
    $error = true;

    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/public/auth');
    $twig = new \Twig\Environment($loader, []);
    
    echo $twig->render('login.html', [
        'ROOT_URL' => ROOT_URL,
        'error' => $error,
    ]);
} else {
    $_SESSION["email"] = $email;
    foreach ($login as $log) {
        $_SESSION["img"] = $log["img"];
        $_SESSION["admin"] = $log["user_type"];
        $_SESSION["name"] = $log["name"];
        $_SESSION["userid"] = $log["id"];
    }
    header("Location: " . ROOT_URL . "shop");
}

include ROOT_PATH . "public/template-parts/footer.php";
