<?php
include "../inc/init.php";
if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}
include ROOT_PATH . "public/template-parts/title.php";
include ROOT_PATH . "public/template-parts/header.php";

$userMgr = new UserManager();
$user = $userMgr->data($_SESSION["email"]);

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/user');
$twig = new \Twig\Environment($loader, []);
echo $twig->render('account.html', [
    'ROOT_URL' => ROOT_URL,
    'user' => $user,
  
    
]);

include ROOT_PATH . "public/template-parts/footer.php";
