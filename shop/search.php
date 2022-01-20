<?php 

include "../inc/init.php";

include ROOT_PATH . "public/template-parts/title.php";

include ROOT_PATH . 'public/template-parts/header.php'; 


if (isset($_POST["search"])) {
    $search = $_POST["search"];
}

echo $search;

$loader = new \Twig\Loader\FilesystemLoader('../templates/shop');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('search.html', [
    'ROOT_URL' => ROOT_URL
]);

include ROOT_PATH . 'public/template-parts/footer.php';