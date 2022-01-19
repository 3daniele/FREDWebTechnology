<?php 

include "../inc/init.php";

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/public/template-parts');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('sidebar.html', [
    'ROOT_URL' => ROOT_URL,
]);