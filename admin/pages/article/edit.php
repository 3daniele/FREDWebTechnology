<?php include "../../../inc/init.php";?>
<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>
<?php
    $title = $_POST["title"];
    
    $text = (string)$_POST["text"];
    
    $img = (string)$_POST["img"];
    
    $id = (int)$_POST["id"];

    $articleMgr = new ArticleManager();
    $articleMgr->updateArticle($id,$title,$text,$img);

    header("Location: ".ROOT_URL."admin/pages/product/edit-product.php?product=".$id);
    
?>