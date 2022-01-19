<?php 

include "../inc/init.php";

$email = isset($_SESSION["email"]);

if ($_SESSION["admin"] == 2) {
    $admin = true;
} else {
    $admin = false;
}

$img = $_SESSION['img'];

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/public/template-parts');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('header.html', [
    'ROOT_URL' => ROOT_URL,
    'email' => $email,
    'admin' => $admin,
    'img' => $img
]);