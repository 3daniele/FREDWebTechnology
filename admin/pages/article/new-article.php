<?php include "../../../inc/init.php"; ?>
<?php
if (!defined('ROOT_URL')) {
    die;
}

if ($_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}

?>
<?php include ROOT_PATH . "public/template-parts/title.php" ?>




<title>Nuovo articolo</title>

<?php include ROOT_PATH . 'public/template-parts/header.php'; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<?php

$manufacturerMgr = new ManufacturerManager();
$manufacturers = $manufacturerMgr->getAll();

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/templates/admin/article/');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('new-article.html', [
    'ROOT_URL' => ROOT_URL,
    'manufacturers' => $manufacturers
    
]);

?>

<?php include ROOT_PATH . 'public/template-parts/footer.php'; ?>