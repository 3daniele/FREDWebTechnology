<?php include "../../../inc/init.php"; ?>
<?php
if (!defined('ROOT_URL')) {
    die;
}

if ($_GET["article"] == null || $_SESSION["admin"] == 1 || !isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL . "admin/index.php");
}

$articleid = $_GET["article"];

?>
<?php include ROOT_PATH . "public/template-parts/title.php" ?>

<?php $articleMgr = new ArticleManager();
$article = $articleMgr->get($articleid);

if ($articleid == "") {
    header("Location: " . ROOT_URL);
}

?>

<title>Modifica:<?php echo " " . $article->title; ?></title>

<?php include ROOT_PATH . 'public/template-parts/header.php'; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<?php 


    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/templates/admin/article/');
    $twig = new \Twig\Environment($loader, []);
    
    echo $twig->render('edit-article.html', [
        'ROOT_URL' => ROOT_URL,
        'article' => $article,        
    ]);
?>


<?php include ROOT_PATH . 'public/template-parts/footer.php'; ?>