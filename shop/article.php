<?php include "../inc/init.php"; ?>
<?php
if (!defined('ROOT_URL')) {
    die;
}

if ($_GET["article"] == null) {
    header("Location: " . ROOT_URL);
}

$articleid = $_GET["article"];

$articleMgr = new ArticleManager();
$article = $articleMgr->get($articleid);

?>

<?php include ROOT_PATH . "public/template-parts/title.php" ?>


<title><?php echo $article->title; ?></title>

<?php include ROOT_PATH . 'public/template-parts/header.php'; ?>

<?php

$loader = new \Twig\Loader\FilesystemLoader('../templates/shop/');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('article.html', [
    'ROOT_URL' => ROOT_URL,
    'article' => $article

]);

include ROOT_PATH . 'public/template-parts/footer.php';
?>