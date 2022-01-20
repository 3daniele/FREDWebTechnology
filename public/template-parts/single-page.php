<?php 

include "../../inc/init.php";

include ROOT_PATH . "public/template-parts/title.php";

include ROOT_PATH . 'public/template-parts/header.php'; 

$loader = new \Twig\Loader\FilesystemLoader('../../templates/public/template-parts');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('single-page.html', [
    'ROOT_URL' => ROOT_URL
]);

include ROOT_PATH . 'public/template-parts/footer.php';