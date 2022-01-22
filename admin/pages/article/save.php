<?php include "../../../inc/init.php";?>
<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>
<?php
    $title = $_POST["title"];
    
    $text = (string)$_POST["text"];
    
    $img = (string)$_POST["img"];

    $articleMgr = new ArticleManager();
    $articleMgr->newArticle($title,$text,$img);

    $id = $articleMgr->getLast();

    header("Location: ".ROOT_URL."admin/pages/article/edit-article.php?article=".$id[0]['id']);
    
?>