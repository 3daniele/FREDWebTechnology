<?php include "../../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Articoli</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<?php
    $articleMgr = new ArticleManager();

    $articles = $articleMgr->getAll();

    $articletxt = array();

    foreach($articles as $a){
        array_push($articletxt,substr($a->text,0,220));
    }

    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/templates/admin/article/');
    $twig = new \Twig\Environment($loader, []);
    
    echo $twig->render('articles.html', [
        'ROOT_URL' => ROOT_URL,
        'articles' => $articles,
        'articletxt' => $articletxt
    ]);
?>



<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>